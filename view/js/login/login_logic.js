document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const register = urlParams.get('register');

    const btnNewCuenta = document.getElementById("btn-NewCuenta");
    const inContainer = document.querySelector(".in-container");
    const upContainer = document.querySelector(".up-container");
    const insContainer = document.querySelector(".sign-in-container");
    const upsContainer = document.querySelector(".sign-up-container");

    function handleBtnNewCuenta() {
        // Verificar la resolución de la pantalla
        if (window.innerWidth < 640) {
            console.log("Resolución menor a 640px, no se ejecuta la acción.");
            return;
        }

        // Agrega una clase para activar la animación de desvanecimiento
        inContainer.classList.add("fade-in");
        upContainer.classList.add("fade-out");

        // Espera a que termine la animación y luego cambia la visibilidad y las clases
        setTimeout(() => {
            inContainer.style.display = "flex";
            upsContainer.style.display = "flex";
            insContainer.style.display = "none";
            upContainer.style.display = "none";

            // Ajusta la opacidad y las clases de animación
            inContainer.style.opacity = 1;
            inContainer.classList.remove("fade-in");
            upContainer.classList.remove("fade-out");
        }, 900); // El tiempo debe coincidir con la duración de la transición en CSS (0.6s)

        console.log("Función handleBtnNewCuenta ejecutada");
    }

    // Ejecutar la función handleBtnNewCuenta si el parámetro 'register' está presente y es 'true'
    if (register === 'true') {
        handleBtnNewCuenta();
    }

    btnNewCuenta.addEventListener("click", handleBtnNewCuenta);
});