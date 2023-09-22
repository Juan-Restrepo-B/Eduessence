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
                    echo "<video src='videos/$videoUrl' controls controlsList='nodownload'></video>";
                    echo "<input type='hidden' class='class-id' value='$classId'>";
                    echo "</div>";
                }
            }
            $conn->close();
            ?>
        </div>
    </div>
    <script defer type="text/javascript">
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        document.addEventListener('selectstart', function (e) {
            e.preventDefault();
        });
    </script>

</body>

</html>