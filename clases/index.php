<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_form.css">
</head>

<body>
    <div class="container">
        <div class="list_class">
            <table>
                <?php
                session_start();

                $usuario = $_SESSION['useremail'];
                $ip_cliente = $_SERVER['REMOTE_ADDR'];

                include("conexion.php");

                $sql = "SELECT CURSO_NOMBRE, IDCURSOS FROM UN_CARRERA uc 
                INNER JOIN TR_CURSOS tc ON uc.CARRERA_IDCURSO = tc.IDCURSOS
                WHERE CARRERA_CURESTADO = 'ACTIVO'
                AND IDCURSOS = 1
                AND CARRERA_USUARIO_NOMBRE = '" . $usuario . "'";
                $result = $conn->query($sql);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class title>
                                <?php echo strtoupper($row["CURSO_NOMBRE"]); ?>
                            </td>
                        </tr>
                        <?php
                        $idCurso = $row["IDCURSOS"];

                        $sql1 = "SELECT IDVIDEO, VIDEO_TITULO
                        FROM UN_CARRERA uc
                        INNER JOIN TR_VIDEOS tv ON uc.CARRERA_IDCURSO = tv.VIDEO_IDCURSO
                        WHERE CARRERA_CURESTADO = 'ACTIVO'
                        AND tv.VIDEO_IDCURSO = '" . $idCurso . "'
                        GROUP BY IDVIDEO, VIDEO_TITULO";
                        $result1 = $conn->query($sql1);

                        if ($result1) {
                            while ($row1 = $result1->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td class="cal">
                                        <a href="class.php?classId=<?php echo $row1["IDVIDEO"]; ?>"
                                            class="mostrarFormulario5 buttonSimposio" target="contentIframe">
                                            <?php echo strtoupper($row1["VIDEO_TITULO"]); ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
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
</body>
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
            xhr.open("POST", "insertar_log.php", true);
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



    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    document.addEventListener('selectstart', function (e) {
        e.preventDefault();
    });
</script>

</html>