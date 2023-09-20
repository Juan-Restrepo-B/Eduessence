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
                <tr>
                    <td class title>SUMMIT 2023</td>
                </tr>
                <?php
                include("conexion.php");


                $sql = "SELECT id, title, video_url
            FROM classes";
                $result = $conn->query($sql);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="cal">
                                <a href="class.php?classId=<?php echo $row["id"]; ?>" class="mostrarFormulario5"
                                    target="contentIframe">
                                    <?php echo strtoupper($row["title"]); ?>
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
            <iframe src="class.php?classId=1" name="contentIframe" frameborder="0"></iframe>
        </div>
    </div>
</body>

</html>