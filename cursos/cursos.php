<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

date_default_timezone_set('America/Bogota');

include("conexion.php");

if (isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
}

$infCurso = "SELECT 
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
$resultinfoCurso = $conn->query($infCurso);

$valCurso = "SELECT IDCURSOS FROM UN_CARRERA uc 
                INNER JOIN TR_CURSOS tc ON uc.CARRERA_IDCURSO = tc.IDCURSOS
                WHERE CARRERA_CURESTADO = 'ACTIVO'
                AND IDCURSOS = '" . $idcurso . "'
                AND CARRERA_USUARIO_NOMBRE = '" . $usuario . "'";
$valiCurso = $conn->query($valCurso);

$valIdCurso = null; // Inicializamos $valIdCurso para evitar el warning

if ($resultinfoCurso->num_rows > 0) {
    $rowinfcurso = $resultinfoCurso->fetch_assoc();

    if ($valiCurso && $valiCurso->num_rows > 0) {
        $rowvaliCurso = $valiCurso->fetch_assoc();
        $valIdCurso = $rowvaliCurso["IDCURSOS"]; // Se asigna si hay resultados
    }

    $fechRegistro = $rowinfcurso["CURSO_FECHINS"];
    $fechaRegistro = new DateTime($fechRegistro);
    $fechaActual = new DateTime();
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
        <section class="pd-10 flx-rig">
            <div class="infoPrin">
                <h1><?php echo $rowinfcurso["CURSO_NOMBRE"]; ?></h1>
                <h4><?php echo $rowinfcurso["INFO_MININFO"]; ?></h4>
                <div class="flex">
                    <p class="font10">Fecha limite de inscripcion:
                        <?php echo date("d-M-Y", strtotime($rowinfcurso["CURSO_FECHINS"])); ?>
                    </p>
                    <p class="font10">Fecha inicio curso:
                        <?php echo date("d-M-Y g:i a", strtotime($rowinfcurso["CURSO_FECHSTART"])); ?>
                    </p>
                    <?php
                    // Restar 30 minutos a la fecha de fin del curso
                    $fechaFinCurso = strtotime($rowinfcurso["CURSO_FECHFIN"]);
                    $fechaFinCursoMenos30Min = $fechaFinCurso - 1800; // Restar 30 minutos (30*60 segundos)
                    ?>
                    <p class="font10">Fecha fin curso: <?php echo date("d-M-Y g:i a", $fechaFinCursoMenos30Min); ?></p>
                </div>
            </div>
            <div class="sponsor">
                <img src="../img/logos/<?php echo $rowinfcurso["CURSO_LOGOIMG"]; ?>" alt="Logo Curso">
                <br>
                <?php
                if ($valIdCurso == null) {
                    if ($fechaRegistro > $fechaActual) {
                        ?>
                        <a href="" class="btn">INSCRIBIRSE</a>
                        <?php
                    }
                } else {
                    ?>
                    <a href="transmision.php?idcurso=<?php echo $rowinfcurso["IDCURSOS"]; ?>" class="btn">VER</a>
                    <?php
                }
                ?>
            </div>
        </section>
        <section class="white w-100">

        </section>
    </body>
    <?php
}
?>

</html>