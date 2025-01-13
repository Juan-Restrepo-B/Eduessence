<?php
$host = "68.178.246.37";
$user = "Desarrollo";
$pass = "y9B>^y=>FT+G`C@,";
$database = "Eduessence_Calendar";

$conn = mysqli_connect($host, $user, $pass, $database);

mysqli_set_charset($conn, "utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>