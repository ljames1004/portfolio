<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Lincoln James | Portfolio') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset("index.css") }}">
        <link rel="shortcut icon" href="{{ asset('images/online-service.png') }}" type="image/x-icon">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col" style="padding-top: 0px">
        @yield("content")
        @vite('resources/js/app.js') <!-- Your Vite setup -->
    </body>
    <script>
        const themeToggleButton = document.getElementById('theme-toggle');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');
        const header = document.getElementById('fixed-header');
        const texts = document.getElementsByClassName('toggle-text');
        const homeLink = document.getElementById('home-link');
        const projectsLink = document.getElementById('projects-link');
        const aboutLink = document.getElementById('about-link');
        const url = window.location.href;

        const currentTheme = localStorage.getItem('theme');

        if (url.includes('contact')) {
            homeLink.attributes[0].value = '/#home';
            projectsLink.attributes[0].value = '/#projects';
            aboutLink.attributes[0].value = '/#about';
        } else {
            homeLink.attributes[0].value = '#home';
            projectsLink.attributes[0].value = '#projects';
            aboutLink.attributes[0].value = '#about';
        }

        if (currentTheme === 'dark') {
            document.documentElement.classList.add('dark');
            header.classList.add('dark');
            moonIcon.classList.add('hidden');
            sunIcon.classList.remove('hidden');

            for (const text of texts) {
                text.classList.add('text-white');
            }
        } else {
            document.documentElement.classList.remove('dark');
            header.classList.remove('dark');
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');

            for (const text of texts) {
                text.classList.remove('text-white');
            }
        }

        // Toggle Theme
        themeToggleButton.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            header.classList.toggle('dark');

            for (const text of texts) {
                text.classList.toggle('text-white');
            }

            // Toggle the icon
            if (document.documentElement.classList.contains('dark')) {
                moonIcon.classList.add('hidden');
                sunIcon.classList.remove('hidden');
                localStorage.setItem('theme', 'dark');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
                localStorage.setItem('theme', 'light');
            }
        });
    </script>
</html>
