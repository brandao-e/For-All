document.addEventListener("DOMContentLoaded", function() {
    const navLinks = document.querySelectorAll('.nav--link');
    const themeToggleIcon = document.querySelector('.icon i');
    const body = document.body;

    // Verifica o tema salvo no localStorage e aplica
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        body.classList.add(savedTheme);
        if (savedTheme === 'dark-mode') {
            themeToggleIcon.classList.remove('fa-moon');
            themeToggleIcon.classList.add('fa-sun');
        }
    }

    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
        });

        link.addEventListener('mouseover', function() {
            this.classList.add('hover');
        });

        link.addEventListener('mouseout', function() {
            this.classList.remove('hover');
        });
    });

    themeToggleIcon.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        
        if (body.classList.contains('dark-mode')) {
            themeToggleIcon.classList.remove('fa-moon');
            themeToggleIcon.classList.add('fa-sun');
            localStorage.setItem('theme', 'dark-mode'); // Salva o tema no localStorage
        } else {
            themeToggleIcon.classList.remove('fa-sun');
            themeToggleIcon.classList.add('fa-moon');
            localStorage.removeItem('theme'); // Remove o tema do localStorage (default será claro)
        }
    });
});