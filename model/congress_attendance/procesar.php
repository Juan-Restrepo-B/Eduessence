<?php
session_start();

// Configuración de conexión
$host = "68.178.246.37";
$user = "Desarrollo_Summit";
$pass = "y9B>^y=>FT+G`C@,";
$database = "registro_summit";

// Crear conexión a la base de datos
$conn = new mysqli($host, $user, $pass, $database);

date_default_timezone_set('America/Bogota');
$fechareg = date('Y-m-d H:i:s');

$action  = $_POST['action'];
$control = $_POST['control'];
$cursoId = $_POST['cursoId'] ?? null;

// 🔹 Acción: register
if ($action === 'register') {
    $userid = $_SESSION['useremail'] ?? null;

    $stmt = $conn->prepare("INSERT INTO LOG_USERS (LOG_IDUSER, LOG_FECHORA, LOG_PUNTO, LOG_ACCION, LOG_IDCURSO) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $userid, $fechareg, $control, $action, $cursoId);

    if ($stmt->execute()) {
        header("Location: registroExitosoChekin");
    } else {
        header("Location: registroFallidoChekin");
    }

    $stmt->close();
    $conn->close();
    exit;
}

// 🔹 Acción: checking (requiere sesión previa)
if ($action === 'checking') {
    $userid = $_SESSION['useremail'] ?? null;

    if (!$userid) {
        header("Location: userFail");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO LOG_USERS (LOG_IDUSER, LOG_FECHORA, LOG_PUNTO, LOG_ACCION, LOG_IDCURSO) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $userid, $fechareg, $control, $action, $cursoId);

    if ($stmt->execute()) {
        // 🔁 Redirección según punto de control
        switch ($control) {
            case 'INGRESO':
                header("Location: entradaCongreso");
                break;
            case 'SALIDA':
                header("Location: salidaCongreso");
                break;
            case 'SALON':
                header("Location: salaCongreso");
                break;
            case 'SIMPOCIO':
                header("Location: seguimientoCongreso");
                break;
            default:
                header("Location: registroFallidoChekin");
                break;
        }
    } else {
        header("Location: registroFallidoChekin");
    }

    $stmt->close();
    $conn->close();
    exit;
}

// 🔻 Acción desconocida
header("Location: registroFallidoChekin");
exit;
?>