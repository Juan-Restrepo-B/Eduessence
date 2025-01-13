<?php
function showButtons($buttonNumber)
{
    // include_once '../conexion.php';

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

    $usuario = $_SESSION['useremail'];

    $sql = "SELECT PERMISSION_USER, PERMISSION_IDTIPPERMISSION
    FROM UN_PERMISSIONS WHERE PERMISSION_USER = '" . $usuario . "'";

    // Preparar la consulta
    $stmt = $conn->query($sql);

    while ($mostrar = mysqli_fetch_array($stmt)) {

        $user_permission = $mostrar['PERMISSION_IDTIPPERMISSION'];

        if ($user_permission == 1) { // Administrador
            return true;
        } elseif ($user_permission == 2) {
            return in_array($buttonNumber, [2]);
        } elseif ($user_permission == 5) {
            return in_array($buttonNumber, []);
        } elseif ($user_permission == 3) {
            return in_array($buttonNumber, []);
        } elseif ($user_permission == 4) {
            return in_array($buttonNumber, []);
        }

        return false;
    }
}
?>