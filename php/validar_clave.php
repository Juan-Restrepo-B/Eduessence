<?php
session_start();

$usuario = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["formerPassword"])) {
        $formerPassword = $_POST["formerPassword"];

        // Verificar si el usuario está autenticado y si $formerPassword no está vacío
        if (!empty($usuario) && !empty($formerPassword)) {
            include('conexion.php'); // Incluye el archivo de conexión a la base de datos

            // Consulta para obtener la contraseña almacenada en la BD
            $result = mysqli_query($conn, "SELECT PASS FROM USERS WHERE USER = '$usuario'");
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row["PASS"];

                // Verificar si la contraseña anterior ingresada coincide con la contraseña en la BD
                if (password_verify($formerPassword, $hashedPassword)) {
                    // La contraseña anterior es correcta
                    $response = array("success" => true);
                    echo json_encode($response);
                } else {
                    // La contraseña anterior es incorrecta
                    $response = array("success" => false);
                    echo json_encode($response);
                }
            } else {
                // Error al verificar la contraseña anterior
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
