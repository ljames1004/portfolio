#!/bin/bash

echo "Building Laravel Portfolio Docker Image..."

# Build production image
docker build -f Dockerfile.prod -t portfolio-laravel:latest .

if [ $? -eq 0 ]; then
    echo "✅ Docker image built successfully!"
    echo "Image: portfolio-laravel:latest"
    echo ""
    echo "To run locally:"
    echo "docker run -p 8000:80 portfolio-laravel:latest"
    echo ""
    echo "To test with docker-compose:"
    echo "docker-compose up --build"
else
    echo "❌ Docker build failed!"
    exit 1
fi
