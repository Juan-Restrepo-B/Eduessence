<?php
session_start();

$usuario = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["newPassword"])) {
        $newPassword = $_POST["newPassword"];

        // Verificar si el usuario está autenticado y si $newPassword no está vacío
        if (!empty($usuario) && !empty($newPassword)) {
            // Hash de la nueva contraseña antes de almacenarla en la BD
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            include('conexion.php'); // Incluye el archivo de conexión a la base de datos

            // Actualizar la contraseña en la BD
            $updateSql = "UPDATE USERS SET PASS = '$hashedNewPassword' WHERE USER = '$usuario'";
            if ($conn->query($updateSql) === TRUE) {
                // La contraseña se cambió con éxito
                $response = array("success" => true);
                echo json_encode($response);
            } else {
                // Error al actualizar la contraseña
                $response = array("success" => false);
                echo json_encode($response);
            }

            // Cierra la conexión a la base de datos
            $conn->close();
        } else {
            // Datos incompletos
            $response = array("success" => false);
            echo json_encode($response);
        }
    }
}
?>