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

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

$result = mysqli_query($conn, "SELECT * FROM TR_PERSONA INNER JOIN TR_USUARIOS ON USUARIO_NOMBRE = PERSONA_CORREO WHERE PERSONA_CORREO =  '" . $usuario . "'");

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();


        $blob = $row['USUARIO_IMAGEN'];
        $base64 = base64_encode($blob);

        $_SESSION['USUARIO_IMAGEN'] = $base64;
        $_SESSION['PERSONA_NOMBRES'] = $row['PERSONA_NOMBRES'];
        $_SESSION['PERSONA_APELLIDOS'] = $row['PERSONA_APELLIDOS'];
        $_SESSION['USUARIO_USER'] = $row['USUARIO_USER'];
        $_SESSION['PERSONA_CORREO'] = $row['PERSONA_CORREO'];
        $_SESSION['PERSONA_DOCUMENTO'] = $row['PERSONA_DOCUMENTO'];
        $_SESSION['PERSONA_TELEFONO'] = $row['PERSONA_TELEFONO'];
        $_SESSION['PERSONA_PAIS'] = $row['PERSONA_PAIS'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["actualizarCuenta"])) { // Verificar si se presionó el botón "ACTUALIZAR CUENTA"
        $actualizacionRealizada = true;

        // Recuperar los datos del formulario
        $nombres = isset($_POST["nombres"]) ? $_POST["nombres"] : $row["PERSONA_NOMBRES"];
        $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : $row["PERSONA_APELLIDOS"];
        $documento = isset($_POST["documento"]) ? $_POST["documento"] : $row["PERSONA_DOCUMENTO"];
        $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : $row["PERSONA_TELEFONO"];
        $pais = isset($_POST["pais"]) ? $_POST["pais"] : $row["PERSONA_PAIS"];

        // Verificar si la variable $usuario no está vacía
        if (!empty($usuario)) {
            // Inicializar un array para almacenar los campos que se van a actualizar
            $updates = array();

            if ($nombres !== $row["PERSONA_NOMBRES"]) {
                $updates[] = "PERSONA_NOMBRES = '$nombres'";
            }

            if ($apellidos !== $row["PERSONA_APELLIDOS"]) {
                $updates[] = "PERSONA_APELLIDOS = '$apellidos'";
            }

            if ($documento !== $row["PERSONA_DOCUMENTO"]) {
                $updates[] = "PERSONA_DOCUMENTO = '$documento'";
            }

            if ($telefono !== $row["PERSONA_TELEFONO"]) {
                $updates[] = "PERSONA_TELEFONO = '$telefono'";
            }

            if ($pais !== $row["PERSONA_PAIS"]) {
                $updates[] = "PERSONA_PAIS = '$pais'";
            }

            // Verificar si se van a realizar actualizaciones
            if (!empty($updates)) {
                // Construir la consulta SQL de actualización
                $sql = "UPDATE TR_PERSONA SET " . implode(", ", $updates) . " WHERE PERSONA_CORREO = '" . $usuario . "'";

                // Ejecutar la consulta SQL
                if ($conn->query($sql) === TRUE) {

                    $useremail = $row["USUARIO_NOMBRE"];
                    $ip_cliente = $_SERVER['REMOTE_ADDR'];

                    $sql = "INSERT INTO LOG_USUARIO
                                (LU_FECHORA, LU_USUARIO_USER, LU_DIRECCIONIP, LU_ACTIONEVNET, LU_RESULTACTION, LU_DETALLE, LU_ESTADO)
                                VALUES(NOW(), ?, ?, 'ACTALZACIÓN DE DATOS', 'Éxito', 'Actualización de datos exitoso', 'ACTIVO')";

                    // Preparar la consulta
                    $stmt = $conn->prepare($sql);

                    // Asignar los valores utilizando bind_param o bindValue, por ejemplo:
                    $stmt->bind_param("ss", $useremail, $ip_cliente);

                    // Ejecutar la consulta
                    $stmt->execute();
                    header("Location: /usuario");
                    exit;
                } else {
                    echo "Error al actualizar los datos: " . $conn->error;
                }
            } else {
            }
        } else {
            echo "El campo de correo está vacío.";
        }
    }
}
?>