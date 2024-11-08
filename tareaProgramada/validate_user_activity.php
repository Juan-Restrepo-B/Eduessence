<?php
session_start();

$username = $_SESSION['useremail'];
$fechaActual = new DateTime();

include("conexion.php");

function validateUserActivity($conn, $fechaActual, $username) {
    // Obtener las fechas de inicio y fin del curso
    $stmt = $conn->prepare("SELECT CURSO_FECHSTART, CURSO_FECHFIN, IDCURSOS FROM TR_CURSOS WHERE CURSO_FECHFIN = ?");
    $fechaActualStr = $fechaActual->format('Y-m-d');
    $stmt->bind_param("s", $fechaActualStr);
    $stmt->execute();
    $resultCurso = $stmt->get_result();

    while ($rowCurso = $resultCurso->fetch_assoc()) {
        $cursoFechStart = $rowCurso["CURSO_FECHSTART"];
        $cursoFechFin = $rowCurso["CURSO_FECHFIN"];
        $idCurso = $rowCurso["IDCURSOS"];

        $fechaInicio = new DateTime($cursoFechStart);
        $fechaFin = new DateTime($cursoFechFin);

        // Verificar si la fecha actual es igual a la fecha de fin del curso
        if ($fechaActual->format('Y-m-d') == $fechaFin->format('Y-m-d')) {
            // Calcular el número total de intervalos de 30 minutos entre las fechas de inicio y fin del curso
            $interval = new DateInterval('PT30M');
            $period = new DatePeriod($fechaInicio, $interval, $fechaFin);
            $totalIntervals = iterator_count($period);

            // Contar el número de registros de actividad del usuario
            $stmtLog = $conn->prepare("SELECT COUNT(*) as activityCount FROM user_activity_log WHERE user_email = ? AND idCurso = ?");
            $stmtLog->bind_param("si", $username, $idCurso);
            $stmtLog->execute();
            $resultLog = $stmtLog->get_result();
            $rowLog = $resultLog->fetch_assoc();
            $activityCount = $rowLog["activityCount"];

            // Calcular el porcentaje de actividad
            $activityPercentage = ($activityCount / $totalIntervals) * 100;

            // Verificar si el porcentaje de actividad es mayor o igual al 70%
            if ($activityPercentage >= 70) {
                // Actualizar el estado del certificado
                $stmtUpdate = $conn->prepare("UPDATE Eduessence.UN_CARRERA SET CARRERA_CERTESTADO = 'SI' WHERE CARRERA_USUARIO_NOMBRE = ? AND CARRERA_IDCURSO = ?");
                $stmtUpdate->bind_param("si", $username, $idCurso);
                $stmtUpdate->execute();
                $stmtUpdate->close();
            }
            $stmtLog->close();
        }
    }
    $stmt->close();
}

validateUserActivity($conn, $fechaActual, $username);
?>