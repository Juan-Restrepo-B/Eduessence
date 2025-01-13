<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

date_default_timezone_set('America/Bogota');

include("../../../model/conexion.php");

if (isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
}

$infCurso = "SELECT 
                *
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

    $aprenderas = $rowinfcurso["INFO_APRENDERAS"];
    $temasAprender = explode(",", $aprenderas);

    $temas = $rowinfcurso['INFO_TEMAS'];
    $tituloTemas = explode(";", $temas);

    $conferencista = $rowinfcurso["INFO_CONFERENCISTAS"];
    $conferencistaCurso = explode(",", $conferencista);

    $fechInicio = $rowinfcurso["CURSO_FECHSTART"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ejecuta la inserción
        $inscripcion = "INSERT INTO UN_CARRERA (CARRERA_USUARIO_NOMBRE, CARRERA_IDCURSO, CARRERA_FECHINIT, CARRERA_FECHVENC, CARRERA_CURESTADO, CARRERA_CERTESTADO, CARRERA_IDTIPARTICIPANTE)
        VALUES ('$usuario', '$idcurso', '$fechInicio', NULL, 'ACTIVO', 'NO', 'ASISTENTE')";

        if ($conn->query($inscripcion) === TRUE) {
            header("Location: transmision.php?idcurso=" . $idcurso);
            exit();
        } else {
            echo "<script>console.log('Error: " . $conn->error . "');</script>";
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="view/css/courses/styles_courses_info.css">
    </head>

    <body>
        <section class="fon-blue">
            <section>
                <div class="header">
                    <a href="/cursos">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                            <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z">
                            </path>
                        </svg>
                    </a>
                </div>
            </section>
            <section class="pd-10 flx-rig">
                <div class="infoPrin item-60">
                    <h1><?php echo $rowinfcurso["CURSO_NOMBRE"]; ?></h1>
                    <br>
                    <h4 class="w60"><?php echo $rowinfcurso["INFO_DESCRIPCORTA"]; ?></h4>
                    <br>
                    <div class="flex">
                        <p class="font10">Fecha limite de inscripcion: <span class="red">
                                <?php echo date("d-M-Y", strtotime($rowinfcurso["CURSO_FECHINS"])); ?></span>
                        </p>
                        <p class="font10">Fecha inicio curso: <span class="green">
                                <?php echo date("d-M-Y g:i a", strtotime($rowinfcurso["CURSO_FECHSTART"])); ?></span>
                        </p>
                        <?php
                        // Restar 30 minutos a la fecha de fin del curso
                        $fechaFinCurso = strtotime($rowinfcurso["CURSO_FECHFIN"]);
                        $fechaFinCursoMenos30Min = $fechaFinCurso - 1800; // Restar 30 minutos (30*60 segundos)
                        ?>
                        <p class="font10">Fecha fin curso: <span
                                class="blue"><?php echo date("d-M-Y g:i a", $fechaFinCursoMenos30Min); ?></span>
                        </p>
                    </div>
                </div>
                <div class="sponsor item-40">
                    <?php
                    $blob = $rowinfcurso['CURSO_LOGOIMG'];
                    $base64 = base64_encode($blob);
                    
                    if (isset($base64)): ?>
                        <img src="data:image/jpeg;base64,<?php echo $base64; ?>" alt="Logo Curso">
                    <?php else: ?>
                        <p>No se pudo cargar la imagen.</p>
                    <?php endif; ?>
                    <br>
                    <?php
                    if ($valIdCurso == null) {
                        if ($fechaRegistro > $fechaActual) {
                            ?>
                            <form id="inscripcionForm" method="POST" action="">
                                <button type="submit" class="btn">INSCRIBIRSE</button>
                            </form>
                            <?php
                        }
                    } else {
                        ?>
                        <a href="/curso_live?idcurso=<?php echo $rowinfcurso["IDCURSOS"]; ?>" class="btn">VER</a>
                        <?php
                    }
                    ?>
                </div>
            </section>
        </section>
        <section class="pd-10 tp-1 white w-100">
            <?php if ($aprenderas != null) { ?>
                <div class="contenido-aprenderas">
                    <h2>CONTENIDO DEL <?php echo $rowinfcurso["CURSO_NOMBRE"]; ?></h2>
                    <ul>
                        <?php foreach ($temasAprender as $index => $temaAprender): ?>
                            <li class="<?php echo $index >= 6 ? 'extra' : ''; ?>">
                                <?php echo trim($temaAprender); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#" id="verMas" class="view-toggle" onclick="toggleAprenderas(event)">Ver más <span>▼</span></a>
                </div>
            <?php } ?>
            <?php if ($temas != null) { ?>
                <div class="course-content tp-3 ">
                    <h2>TEMARIO DEL <?php echo $rowinfcurso["CURSO_NOMBRE"]; ?></h2>
                    <?php
                    echo '<div class="course-content">';

                    // Recorrer cada tema
                    foreach ($tituloTemas as $tema) {
                        $partes = explode(":", $tema); // Divide título y subtemas
                        if (count($partes) == 2) {
                            $titulo = trim($partes[0]); // Título del tema
                            $subtemas = explode(",", $partes[1]); // Subtemas separados por coma
            
                            echo "<div class='section'>";
                            echo "<h2 onclick='toggleSection(this)'>" . htmlspecialchars($titulo) . "</h2>";
                            echo "<div class='lessons' style='display: none;'>";
                            echo "<ul>";

                            // Recorrer subtemas y mostrarlos en lista
                            foreach ($subtemas as $subtema) {
                                echo "<li>" . htmlspecialchars(trim($subtema)) . "</li>";
                            }

                            echo "</ul>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }

                    echo '</div>';

                    ?>
                </div>
            <?php } ?>
            <?php if ($conferencista != null) { ?>
                <div class="contenido-aprenderas">
                    <h2>CONFERENCISTAS INVITADOS AL <?php echo $rowinfcurso["CURSO_NOMBRE"]; ?></h2>
                    <ul>
                        <?php foreach ($conferencistaCurso as $index => $confe): ?>
                            <li class="<?php echo $index >= 6 ? 'extra' : ''; ?>">
                                <?php echo trim($confe); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#" id="verMas" class="view-toggle" onclick="toggleAprenderas(event)">Ver más <span>▼</span></a>
                </div>
            <?php } ?>
        </section>
    </body>
    <?php
}
?>

<script defer src="view/js/global/screen_lock.js"></script>
<script defer src="view/js/courses/courses_info.js"></script>

</html>