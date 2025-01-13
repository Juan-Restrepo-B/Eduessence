<?php
$host = "68.178.246.37";
$user = "Desarrollo";
$pass = "y9B>^y=>FT+G`C@,";
$database = "Eduessence";

$conn = mysqli_connect($host, $user, $pass, $database);

mysqli_set_charset($conn, "utf8");

date_default_timezone_set('America/Bogota');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>