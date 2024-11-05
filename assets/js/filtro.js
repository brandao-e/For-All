document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll(".categories input[type='checkbox']");
    const filtersContainer = document.getElementById("filters-container");
    const vacancyList = document.querySelectorAll(".vacancy");
    const searchInput = document.querySelector(".search-bar input"); // Seleciona a barra de pesquisa

    // Adiciona um evento de entrada à barra de pesquisa
    searchInput.addEventListener("input", filterVacancies);

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const filterName = this.nextSibling.textContent.trim();

            if (filterName === "Todas as categorias") {
                // Se "Todas as categorias" for selecionado, desmarca todos os outros checkboxes
                if (this.checked) {
                    checkboxes.forEach((cb) => {
                        if (cb !== this) {
                            cb.checked = false;
                            removeFilter(cb.nextSibling.textContent.trim());
                        }
                    });
                }
            } else {
                // Se outro checkbox for marcado, desmarque "Todas as categorias"
                if (this.checked) {
                    const allCategoriesCheckbox = document.querySelector(".categories input[type='checkbox']:checked");
                    if (allCategoriesCheckbox && allCategoriesCheckbox.nextSibling.textContent.trim() === "Todas as categorias") {
                        allCategoriesCheckbox.checked = false;
                        removeFilter("Todas as categorias");
                    }
                    // Adicionar o filtro selecionado
                    addFilter(filterName, this);
                } else {
                    // Remover o filtro se desmarcado
                    removeFilter(filterName);
                }
            }
            filterVacancies(); // Chama a função de filtragem
        });
    });

    function addFilter(filterName, checkbox) {
        // Cria a div do filtro selecionado
        const filterDiv = document.createElement("div");
        filterDiv.className = "filter";
        filterDiv.innerHTML = `${filterName} <span class="remove-filter">x</span>`;

        // Adiciona a lógica para remover o filtro quando o "x" é clicado
        filterDiv.querySelector(".remove-filter").addEventListener("click", function () {
            filterDiv.remove();
            checkbox.checked = false;
            filterVacancies();
        });

        // Adiciona o filtro à área de filtros
        filtersContainer.appendChild(filterDiv);
    }

    function removeFilter(filterName) {
        // Remove o filtro com o nome correspondente
        const filters = filtersContainer.querySelectorAll(".filter");
        filters.forEach((filter) => {
            if (filter.textContent.trim().startsWith(filterName)) {
                filter.remove();
            }
        });
    }

    function filterVacancies() {
        const selectedFilters = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.nextSibling.textContent.trim());

        // Obtém o texto da barra de pesquisa
        const searchTerm = searchInput.value.toLowerCase();

        vacancyList.forEach(vacancy => {
            const category = vacancy.querySelector(".categoriaMain").textContent.trim();
            const title = vacancy.querySelector("h3").textContent.trim().toLowerCase(); // Obtém o título da vaga

            // Verifica se a vaga deve ser exibida com base nos filtros de categoria e na pesquisa
            const matchesCategory = selectedFilters.includes("Todas as categorias") || selectedFilters.length === 0 || selectedFilters.includes(category);
            const matchesSearch = title.includes(searchTerm); // Verifica se o título contém o termo de pesquisa

            if (matchesCategory && matchesSearch) {
                vacancy.style.display = "block"; // Exibe a vaga
            } else {
                vacancy.style.display = "none"; // Esconde a vaga
            }
        });
    }
});