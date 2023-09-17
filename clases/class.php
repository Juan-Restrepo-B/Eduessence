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

            // Obtener el classId deseado o usar uno predeterminado
            $classId = isset($_GET['classId']) ? $_GET['classId'] : 1;

            $sql = "SELECT id, title, video_url
            FROM classes WHERE id = $classId";

            //
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $classId = $row["id"];
                    $title = $row["title"];
                    $videoUrl = $row["video_url"];

                    echo "<div class='class'>";
                    echo "<h2>$title</h2>";
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