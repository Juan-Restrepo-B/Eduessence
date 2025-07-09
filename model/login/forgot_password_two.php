<?php
session_start();

// Conxion con BD
include_once '../conexion.php';

// Variables
$color = 'red';
$currentHour = date('H');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibir el correo electrónico y la contraseña enviados por el usuario
    $password = $_POST["password"];
    $passwordconfirm = $_POST["passwordconfirm"];
    $usuario = $_SESSION['useremail'];

    // Verificar si las contraseñas coinciden
    if ($password !== $passwordconfirm) {
        $error_message = "Las contraseñas no coinciden.";
        header("Location: /forgot_password_two?error=" . urlencode($error_message) . "&color=" . urlencode($color));
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Preparar la consulta SQL para actualizar la contraseña
    $sql = "UPDATE TR_USUARIOS SET USUARIO_CLAVE = ? WHERE IDUSUARIO = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashedPassword, $usuario);
    if ($stmt->execute()) {

        $sql = "SELECT 
                    USUARIO_NOMBRE
                FROM
                    TR_USUARIOS 
                    INNER JOIN TR_PERSONA ON USUARIO_NOMBRE = PERSONA_CORREO 
                WHERE
                    IDUSUARIO = ? AND PERSONA_ESTADO = 'ACTIVO'";
        // Preparar la consulta
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $_SESSION['useremail'] = $row["USUARIO_NOMBRE"]; // O el campo que desees mantener en la sesión
        }

        header("Location: /principal");
        exit();
    } else {
        $error_message = "No se pudo actualizar la contraseña.";
        header("Location: /forgot_password_two?error=" . urlencode($error_message) . "&color=" . urlencode($color));
        exit();
    }

}

// Cerrar la conexión a la base de datos
$conn->close();
?>