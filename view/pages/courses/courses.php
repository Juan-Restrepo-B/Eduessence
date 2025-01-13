<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

include("../../../model/conexion.php");

$sql = "SELECT IDCURSOS, CURSO_NOMBRE, CURSO_LOGOIMG FROM TR_CURSOS WHERE CURSO_ESTADO = 'ACTIVO'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/courses/styles_courses.css">
    <title>CURSOS</title>
</head>

<body>
    <section>
        <div class="patrocinadores">
            <div class="title">
                <h1>CURSOS</h1>
            </div>
            <div class="gallery">
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {

                        $blob = $row['CURSO_LOGOIMG'];
                        $base64 = base64_encode($blob);

                        ?>
                        <a href="/curso_info?idcurso=<?php echo $row["IDCURSOS"]; ?>" class="sponsor">
                            <div>
                                <?php if (isset($base64)): ?>
                                    <img src="data:image/jpeg;base64,<?php echo $base64; ?>" alt="Logo Curso">
                                <?php else: ?>
                                    <p>No se pudo cargar la imagen.</p>
                                <?php endif; ?>
                                <h2>
                                    <?php echo strtoupper($row["CURSO_NOMBRE"]); ?>
                                </h2>
                            </div>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
</body>

<script defer src="view/js/global/screen_lock.js"></script>

</html>