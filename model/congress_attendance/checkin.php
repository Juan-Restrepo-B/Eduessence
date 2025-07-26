<?php
session_start();

// Registrar el check-in en la base de datos (reemplaza estos datos con los tuyos)
$host = "localhost";
$user = "Desarrollo_Summit";
$pass = "y9B>^y=>FT+G`C@,";
$database = "registro_summit";
// Crear conexión a la base de datos
$conn = new mysqli($host, $user, $pass, $database);

if (isset($_POST['action'], $_POST['control'])) {
    $action = $_POST['action'];
    $control = $_POST['control'];
    $cursoId = isset($_POST['cursoId']) ? $_POST['cursoId'] : null;

    date_default_timezone_set('America/Bogota');
    $fechareg = date('Y-m-d H:i:s');

    // Si la acción es 'register', verificar si el 'userid' está presente
    if ($action === 'register' && isset($_POST['userid'])) {
        $userid = $_POST['userid'];
        $_SESSION['userid'] = $userid;

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Preparar y ejecutar la consulta de inserción
        $stmt = $conn->prepare("INSERT INTO LOG_USERS (LOG_IDUSER, LOG_FECHORA, LOG_PUNTO , LOG_ACCION, LOG_IDCURSO) VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param("sssss", $userid, $fechareg, $control, $action, $cursoId);

        if ($stmt->execute()) {
            echo 'Check-in exitoso para: ' . $userid;
            setcookie('userid', $userid, time()  + (86400 * 30), '/'); // La cookie expirará en 30 días
        } else {
            echo 'Error al realizar el check-in. Error: ' . $stmt->error;
        } 

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    } else if ($action === 'registro' && isset($_POST['userid'])) {
        $userid = $_POST['userid'];
        $sponser = $_SESSION['idsponser'];

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Preparar y ejecutar la consulta de inserción
        $stmt = $conn->prepare("INSERT INTO LOGS_VISITAS (LOGV_SPONNER, LOGV_IDVISITANTE, LOGV_FECHORA) VALUES (?, ?, ?)");

        $stmt->bind_param("ssss", $sponser, $userid, $fechareg);

        if ($stmt->execute()) {
            header('Location: registroe2.php');
        } else {
            echo 'Error al realizar el registro. Error: ' . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    } else if ($action === 'checking') {
        // Obtener el valor del userid almacenado en la sesión
        $useridchecking = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;

        // Verificar si el iduser está presente
        if (!$useriduseridcheckingchecking) {
            echo 'Por favor realizar el check-in primero.';
        } else {
            // Realizar el registro del punto de control
            $stmt = $conn->prepare("INSERT INTO LOG_USERS (LOG_IDUSER, LOG_FECHORA, LOG_PUNTO , LOG_ACCION, LOG_IDCURSO) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $useridchecking, $fechareg, $control, $action, $cursoId);

            if ($stmt->execute()) {
                echo $useridchecking . ' se registró exitosamente: ' . $control;
            } else {
                echo 'Error al realizar el registro del punto de control. Error: ' . $stmt->error;
            }
    
            // Cerrar la conexión
            $stmt->close();
            $conn->close();
        }
    
    } else {
        echo 'Acción desconocida.';
    }
} else {
    echo 'Datos insuficientes para realizar el check-in.';
}
?>