<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

date_default_timezone_set('America/Bogota');

include("../../../model/conexion.php");

if (isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
}

$infCurso = "SELECT * FROM TR_CURSOS
            INNER JOIN TR_INFOCURSO ON INFO_IDCURSO = IDCURSOS
            WHERE IDCURSOS = '$idcurso'";
$resultinfoCurso = $conn->query($infCurso);

$valCurso = "SELECT IDCURSOS FROM UN_CARRERA uc
            INNER JOIN TR_CURSOS tc ON uc.CARRERA_IDCURSO = tc.IDCURSOS
            WHERE CARRERA_CURESTADO = 'ACTIVO'
            AND IDCURSOS = '$idcurso'
            AND CARRERA_USUARIO_NOMBRE = '$usuario'";
$valiCurso = $conn->query($valCurso);

$valIdCurso = null;

$estadoCompra = null;
$valPago = "SELECT ESTADO_COMPRA FROM UN_COMPRAS
            WHERE COMPRA_CURSO_ID = '$idcurso' AND COMPRA_USUARIO = '$usuario'
            ORDER BY COMPRA_FECHA DESC LIMIT 1";
$valiPago = $conn->query($valPago);

if ($valiPago && $valiPago->num_rows > 0) {
    $estadoCompra = $valiPago->fetch_assoc()['ESTADO_COMPRA'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnCompra'])) {
    $observacion = $conn->real_escape_string($_POST['observacion']);
    $fechaCompra = date('Y-m-d H:i:s');

    // Insertar en UN_COMPRAS
    $insertCompra = "INSERT INTO UN_COMPRAS (COMPRA_USUARIO, COMPRA_CURSO_ID, COMPRA_OBSERVACION, COMPRA_FECHA, ESTADO_COMPRA)
                    VALUES ('$usuario', '$idcurso', '$observacion', '$fechaCompra', 'PENDIENTE CONFIRMACION')";

    if ($conn->query($insertCompra) === TRUE) {
        // Obtener fecha de inicio del curso
        $fechInicioRes = $conn->query("SELECT CURSO_FECHSTART FROM TR_CURSOS WHERE IDCURSOS = '$idcurso'");
        $fechInicio = $fechInicioRes->fetch_assoc()["CURSO_FECHSTART"];

        // Insertar en UN_CARRERA
        $inscripcion = "INSERT INTO UN_CARRERA (CARRERA_USUARIO_NOMBRE, CARRERA_IDCURSO, CARRERA_FECHINIT, 
                        CARRERA_FECHVENC, CARRERA_CURESTADO, CARRERA_CERTESTADO, CARRERA_IDTIPARTICIPANTE)
                        VALUES ('$usuario', '$idcurso', '$fechInicio', NULL, 'ACTIVO', 'NO', 'ASISTENTE')";
        $conn->query($inscripcion);

        echo "<script>
            alert('Compra registrada e inscripción exitosa.');
        </script>";
        header("Location: curso_info?idcurso=$idcurso");
    } else {
        echo "<script>alert('Error al registrar la compra: " . $conn->error . "');</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnInscribir'])) {
    $fechInicioRes = $conn->query("SELECT CURSO_FECHSTART FROM TR_CURSOS WHERE IDCURSOS = '$idcurso'");
    $fechInicio = $fechInicioRes->fetch_assoc()["CURSO_FECHSTART"];

    $inscripcion = "INSERT INTO UN_CARRERA (CARRERA_USUARIO_NOMBRE, CARRERA_IDCURSO, CARRERA_FECHINIT, 
                    CARRERA_FECHVENC, CARRERA_CURESTADO, CARRERA_CERTESTADO, CARRERA_IDTIPARTICIPANTE)
                    VALUES ('$usuario', '$idcurso', '$fechInicio', NULL, 'ACTIVO', 'NO', 'ASISTENTE')";

    if ($conn->query($inscripcion) === TRUE) {
        header("Location: transmision.php?idcurso=$idcurso");
        exit();
    } else {
        echo "<script>console.log('Error: " . $conn->error . "');</script>";
    }
}

if ($resultinfoCurso->num_rows > 0) {
    $rowinfcurso = $resultinfoCurso->fetch_assoc();

    if ($valiCurso && $valiCurso->num_rows > 0) {
        $rowvaliCurso = $valiCurso->fetch_assoc();
        $valIdCurso = $rowvaliCurso["IDCURSOS"];
    }


    $fechaRegistro = new DateTime($rowinfcurso["CURSO_FECHINS"]);
    $fechaActual = new DateTime();

    $aprenderas = $rowinfcurso["INFO_APRENDERAS"];
    $temasAprender = explode(",", $aprenderas);

    $temas = $rowinfcurso['INFO_TEMAS'];
    $tituloTemas = explode(";", $temas);

    $conferencista = $rowinfcurso["INFO_CONFERENCISTAS"];
    $conferencistaCurso = explode(",", $conferencista);

    $precioNum = $rowinfcurso["INFO_PRECIO"];
    $precioTexto = $precioNum > 0 ? number_format($precioNum, 0, ',', '.') : "GRATIS";

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
                    <h4 class="w60"><?php echo $rowinfcurso["INFO_DESCRIPCORTA"]; ?></h4>
                    <div class="flex">
                        <p>Fecha límite de inscripción: <span
                                class="red"><?php echo date("d-M-Y", strtotime($rowinfcurso["CURSO_FECHINS"])); ?></span>
                        </p>
                        <p>Fecha inicio: <span
                                class="green"><?php echo date("d-M-Y g:i a", strtotime($rowinfcurso["CURSO_FECHSTART"])); ?></span>
                        </p>
                        <p>Fecha fin: <span
                                class="blue"><?php echo date("d-M-Y g:i a", strtotime($rowinfcurso["CURSO_FECHFIN"]) - 1800); ?></span>
                        </p>
                    </div>
                </div>
                <div class="sponsor item-40">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($rowinfcurso['CURSO_LOGOIMG']); ?>"
                        alt="Logo Curso">
                    <h2>Precio: <span class="red"><?php echo $precioTexto; ?></span></h2>
                    <?php
                    if ($fechaRegistro > $fechaActual) {
                        if ($precioNum > 0) {
                            // Usuario no inscrito aún
                            if ($estadoCompra === 'PENDIENTE CONFIRMACION') {
                                echo '<button type="button" class="btn" disabled>PAGO PENDIENTE CONFIRMACIÓN</button>';
                            } elseif ($estadoCompra === 'CONFIRMADO') {
                                echo '<a href="curso_live?idcurso=' . $idcurso . '" class="btn">VER</a>';
                            } elseif ($estadoCompra === 'RECHAZADO') {
                                echo '<button type="button" class="btn" onclick="abrirModal()">CONFIRMAR PAGO</button>';
                            } else {
                                echo '<button type="button" class="btn" onclick="abrirModal()">COMPRAR</button>';
                            }
                        } else {
                            // Curso gratis
                            if ($valIdCurso === null) {
                                echo '<form method="POST"><button type="submit" name="btnInscribir" class="btn">INSCRIBIRSE</button></form>';
                            } else {
                                echo '<a href="curso_live?idcurso=' . $idcurso . '" class="btn">VER</a>';
                            }
                        }
                    } else {
                        // Fuera de fecha de inscripción
                        if ($valIdCurso !== null || $estadoCompra === 'CONFIRMADO') {
                            echo '<a href="curso_live?idcurso=' . $idcurso . '" class="btn">VER</a>';
                        }
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
        <!-- Modal de Compra -->
        <div id="compraModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="cerrarModal()">&times;</span>
                <h2 style="color:#3333cc">Confirmar Compra</h2>
                <p>Realice el pago a:</p>
                <p>Banco: <strong>Davivienda</strong></p>
                <p>Cuenta Ahorros: <strong>473000099357</strong></p>
                <p>SWIFT: <strong>CAFECOBB</strong></p>
                <p>NIT: <strong>901.281.721-5</strong></p>
                <form method="POST">
                    <label for="observacion">Referencia de pago o código:</label><br>
                    <input type="text" name="observacion" required class="referenciaPago"><br><br>
                    <button type="submit" name="btnCompra" class="btn">Confirmar Compra</button>
                </form>
            </div>
        </div>

        <script>
            function abrirModal() {
                document.getElementById('compraModal').style.display = 'block';
            }
            function cerrarModal() {
                document.getElementById('compraModal').style.display = 'none';
            }
        </script>

        <script src="view\js\courses\courses_info.js"></script>

        <style>
            .modal {
                position: fixed;
                z-index: 9999;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fff;
                margin: 10% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 30%;
                border-radius: 20px;
            }

            .close {
                float: right;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }

            .referenciaPago {
                width: 100%;
                padding: 10px;
                margin-top: 10px;
                border: 1px solid #3333cc;
                border-radius: 4px;
            }
        </style>
    </body>

    </html>

    <?php
}
?>