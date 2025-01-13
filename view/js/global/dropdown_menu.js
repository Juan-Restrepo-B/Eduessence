document.addEventListener('DOMContentLoaded', function () {
    // Add a click event to each menu item
    var menuItems = document.querySelectorAll('#main-menu a');

    menuItems.forEach(function (item) {
        item.addEventListener('click', function () {
            // Uncheck the checkbox that controls the menu
            document.getElementById('btn-main').checked = false;

            // Hide the menu
            var menu = document.querySelector('.ul-main');
            menu.style.display = 'none';

            // Hide the background overlay
            var menu = document.querySelector('.background-menu');
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
        var menu = document.querySelector('.background-menu');
        if (this.checked) {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    });
});