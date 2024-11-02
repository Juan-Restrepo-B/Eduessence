<?php
session_start();

// Conexión con la BD
include("conexion.php");
$ip_cliente = $_SERVER['REMOTE_ADDR'];

// Establecer la zona horaria a "America/Bogota"
date_default_timezone_set('America/Bogota');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario de registro
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $password1 = $_POST["password1"];
    $hashedPassword = password_hash($password1, PASSWORD_BCRYPT); // Encriptar la contraseña

    $newUserName = substr($nombres, 0, 2) . $apellidos;

    // Iniciar la transacción
    $conn->begin_transaction();

    try {
        // Verificar si el correo ya está registrado
        $sql_check = "SELECT * FROM TR_PERSONA WHERE PERSONA_CORREO = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            echo "Este correo ya está registrado.";
            $conn->rollback();
        } else {
            // Insertar el nuevo usuario en TR_PERSONA
            $person = "INSERT INTO TR_PERSONA (PERSONA_NOMBRES, PERSONA_APELLIDOS, PERSONA_CORREO) VALUES (?, ?, ?)";
            $stmt_person = $conn->prepare($person);
            $stmt_person->bind_param("sss", $nombres, $apellidos, $email);

            if ($stmt_person->execute()) {
                // Insertar en TR_USUARIOS
                $userCreate = "INSERT INTO TR_USUARIOS (USUARIO_NOMBRE, USUARIO_CLAVE, USUARIO_USER) VALUES (?, ?, ?)";
                $stmt_user = $conn->prepare($userCreate);
                $stmt_user->bind_param("sss", $email, $hashedPassword, $newUserName);

                if ($stmt_user->execute()) {
                    // Confirmar la transacción si ambas inserciones fueron exitosas
                    $conn->commit();
                    $_SESSION['useremail'] = $email; // Iniciar sesión automáticamente
                    header("Location: main.php"); // Redirigir a la página principal
                    exit();
                } else {
                    throw new Exception("Error al crear la cuenta en TR_USUARIOS.");
                }
                $stmt_user->close();
            } else {
                throw new Exception("Error al crear la cuenta en TR_PERSONA.");
            }
            $stmt_person->close();
        }
        $stmt_check->close();
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $conn->rollback();
        echo $e->getMessage();
    }
}

$conn->close();
?>
