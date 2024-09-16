document.addEventListener("DOMContentLoaded", function() {
    const themeToggleIcon = document.querySelector('.theme-icon i');
    const body = document.body;
    const mobileMenuToggle = document.querySelector('.icon-bars i');
    const dropdown = document.querySelector('.dropdown');
    const iconXmark = document.querySelector('.icon-xmark i');
    const mobileThemeToggleIcon = document.querySelector('.mobile .content .mid .theme-icon i');

    // Verifica o tema salvo no localStorage e aplica
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        body.classList.add(savedTheme);
        if (savedTheme === 'dark-mode') {
            themeToggleIcon.classList.remove('fa-moon');
            themeToggleIcon.classList.add('fa-sun');
        }
    }

    // Funcção alternar tema
    function alternarTema(icone) {
        icone.addEventListener('click', function() {
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                icone.classList.remove('fa-moon');
                icone.classList.add('fa-sun');
                localStorage.setItem('theme', 'dark-mode'); // Salva o tema no localStorage
            } else {
                icone.classList.remove('fa-sun');
                icone.classList.add('fa-moon');
                localStorage.removeItem('theme'); // Remove o tema do localStorage (default será claro)
            }
        });
    }

    alternarTema(themeToggleIcon);

    alternarTema(mobileThemeToggleIcon);

    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            // Fecha todos os painéis, exceto o clicado
            for (var j = 0; j < acc.length; j++) {
                if (acc[j] !== this) {
                    acc[j].classList.remove("active-acc");
                    acc[j].nextElementSibling.style.display = "none";
                }
            }

            // Alterna o painel clicado
            this.classList.toggle("active-acc");

            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
    
    mobileMenuToggle.addEventListener('click', function() {
        dropdown.classList.toggle('active');
    })

    iconXmark.addEventListener('click', function() {
        dropdown.classList.remove('active');
    })
});