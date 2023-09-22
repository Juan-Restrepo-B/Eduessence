<?php
session_start();

// Conexión a la base de datos (debes configurar estos valores)
include('conexion.php');

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
        header('main.php');
    } else {
        echo "Error al cambiar la clave: " . $conn->error;
    }
} else {
    echo "Las contraseñas no coinciden.";
}

// Cerrar la conexión
$conn->close();
?>
