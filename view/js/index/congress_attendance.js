window.onload = function () {
    // Obtener los parámetros de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');
    const control = urlParams.get('control');
    const userid = urlParams.get('userid');
    const cursoId = urlParams.get('cursoId');

    if (action === 'register' && control) {
        // Realizar el check-in enviando una solicitud POST a checkin.php
        const formData = new FormData();
        formData.append('userid', userid);
        formData.append('action', action);
        formData.append('control', control);
        formData.append('cursoId', cursoId);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'checkin', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Respuesta del servidor
                    console.log(xhr.responseText);
                    // Almacenar el userid en las cookies
                    setUserId(userid); // La cookie expirará en 30 días
                    window.location.href = 'registroExitosoChekin'; // Redirección a registroExitoso.php
                } else {
                    console.log('Error en el servidor.');
                    window.location.href = 'registroFallidoChekin'; // Redirección a registroFallido.php
                }
            }
        };
        xhr.send(formData);
    } else if (action === 'checking' && control) {
        // Realizar el check-in enviando una solicitud POST a checkin.php
        const formData = new FormData();
        formData.append('action', action);
        formData.append('control', control);
        formData.append('cursoId', cursoId);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'checkin', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Respuesta del servidor
                    console.log(xhr.responseText);

                    // Obtener el userid desde las cookies
                    const userid = getUserId();
                    if (!userid) {
                        // Si no se encuentra el userid en las cookies, redirigir a user.php
                        window.location.href = 'userFail';
                    } else if (control === 'INGRESO') {
                        window.location.href = 'entradaCongreso';
                    } else if (control === 'SALIDA') {
                        window.location.href = 'salidaCongreso';
                    } else if (control === 'SALON') {
                        window.location.href = 'salaCongreso';
                    } else if (control === 'SIMPOCIO') {
                        window.location.href = 'seguimientoCongreso';
                    } else {
                        console.log('Control desconocido.');
                    }
                } else {
                    console.log('Error en el servidor.');
                }
            }
        };
        xhr.send(formData);
    }
};

// Guardar userId en almacenamiento local persistente
function setUserId(value) {
    localStorage.setItem('userid', value);
}

// Obtener userId desde almacenamiento local
function getUserId() {
    return localStorage.getItem('userid');
}
