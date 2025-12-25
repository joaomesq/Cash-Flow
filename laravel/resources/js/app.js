import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// resources/js/app.js
if (!window.__themeInitialized) {
    window.__themeInitialized = true;

    document.addEventListener('DOMContentLoaded', () => {

        const switchBg = document.getElementById('switchBg');
        if (!switchBg) return;

        function setTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                switchBg.style.transform = 'translateX(40px)';
            } else {
                document.documentElement.classList.remove('dark');
                switchBg.style.transform = 'translateX(0)';
            }
        }

        window.toggleTheme = function () {
            const isDark = document.documentElement.classList.contains('dark');
            const newTheme = isDark ? 'light' : 'dark';

            localStorage.setItem('theme', newTheme);
            setTheme(newTheme);
        };

        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);
    });
}