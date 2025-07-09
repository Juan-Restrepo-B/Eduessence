<?php
session_start();

// Conxion con BD
include_once '../conexion.php';

// Variables
$color = 'red';
$currentHour = date('H');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibir el correo electrónico y la contraseña enviados por el usuario
    $email = $_POST["email"];

    // Realizar la consulta SQL para verificar las credenciales
    $sql = "SELECT 
                IDUSUARIO
            FROM
                TR_USUARIOS 
                INNER JOIN TR_PERSONA ON USUARIO_NOMBRE = PERSONA_CORREO 
            WHERE
                USUARIO_NOMBRE = ? AND PERSONA_ESTADO = 'ACTIVO'";
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    // Obtener el resultado de la consulta
    $result = $stmt->get_result();



    // Verificar si se encontró un usuario con ese correo electrónico
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        $useremail = $row["IDUSUARIO"];
        $_SESSION['useremail'] = $useremail;

        header("Location: /forgot_password_two"); // Redirigir a la página principal
        // Cerrar la consulta preparada
        $stmt->close();

        // Verificar si la contraseña es válida
        
    } else {
        $color = 'red';
        $error_message = "Usuario no encontrado.";
        // Cerrar la consulta preparada
        $stmt->close();
        header("Location: /forgot_password?error=" . urlencode($error_message) . "&color=" . urlencode($color));
        exit();
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>