<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

include("../../../model/conexion.php");

if (isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
}

$sql = "SELECT CURSO_NOMBRE, IDCURSOS FROM UN_CARRERA uc 
                INNER JOIN TR_CURSOS tc ON uc.CARRERA_IDCURSO = tc.IDCURSOS
                WHERE CARRERA_CURESTADO = 'ACTIVO'
                AND IDCURSOS = '" . $idcurso . "' 
                AND CARRERA_USUARIO_NOMBRE = '" . $usuario . "'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/courses/styles_courses_recording.css">
</head>

<body>
    <div style=" display: flex; flex-direction: row;">
        <a href="/curso_info?idcurso=<?php echo $idcurso ?>" style="margin-top: 1rem; margin-left: 1rem;" >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
            </svg>
        </a>
        <div class="container">
            <div class="list_class">
                <table>

                    <tr>
                        <td class title>
                            <?php
                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    echo strtoupper($row["CURSO_NOMBRE"]);
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <?php

                    $sql1 = "SELECT IDVIDEO, VIDEO_TITULO
                        FROM UN_CARRERA uc
                        INNER JOIN TR_VIDEOS tv ON uc.CARRERA_IDCURSO = tv.VIDEO_IDCURSO
                        WHERE CARRERA_CURESTADO = 'ACTIVO'
                        AND tv.VIDEO_IDCURSO = '" . $idcurso . "'
                        GROUP BY IDVIDEO, VIDEO_TITULO";
                    $result1 = $conn->query($sql1);

                    $exist_grab = $result1->fetch_assoc();

                    if ($exist_grab == null) {
                        header("Location: /cursos");
                    }

                    if ($result1) {
                        while ($row1 = $result1->fetch_assoc()) {
                            ?>
                            <tr>
                                <td class="cal">
                                    <a href="/curso_class?classId=<?php echo $row1["IDVIDEO"]; ?>"
                                        class="mostrarFormulario5 buttonSimposio" target="contentIframe">
                                        <?php echo strtoupper($row1["VIDEO_TITULO"]); ?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }

                    $conn->close();
                    ?>
                </table>
            </div>
            <div class="contentIframe">
                <iframe src="" name="contentIframe" frameborder="0" sandbox="allow-same-origin allow-scripts"></iframe>
            </div>
        </div>
    </div>
</body>

<script defer src="view/js/global/screen_lock.js"></script>
<script defer>
    var botones = document.querySelectorAll(".buttonSimposio");

    // Agregar un controlador de eventos clic a cada botón
    botones.forEach(function (boton) {
        boton.addEventListener("click", function (event) {
            event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

            // Obtener los valores necesarios
            var useremail = "<?php echo $_SESSION['useremail']; ?>";
            var ip_cliente = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
            var simposio = boton.textContent; // Obtener el texto del enlace actual

            // Realizar una solicitud AJAX para insertar los datos en la base de datos
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "model/courses/insertar_log.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // La solicitud se ha completado con éxito
                    console.log("Datos insertados en el registro de usuario.");
                }
            };
            xhr.send("useremail=" + useremail + "&ip_cliente=" + ip_cliente + "&simposio=" + simposio);

            // Cargar el enlace en el iframe
            var iframe = document.querySelector("iframe[name='contentIframe']");
            iframe.src = boton.href;
        });
    });
</script>

</html>