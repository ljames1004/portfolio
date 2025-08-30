<div id="fixed-header" class="fixed fixed-header right-6 z-50">
    <a href="#home" id="home-link" class="progress-btn toggle-text transition-all duration-500 transform hover:scale-110 mr-4">Home</a>
    <a href="#projects" id="projects-link" class="toggle-text progress-btn transition-all duration-500 transform hover:scale-110 mr-4">Projects</a>
    <a href="#about" id="about-link" class="toggle-text progress-btn transition-all duration-500 transform hover:scale-110 mr-4">About Me</a>
    <a href="{{ route('contact') }}" class="toggle-text progress-btn transition-all duration-500 transform hover:scale-110 mr-4">Contact</a>

    <button id="theme-toggle" class="text-white text-accent-green-hover transition-all duration-300 transform hover:rotate-180">
        <svg id="sun-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
        </svg>

        <svg id="moon-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <circle cx="12" cy="12" r="3" fill="black"/>
            <path d="M12 2V4" stroke="black" stroke-width="2" stroke-linecap="round"/>
            <path d="M12 20V22" stroke="black" stroke-width="2" stroke-linecap="round"/>
            <path d="M4 12H2" stroke="black" stroke-width="2" stroke-linecap="round"/>
            <path d="M22 12H20" stroke="black" stroke-width="2" stroke-linecap="round"/>
            <path d="M4.93 4.93L6.34 6.34" stroke="black" stroke-width="2" stroke-linecap="round"/>
            <path d="M17.66 17.66L19.07 19.07" stroke="black" stroke-width="2" stroke-linecap="round"/>
            <path d="M4.93 19.07L6.34 17.66" stroke="black" stroke-width="2" stroke-linecap="round"/>
            <path d="M17.66 6.34L19.07 4.93" stroke="black" stroke-width="2" stroke-linecap="round"/>
          </svg>

    </button>
</div>
