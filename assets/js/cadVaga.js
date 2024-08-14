document.addEventListener('DOMContentLoaded', function() {
    const categories = document.querySelectorAll('.content.category');

    categories.forEach(category => {
        category.addEventListener('click', function() {
            // Remove a classe 'selected' de todos os elementos
            categories.forEach(cat => cat.classList.remove('selected'));
            
            // Adiciona a classe 'selected' ao elemento clicado
            this.classList.add('selected');
        });
    });
});