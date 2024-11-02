<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

include("conexion.php");

if (isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
}

$sql = "SELECT 
            IDCURSOS,
            CURSO_NOMBRE, 
            CURSO_LOGOIMG,
            INFO_MININFO,
            CURSO_FECHINS,
            CURSO_FECHSTART,
            CURSO_FECHFIN
        FROM
            TR_CURSOS
            INNER JOIN TR_INFOCURSO ON INFO_IDCURSO = IDCURSOS
        WHERE
             IDCURSOS = '" . $idcurso . "' ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/styles_curso.css">
    </head>

    <body>
        <section>
            <div class="header">
                <a href="index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
                    </svg>
                </a>
            </div>
        </section>
        <section class="pd-10">
            <div class="infoPrin">
                <h1><?php echo $row["CURSO_NOMBRE"]; ?></h1>
                <h4><?php echo $row["INFO_MININFO"]; ?></h4>
                <div class="flex">
                    <p class="font10">Fecha limite de inscripcion:
                        <?php echo date("d-M-Y", strtotime($row["CURSO_FECHINS"])); ?></p>
                    <p class="font10">Fecha inicio curso:
                        <?php echo date("d-M-Y g:i a", strtotime($row["CURSO_FECHSTART"])); ?></p>
                    <?php
                    // Restar 30 minutos a la fecha de fin del curso
                    $fechaFinCurso = strtotime($row["CURSO_FECHFIN"]);
                    $fechaFinCursoMenos30Min = $fechaFinCurso - 1800; // Restar 30 minutos (30*60 segundos)
                    ?>
                    <p class="font10">Fecha fin curso: <?php echo date("d-M-Y g:i a", $fechaFinCursoMenos30Min); ?></p>
                </div>
            </div>
        </section>
        <section class="flo white" >
            <div>
            <img src="../img/logos/<?php echo $row["CURSO_LOGOIMG"]; ?>" alt="Logo Curso">
            <br>
            <button>INSCRIBIRSE</button>
            </div>
        </section>
        <section class="white w-100">

        </section>
    </body>
    <?php
}
?>

</html>