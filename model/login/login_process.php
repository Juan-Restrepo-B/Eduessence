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
    $password = $_POST["password"];

    // Realizar la consulta SQL para verificar las credenciales
    $sql = "SELECT 
                USUARIO_USER,
                USUARIO_CLAVE, 
                USUARIO_NOMBRE 
            FROM
                TR_USUARIOS 
                INNER JOIN TR_PERSONA ON USUARIO_NOMBRE = PERSONA_CORREO 
            WHERE
                (USUARIO_USER = ? OR USUARIO_NOMBRE = ?)AND PERSONA_ESTADO = 'ACTIVO'";
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario con ese correo electrónico
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["USUARIO_CLAVE"];

        // Verificar si la contraseña es válida
        if (password_verify($password, $storedPassword)) {

            // Las credenciales son válidas, iniciar sesión
            $useremail = $row["USUARIO_NOMBRE"];
            $_SESSION['useremail'] = $useremail; // Store the value in the session

            header("Location: /principal"); // Redirigir a la página principal
            // Cerrar la consulta preparada
            $stmt->close();
            exit();
        } else {
            $color = 'red';
            $error_message = "Contraseña incorrecta.";
            // Cerrar la consulta preparada
            $stmt->close();
            header("Location: /login?error=" . urlencode($error_message) . "&color=" . urlencode($color));
            exit();
        }
    } else {
        $color = 'red';
        $error_message = "Usuario no encontrado.";
        // Cerrar la consulta preparada
        $stmt->close();
        header("Location: /login?error=" . urlencode($error_message) . "&color=" . urlencode($color));
        exit();
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>