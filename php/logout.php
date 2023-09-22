<?php
session_start();

include('conexion.php');

// Verifica si se ha enviado una solicitud POST con el nombre "logout"
if (isset($_POST['logout'])) {
    // Verifica si el usuario está autenticado y tiene una sesión activa
    if (isset($_SESSION['useremail'])) {
        // Ejecuta el query de registro de cierre de sesión
        $sql = "INSERT INTO LOG_USUARIO
                (LU_FECHORA, LU_USUARIO_USER, LU_DIRECCIONIP, LU_ACTIONEVNET, LU_RESULTACTION, LU_DETALLE, LU_ESTADO)
                VALUES(NOW(), ?, ?, 'CERRAR SESIÓN', 'Éxito', 'Cierre de sesión exitoso', 'ACTIVO')";

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        // Vincular los valores a la consulta preparada
        $usuario = $_SESSION['useremail']; // Suponiendo que tengas una variable de sesión 'usuario'
        $direccionIP = $_SERVER['REMOTE_ADDR']; // Obtiene la dirección IP del cliente
        $stmt->bind_param("ss", $usuario, $direccionIP);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // La consulta se ejecutó con éxito

            // Cierra la consulta
            $stmt->close();

            // Cierra la sesión
            session_destroy();

            // Redirige al usuario a la página de inicio de sesión u otra página deseada
            header("Location: ../index.php");
            exit;
        } else {
            // Error al ejecutar el query SQL
            echo "Error al registrar el cierre de sesión.";
        }
    } else {
        // El usuario no está autenticado o la sesión no está activa
        echo "El usuario no está autenticado.";
    }
} else {
    // Si la solicitud POST no contiene "logout", redirige al usuario a la página principal o realiza otra acción.
    header("Location: ../index.php");
    exit;
}
?>
