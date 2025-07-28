<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

include("../../../model/conexion.php");

if (isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
}

$sql = "SELECT IDAUDITORIO, IDCURSO, NOMBRE_AUDITORIO, LLAVE_TRANSMISION FROM TR_AUDITORIOS WHERE IDCURSO = '$idcurso' ORDER BY NOMBRE_AUDITORIO ASC";

$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    header("Location: /curso_error");
    exit;
}

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
        <div class="header">
            <a href="/curso_info?idcurso=<?php echo $idcurso ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                    <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
                </svg>
            </a>
        </div>
    </section>
    <section>
        <div class="patrocinadores">
            <div class="title">
                <h1>AUDITORIOS</h1>
            </div>
            <div class="gallery">
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <a href="/curso_live?idauditorio=<?php echo $row["IDAUDITORIO"]; ?>" class="sponsor">
                            <div>
                                <h2>
                                    <?php echo strtoupper($row["NOMBRE_AUDITORIO"]); ?>
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