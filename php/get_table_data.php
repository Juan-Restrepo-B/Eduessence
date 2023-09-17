<?php
// Obtén el nombre de la tabla de la solicitud GET
$tableName = isset($_GET['table']) ? $_GET['table'] : '';

// Realiza la consulta a la base de datos utilizando $tableName
include("conexion.php"); // Asegúrate de incluir tu archivo de conexión correctamente

$sql = "SELECT * FROM $tableName";

$result = mysqli_query($conn, $sql);

// Crear un arreglo para almacenar los datos
$tableData = array();

// Recorrer los resultados y agregarlos al arreglo
while ($mostrar = mysqli_fetch_array($result)) {
    $tableData[] = array(
        'tableData' => $_GET['table'],
        'cal_event' => $mostrar['cal_event']
    );
}

// Devolver los datos como respuesta JSON
header('Content-Type: application/json');
echo json_encode($tableData);
?>
