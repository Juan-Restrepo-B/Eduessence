// Función para enviar mensaje a través de AJAX
function enviarMensaje() {
    const mensaje = document.getElementById('mensaje').value;

    if (usuario && mensaje) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "enviar.php?idcurso=<?php echo $idcurso; ?>", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('mensaje').value = ''; // Limpiar campo mensaje
                cargarMensajes(); // Recargar el chat
            }
        };
        xhr.send("usuario=" + encodeURIComponent(usuario) + "&mensaje=" + encodeURIComponent(mensaje));
    }
}

// Función para cargar mensajes a través de AJAX
function cargarMensajes() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "model/courses/chat_live.php?idcurso=<?php echo $idcurso; ?>", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('chat').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

// Cargar mensajes cada 2 segundos
setInterval(cargarMensajes, 2000);


document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
});

document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
});

document.addEventListener('selectstart', function (e) {
    e.preventDefault();
});


let logInterval;
let activityTimeout;

function resetActivityTimeout() {
    clearTimeout(activityTimeout);
    activityTimeout = setTimeout(startLogInterval, 30000); // 30 segundos en milisegundos para pruebas
}

function startLogInterval() {
    clearInterval(logInterval);
    logUserActivity(); // Registrar inmediatamente
    //logInterval = setInterval(logUserActivity, 30000); // 30 segundos en milisegundos para pruebas
    logInterval = setInterval(logUserActivity, 1800000); // 30 minutos en milisegundos para producción
}

function logUserActivity() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "log_activity.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("useremail=<?php echo $usuario; ?>&ip_cliente=<?php echo $ip_cliente; ?>&idcurso=<?php echo $idcurso; ?>");
}

function handleVisibilityChange() {
    if (document.hidden) {
        clearInterval(logInterval);
    } else {
        resetActivityTimeout();
    }
}

document.addEventListener("mousemove", resetActivityTimeout);
document.addEventListener("keydown", resetActivityTimeout);
document.addEventListener("visibilitychange", handleVisibilityChange);

// Inicializar el timeout solo si la página está visible
if (!document.hidden) {
    resetActivityTimeout();
}