<?php
include("conexion.php"); // Conexión a la base de datos

if (isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
}

if (isset($_POST['usuario']) && isset($_POST['mensaje'])) {
    $usuario = $_POST['usuario'];
    $mensaje = $_POST['mensaje'];
    
    // Preparar y ejecutar la consulta para insertar el mensaje
    $stmt = $conn->prepare("INSERT INTO mensajes (usuario, mensaje, idcurso) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usuario, $mensaje, $idcurso);
    $stmt->execute();
    $stmt->close();
}
?>