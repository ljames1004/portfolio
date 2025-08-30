import './bootstrap';

// Import Three.js and model scene
import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';

class ModelScene {
  constructor(container) {
    this.container = container;
    this.width = container.clientWidth;
    this.height = container.clientHeight;

    // Set up scene
    this.scene = new THREE.Scene();

    // Match body background - transparent to inherit from parent
    this.scene.background = null;

    // Set up camera
    this.camera = new THREE.PerspectiveCamera(75, this.width / this.height, 0.1, 1000);
    this.camera.position.set(0, 0, 5);

    // Set up renderer with transparency
    this.renderer = new THREE.WebGLRenderer({
      antialias: true,
      alpha: true,
      preserveDrawingBuffer: true
    });
    this.renderer.setSize(this.width, this.height);
    this.renderer.setPixelRatio(window.devicePixelRatio);
    this.renderer.shadowMap.enabled = true;
    this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
    this.renderer.setClearColor(0x000000, 0); // Transparent background

    container.appendChild(this.renderer.domElement);

    // Set up OrbitControls for interaction
    this.controls = new OrbitControls(this.camera, this.renderer.domElement);
    this.controls.enableDamping = true;
    this.controls.dampingFactor = 0.05;
    this.controls.enableZoom = true;
    this.controls.enablePan = true;
    this.controls.enableRotate = true;
    this.controls.autoRotate = true;
    this.controls.autoRotateSpeed = 0.5;

    // Set up lighting
    const ambientLight = new THREE.AmbientLight(0x404040, 0.8);
    this.scene.add(ambientLight);

    const directionalLight = new THREE.DirectionalLight(0xffffff, 1.2);
    directionalLight.position.set(5, 5, 5);
    directionalLight.castShadow = true;
    this.scene.add(directionalLight);

    // Add point light for better illumination
    const pointLight = new THREE.PointLight(0x61fe25, 0.5, 10);
    pointLight.position.set(0, 2, 2);
    this.scene.add(pointLight);

    // Create a fallback cube immediately to ensure something is visible
    this.createFallbackModel();

    // Load and add the model
    this.loadModel();

    // Window resize handler
    window.addEventListener('resize', this._onResize.bind(this));

    // Start the animation loop
    this._animate();
  }

  loadModel() {
    const loader = new GLTFLoader();

    // Try to load the model - you can change this to your .dlb file if you convert it
    loader.load('/models/model.glb', (gltf) => {
      // Remove the fallback model if it exists
      if (this.fallbackModel) {
        this.scene.remove(this.fallbackModel);
      }

      this.model = gltf.scene;
      this.scene.add(this.model);

      // Calculate optimal size and position for portfolio display
      const box = new THREE.Box3().setFromObject(this.model);
      const center = box.getCenter(new THREE.Vector3());
      const size = box.getSize(new THREE.Vector3());

      // Scale model to fit nicely in the container (adjust these values as needed)
      const maxDim = Math.max(size.x, size.y, size.z);
      const targetSize = 3; // Target size in scene units
      const scale = targetSize / maxDim;
      this.model.scale.setScalar(scale);

      // Center the model
      this.model.position.sub(center.multiplyScalar(scale));

      // Add some offset for better visual positioning
      this.model.position.y -= 0.5;

      // Enable shadows and improve materials for the model
      this.model.traverse((child) => {
        if (child.isMesh) {
          child.castShadow = true;
          child.receiveShadow = true;

          // Improve material properties for better visual quality
          if (child.material) {
            child.material.envMapIntensity = 1.0;
            child.material.needsUpdate = true;
          }
        }
      });
    }, (progress) => {
    }, (error) => {
      console.error('Error loading model:', error);
    });
  }

  createFallbackModel() {
    // Create a more interesting fallback model - a geometric shape
    const geometry = new THREE.OctahedronGeometry(1.5, 0);
    const material = new THREE.MeshPhongMaterial({
      color: 0x61fe25,
      transparent: true,
      opacity: 0.8,
      shininess: 100
    });
    this.fallbackModel = new THREE.Mesh(geometry, material);
    this.fallbackModel.castShadow = true;
    this.fallbackModel.receiveShadow = true;
    this.scene.add(this.fallbackModel);
  }

  _onResize() {
    if (!this.container) return;
    this.width = this.container.clientWidth;
    this.height = this.container.clientHeight;
    this.camera.aspect = this.width / this.height;
    this.camera.updateProjectionMatrix();
    this.renderer.setSize(this.width, this.height);
  }

  _animate() {
    requestAnimationFrame(this._animate.bind(this));

    // Update controls
    this.controls.update();

    // Only rotate if auto-rotate is enabled and no user interaction
    if (this.controls.autoRotate && !this.controls.enabled) {
      if (this.model) {
        this.model.rotation.y += 0.005;
      } else if (this.fallbackModel) {
        this.fallbackModel.rotation.y += 0.005;
      }
    }

    this.renderer.render(this.scene, this.camera);
  }

  dispose() {
    this.renderer.dispose();
    window.removeEventListener('resize', this._onResize);
    this.container.innerHTML = '';
  }
}

// Initialize the scene when the document is ready
function initialize3DScene() {
  const container = document.getElementById('3d-model-container');

  if (container) {

    // Check if container has dimensions
    if (container.clientWidth === 0 || container.clientHeight === 0) {
      // Wait a bit and try again
      setTimeout(initialize3DScene, 100);
      return;
    }

    const scene = new ModelScene(container);
  }
}

// Try multiple times to ensure the DOM is ready
document.addEventListener('DOMContentLoaded', initialize3DScene);
window.addEventListener('load', initialize3DScene);

// Also try after a short delay to handle any CSS loading delays
setTimeout(initialize3DScene, 500);
