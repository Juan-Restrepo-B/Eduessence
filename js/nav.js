document.addEventListener('DOMContentLoaded', function () {
    // Agrega un evento de clic a cada elemento del menú
    var menuItems = document.querySelectorAll('#main-menu a');

    menuItems.forEach(function (item) {
        item.addEventListener('click', function () {
            // Desmarca la casilla de verificación que controla el menú
            document.getElementById('btn-main').checked = false;

            // Oculta el menú
            var menu = document.querySelector('.ul-main');
            menu.style.display = 'none';

            // Oculta el menú
            var menu = document.querySelector('.fondMain');
            menu.style.display = 'none';
        });
    });

    document.getElementById('btn-main').addEventListener('change', function () {
        var menu = document.querySelector('.ul-main');
        if (this.checked) {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
        var menu = document.querySelector('.fondMain');
        if (this.checked) {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    });
});
