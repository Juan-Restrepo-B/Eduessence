<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_clases.css">
</head>

<body>
    <div class="container">

        <div class="class-list">
            <?php
            session_start();

            include("conexion.php");
            $ip_cliente = $_SERVER['REMOTE_ADDR'];

            // Obtener el classId deseado o usar uno predeterminado
            $classId = isset($_GET['classId']) ? $_GET['classId'] : 1;

            $sql = "SELECT IDVIDEO, VIDEO_TITULO, VIDEO_URL
            FROM TR_VIDEOS WHERE IDVIDEO = $classId";

            //
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $classId = $row["IDVIDEO"];
                    $title = $row["VIDEO_TITULO"];
                    $videoUrl = $row["VIDEO_URL"];

                    echo "<div class='class'><br>";
                    echo "<h2>$title</h2><br><br>";
                    echo "<video id='mi-video' src='videos/$videoUrl' controls controlsList='nodownload'></video>";
                    echo "<input type='hidden' class='class-id' value='$classId'>";
                    echo "</div>";
                }
            }
            $conn->close();
            ?>
            <div class="containerAlertLoad">
                <div class="alertLoad" id="loading-message" >
                    <h3>Cargando, por favor, espere ...</h3>
                </div>
            </div>
        </div>
    </div>
    <script defer type="text/javascript">
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    document.addEventListener('selectstart', function (e) {
        e.preventDefault();
    });

    // Función para ocultar el h3 cuando el iframe haya cargado
    var iframe = document.getElementById('mi-video');
    var loadingMessage = document.getElementById('loading-message');

    // Verifica si el elemento de video y el mensaje de carga existen
    if (iframe && loadingMessage) {
        iframe.addEventListener('loadedmetadata', function () {
            // Ocultar el elemento <h3> cuando el video ha cargado sus metadatos
            loadingMessage.style.display = 'none';
        });
    }
</script>


</body>

</html>