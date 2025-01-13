<?php

// Conexión con BD
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

if (isset($_SESSION['useremail'])) {

    $currentUsername = $_SESSION['useremail'];

    $sql = "SELECT * FROM LOG_USUARIO WHERE LU_USUARIO_USER = '$currentUsername' AND LU_RESULTACTION = 'Éxito' ORDER BY LU_FECHORA DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastEvent = $row["LU_ACTIONEVNET"];
        $lastResultAction = $row["LU_RESULTACTION"];

        if ($lastEvent === "INICIO DE SESIÓN" && $lastResultAction === "Éxito") {

            $useremail = $_SESSION['useremail'];
            $ip_cliente = $_SERVER['REMOTE_ADDR'];

            $sql = "INSERT INTO LOG_USUARIO
            (LU_FECHORA, LU_USUARIO_USER, LU_DIRECCIONIP, LU_ACTIONEVNET, LU_RESULTACTION, LU_DETALLE, LU_ESTADO)
            VALUES(NOW(), ?, ?, 'INICIO DE SESIÓN', 'Fallido', 'Inicio de sesión fallido ya cuenta con una sesion iniciada', 'ACTIVO')";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("ss", $useremail, $ip_cliente);

            $stmt->execute();

            header("Location: ../index.php");
            exit();
        } elseif ($lastEvent === "CERRAR SESIÓN" && $lastResultAction === "Éxito") {

            $useremail = $_SESSION['useremail'];
            $ip_cliente = $_SERVER['REMOTE_ADDR'];

            $sql = "INSERT INTO LOG_USUARIO
            (LU_FECHORA, LU_USUARIO_USER, LU_DIRECCIONIP, LU_ACTIONEVNET, LU_RESULTACTION, LU_DETALLE, LU_ESTADO)
            VALUES(NOW(), ?, ?, 'INICIO DE SESIÓN', 'Éxito', 'Inicio de sesión exitoso', 'ACTIVO')";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("ss", $useremail, $ip_cliente);

            $stmt->execute();
        }
    }
}
?>