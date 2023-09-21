<?php

// Configuración de la base de datos
$host = "68.178.246.37";
$user = "Desarrollo";
$pass = "y9B>^y=>FT+G`C@,";
$database = "Eduessence";

// Conexión a la base de datos
$conn = mysqli_connect($host, $user, $pass, $database);

// Configura la conexión a la base de datos con UTF-8
mysqli_set_charset($conn, "utf8");
?>