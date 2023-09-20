<?php
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
    $updateSql = "UPDATE USERS SET PASS = '$hashedNewPassword' WHERE USER = '$userID'";

    if ($conn->query($updateSql) === TRUE) {
        echo "La clave se ha cambiado con éxito.";
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
