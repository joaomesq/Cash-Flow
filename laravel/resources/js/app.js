import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// resources/js/app.js

if (!window.__themeInitialized) {
    window.__themeInitialized = true;

    window.toggleTheme = function () {
        const isDark = document.documentElement.classList.contains('dark');
        const theme = isDark ? 'light' : 'dark';

        localStorage.setItem('theme', theme);
        document.documentElement.classList.toggle('dark');
    };

    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
    }
}
