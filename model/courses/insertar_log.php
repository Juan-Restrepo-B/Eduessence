<?php
session_start();

include('../conexion.php');

$useremail = $_POST['useremail'];
$ip_cliente = $_POST['ip_cliente'];
$simposio = trim($_POST['simposio']);

$sql = "INSERT INTO LOG_USUARIO
(LU_FECHORA, LU_USUARIO_USER, LU_DIRECCIONIP, LU_ACTIONEVNET, LU_RESULTACTION, LU_DETALLE, LU_ESTADO)
VALUES(NOW(), ?, ?, ?, 'Exitoso', 'Vio el simposio', 'ACTIVO')";

// Preparar la consulta
$stmt = $conn->prepare($sql);

// Asignar los valores utilizando bind_param o bindValue, por ejemplo:
$stmt->bind_param("sss", $useremail, $ip_cliente, $simposio);

// Ejecutar la consulta
$stmt->execute();
?>
