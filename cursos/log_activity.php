<?php
session_start();
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $useremail = $_POST['useremail'];
    $ip_cliente = $_POST['ip_cliente'];
    $idcurso = $_POST['idcurso'];

    $stmt = $conn->prepare("INSERT INTO user_activity_log (user_email, ip_address, idCurso) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $useremail, $ip_cliente, $idcurso);
    $stmt->execute();
    $stmt->close();
}
?>