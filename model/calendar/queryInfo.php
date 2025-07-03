<?php
include_once 'conexionCalendar.php';

$conn->query("SET lc_time_names = 'es_ES'");

$sql = "SELECT 
		cal_fecha_in AS Fecha, 
		cal_fecha_out AS FechaOut,
		DAY(cal_fecha_in) AS Dia, 
		DATE_FORMAT(cal_fecha_in, '%b') AS MesIn,
		DATE_FORMAT(cal_fecha_in, '%W') AS LDia,
		TIME_FORMAT(cal_fecha_in, '%H:%i:%s') AS HoraIn, 
		TIME_FORMAT(cal_fecha_out, '%H:%i:%s') AS HoraOut, 
		cal_ubicacion, cal_speaker, cal_pais, cal_description, cal_event
	FROM Calendar_Principal
        WHERE cal_fecha_in >= CONVERT_TZ(NOW(), '+00:00', '-05:00')
    ";
$resultado = $conn->query($sql);

if (!$resultado) {
	die("Query failed: " . $conn->error);
}

?>