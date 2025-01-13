<?php
session_start();

// Conxion con BD
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

// Obtener datos del formulario
$userID = $_POST["userID"];
$newPassword = $_POST["newPassword"];
$confirmPassword = $_POST["confirmPassword"];

// Verificar que las contraseñas coincidan
if ($newPassword === $confirmPassword) {
    // Las contraseñas coinciden, actualizar la nueva clave
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updateSql = "UPDATE TR_USUARIOS SET USUARIO_CLAVE = '$hashedNewPassword' WHERE USUARIO_NOMBRE = '$userID'";

    if ($conn->query($updateSql) === TRUE) {

        $usuario = $_SESSION['useremail'];
        $ip_cliente = $_SERVER['REMOTE_ADDR'];

        $sql = "INSERT INTO LOG_USUARIO
        (LU_FECHORA, LU_USUARIO_USER, LU_DIRECCIONIP, LU_ACTIONEVNET, LU_RESULTACTION, LU_DETALLE, LU_ESTADO)
        VALUES(NOW(), ?, ?, 'CAMBIO DE CLAVE', 'Éxito', 'Cambio de clave exitoso', 'ACTIVO')";

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        // Asignar los valores utilizando bind_param o bindValue, por ejemplo:
        $stmt->bind_param("ss", $usuario, $ip_cliente);

        // Ejecutar la consulta
        $stmt->execute();
        header("Location: /usuario");
    } else {
        echo "Error al cambiar la clave: " . $conn->error;
    }
} else {
    echo "Las contraseñas no coinciden.";
}

// Cerrar la conexión
$conn->close();
?>
