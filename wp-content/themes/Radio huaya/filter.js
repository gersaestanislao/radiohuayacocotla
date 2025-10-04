document.addEventListener("DOMContentLoaded", function () {
    var containerEl = document.querySelector("#mix-container");

    var mixer = mixitup(containerEl, {
        pagination: {
            limit: 6, // Número de elementos por página
            loop: false, // Si quieres que al final regrese al inicio
            hidePageListIfSinglePage: true // Oculta paginación si hay solo una página
        }
    });

    const checkboxes = document.querySelectorAll(".filter-checkbox");
    const resetBtn = document.getElementById("reset-filters");

    // --- Filtros por categorías ---
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            let selectors = [];
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    selectors.push(cb.value);
                }
            });

            if (selectors.length > 0) {
                mixer.filter(selectors.join(","));
            } else {
                mixer.filter("all");
            }
        });
    });

    // --- Botón reset ---
    resetBtn.addEventListener("click", function () {
        checkboxes.forEach(cb => cb.checked = false);
        mixer.filter("all");
    });

});


$('.mixitup-page-list').on("click",function(){
    $(window).scrollTop(0);
});



