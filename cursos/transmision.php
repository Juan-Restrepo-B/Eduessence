<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

date_default_timezone_set('America/Bogota');

include("conexion.php");

if (isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
}

$infCurso = "SELECT 
                IDCURSOS,
                CURSO_NOMBRE, 
                CURSO_LOGOIMG,
                INFO_MININFO,
                CURSO_FECHINS,
                CURSO_FECHSTART,
                CURSO_FECHFIN
            FROM
                TR_CURSOS
                INNER JOIN TR_INFOCURSO ON INFO_IDCURSO = IDCURSOS
            WHERE
                IDCURSOS = '" . $idcurso . "' ";
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
    $fechaActual = new DateTime();

    // if ($fechaActual > $fechaFinCurso) {
    //     header("Location: ../clases/index.php");
    // }
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/styles_transmision.css">
    </head>

    <body>
        <section>
            <div class="header">
                <a href="index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
                    </svg>
                </a>
            </div>
        </section>
        <h1><?php echo $rowinfcurso["CURSO_NOMBRE"]; ?></h1>
        <div class="container">
            <div class="tramsmi item-60">
                <video src="" poster="../img/logos/<?php echo $rowinfcurso["CURSO_LOGOIMG"]; ?>"></video>
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
        xhr.open("GET", "cargar.php?idcurso=<?php echo $idcurso; ?>", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('chat').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    // Cargar mensajes cada 2 segundos
    setInterval(cargarMensajes, 2000);
</script>

</html>