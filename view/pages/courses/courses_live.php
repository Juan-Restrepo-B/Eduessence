<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

date_default_timezone_set('America/Bogota');

include("../../../model/conexion.php");

if (isset($_GET['idauditorio'])) {
    $idauditorio = $_GET['idauditorio'];
}

$infCurso = "SELECT 
                *
            FROM
                TR_CURSOS
                INNER JOIN TR_INFOCURSO ON INFO_IDCURSO = IDCURSOS
                INNER JOIN TR_AUDITORIOS ON IDCURSOS = IDCURSO
            WHERE
                IDAUDITORIO = '" . $idauditorio . "' ";
$resultinfoCurso = $conn->query($infCurso);

$consultaPersona = "SELECT
                        PERSONA_NOMBRES 
                    FROM
                        TR_PERSONA 
                    WHERE 
                        PERSONA_CORREO = '" . $usuario . "' ";
$resultConsultaPersona = $conn->query($consultaPersona);
$rowConsultaPersona = $resultConsultaPersona->fetch_assoc();

$person = $rowConsultaPersona["PERSONA_NOMBRES"];

if ($resultinfoCurso->num_rows > 0) {

    $rowinfcurso = $resultinfoCurso->fetch_assoc();

    $fechFinCurso = $rowinfcurso["CURSO_FECHFIN"];
    $fechaFinCurso = new DateTime($fechFinCurso);


    $fechInicio = $rowinfcurso["CURSO_FECHSTART"];
    $fechaIniCurso = new DateTime($fechInicio);

    $fechaActual = new DateTime();

    if ($fechaActual > $fechaFinCurso) {
        header("Location: /curso_grab?idcurso=" . $rowinfcurso["IDCURSOS"]);
    }

    if ($fechaActual < $fechaIniCurso) {
        header("Location: /curso_alert?idcurso=" . $rowinfcurso["IDCURSOS"]);
    }

    $llave = $rowinfcurso['LLAVE_TRANSMISION'];
    $idcurso = $rowinfcurso["IDCURSOS"];

    if (strpos($llave, '?') !== false) {
        // Ya hay parámetros en la URL, usa &
        $urlVideo = $llave . '&enablejsapi=1';
    } else {
        // No hay parámetros aún, usa ?
        $urlVideo = $llave . '?enablejsapi=1';
    }
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="view/css/courses/styles_courses_live.css">
    </head>

    <body>
        <section>
            <div class="header">
                <a href="/curso_audience?idcurso=<?php echo $rowinfcurso["IDCURSOS"]; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
                    </svg>
                </a>
            </div>
        </section>
        <h1><?php echo $rowinfcurso["CURSO_NOMBRE"]; ?></h1>
        <div class="container">
            <div class="tramsmi item-60" style="position: relative;" id="videoContainer">
                <iframe id="videoPlayer" src="<?php echo $urlVideo; ?>" frameborder="0" allow="autoplay; encrypted-media"
                    allowfullscreen style="width: 100%; height: 100%; display: block;">
                </iframe>

                <div id="videoOverlay" style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: transparent;
                    pointer-events: auto;
                    z-index: 2;
                    cursor: pointer;">
                </div>
            </div>


            <div class="chat item-40">
                <h2>Preguntas y Respuestas</h2>
                <div id="chat"></div>
                <form id="formulario">
                    <input type="text" class="btn-mg" id="mensaje" placeholder="Escribe tu pregunta" required>
                    <button type="button" class="btn" onclick="enviarMensaje()">Enviar</button>
                </form>
            </div>
        </div>
    </body>
    <?php
} else {
    echo "<div>No se encontró información sobre el curso.</div>";
}
?>
<script>
    // Pasar el nombre del usuario desde PHP a JavaScript
    const usuario = <?php echo json_encode($person); ?>;

    // Función para enviar mensaje a través de AJAX
    function enviarMensaje() {
        const mensaje = document.getElementById('mensaje').value;

        if (usuario && mensaje) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "model/courses/chat_live_send.php?idcurso=<?php echo $idcurso; ?>", true);
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
        xhr.open("GET", "model/courses/chat_live_load.php?idcurso=<?php echo $idcurso; ?>", true);
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
        xhr.open("POST", "model/courses/log_activity.php", true);
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
</script>

<script defer src="view/js/global/screen_lock.js"></script>
<!-- <script async src="view/js/courses/courses_live.js"></script> -->

<!-- Carga la API de YouTube -->
<script src="https://www.youtube.com/iframe_api"></script>

<script>
    let player;
    let isPlaying = false;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('videoPlayer', {
            events: {
                'onReady': onPlayerReady
            }
        });
    }

    function onPlayerReady(event) {
        const overlay = document.getElementById('videoOverlay');
        const container = document.getElementById('videoContainer');

        overlay.addEventListener('click', function () {
            const state = player.getPlayerState();

            if (state === YT.PlayerState.PLAYING) {
                player.pauseVideo();
            } else {
                player.playVideo();
            }
        });

        // Evento de doble clic para activar/desactivar pantalla completa
        container.addEventListener('dblclick', function () {
            if (!document.fullscreenElement) {
                container.requestFullscreen().catch(err => {
                    console.error(`Error al intentar pantalla completa: ${err.message}`);
                });
            } else {
                document.exitFullscreen();
            }
        });
    }
</script>




</html>