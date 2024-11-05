<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

include("conexion.php");

$sql = "SELECT IDCURSOS, CURSO_NOMBRE, CURSO_LOGOIMG FROM TR_CURSOS ";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_index_dipl.css">
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
                        ?>
                        <a href="cursos.php?idcurso=<?php echo $row["IDCURSOS"]; ?>" class="sponsor">
                            <div>
                                <img src="../img/logos/<?php echo $row["CURSO_LOGOIMG"]; ?>" alt="Logo Curso">
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

<script>
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    document.addEventListener('selectstart', function (e) {
        e.preventDefault();
    });
</script>

</html>