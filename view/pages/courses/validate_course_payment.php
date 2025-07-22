<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

include("../../../model/conexion.php");

$sql = "SELECT
            uc.ID AS ID_COMPRA,
            tc.CURSO_NOMBRE AS NOMBRE_CURSO,
            CONCAT(tp.PERSONA_NOMBRES, ' ', tp.PERSONA_APELLIDOS) AS NOMBRE_APELLIDOS,
            uc.COMPRA_OBSERVACION AS REFERENCIA
        FROM 
        UN_COMPRAS uc
        INNER JOIN TR_PERSONA tp ON tp.PERSONA_CORREO = uc.COMPRA_USUARIO
        INNER JOIN TR_CURSOS tc ON tc.IDCURSOS = uc.COMPRA_CURSO_ID
        LEFT JOIN CP_CUPON cc ON cc.NROCUPON = uc.COMPRA_OBSERVACION
        WHERE
            1 = 1
            AND uc.ESTADO_COMPRA = 'PENDIENTE CONFIRMACION'
            AND cc.IDCUPON IS NULL";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/courses/validate_course_payment.css">
    <title>CURSOS</title>
</head>

<body>
    <section>
        <div class="patrocinadores">
            <div class="title">
                <h1>VALIDAR PAGOS CURSOS</h1>
            </div>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>NOMBRE CURSO</th>
                            <th>NOMBRE Y APELLIDO</th>
                            <th>REFERENCIA PAGO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td data-label='NOMBRE CURSO'>" . $row['NOMBRE_CURSO'] . "</td>";
                                echo "<td data-label='NOMBRE Y APELLIDO'>" . $row['NOMBRE_APELLIDOS'] . "</td>";
                                echo "<td data-label='REFERENCIA PAGO'>" . $row['REFERENCIA'] . "</td>";
                                echo "<td data-label='ACCIONES'>
                                        <a href='http://localhost:8083/api/auth/congreso/validarPagoCurso/" . $row['ID_COMPRA'] . "' class='btn'>Validar Pago</a><br>
                                        <a href='http://localhost:8083/api/auth/congreso/rechazarPagoCongreso/" . $row['ID_COMPRA'] . "' class='btn rechazar'>Rechazar Pago</a>
                                    </td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

<script defer src="view/js/global/screen_lock.js"></script>

</html>