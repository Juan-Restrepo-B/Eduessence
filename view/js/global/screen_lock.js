document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
});

document.addEventListener('selectstart', function (e) {
    e.preventDefault();
});
// Obtén el elemento de video
var video = document.getElementById("miVideo");

// Agrega un manejador de eventos para el clic en el video
video.addEventListener("click", function () {
    if (video.paused) {
        // Si el video está pausado, reproducelo
        video.play();
    } else {
        // Si el video se está reproduciendo, ponlo en pausa
        video.pause();
    }
});

// Agrega un manejador de eventos para el doble clic en el video
video.addEventListener("dblclick", function () {
    if (video.requestFullscreen) {
        // Si el navegador admite la función de pantalla completa, entra en pantalla completa
        video.requestFullscreen();
    } else if (video.mozRequestFullScreen) {
        video.mozRequestFullScreen(); // Firefox
    } else if (video.webkitRequestFullscreen) {
        video.webkitRequestFullscreen(); // Chrome, Safari y Opera
    }
});