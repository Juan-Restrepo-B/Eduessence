<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/notebook/style_notebook_class.css">
</head>

<body>
    <div class="container">

        <div class="class-list">
            <?php
            session_start();

            include("../../../model/conexion.php");
            $ip_cliente = $_SERVER['REMOTE_ADDR'];

            // Obtener el classId deseado o usar uno predeterminado
            $classId = isset($_GET['classId']) ? $_GET['classId'] : 1;

            $sql = "SELECT IDOCUMENT, DOCUMENT_TITULO, DOCUMENT_URL
            FROM TR_DOCUMENTS WHERE IDOCUMENT = $classId";

            //
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $classId = $row["IDOCUMENT"];
                    $title = $row["DOCUMENT_TITULO"];
                    $videoUrl = $row["DOCUMENT_URL"];

                    echo "<div class='class'><br>";
                    echo "<h2>$title</h2><br><br>";
                    echo "<iframe src='view/pages/notebook/document/$videoUrl' id='mi-iframe' frameborder='0'></iframe>";
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
</body>
<script defer type="text/javascript">
    // document.addEventListener('contextmenu', function (e) {
    //     e.preventDefault();
    // });


    // document.addEventListener('selectstart', function (e) {
    //     e.preventDefault();
    // });

    // Función para ocultar el h3 cuando el iframe haya cargado
    var iframe = document.getElementById('mi-iframe');
    var loadingMessage = document.getElementById('loading-message');

    iframe.addEventListener('load', function () {
        // Ocultar el elemento <h3> cuando el iframe ha cargado
        if (loadingMessage) {
            loadingMessage.style.display = 'none';
        }
    });
</script>

</html>