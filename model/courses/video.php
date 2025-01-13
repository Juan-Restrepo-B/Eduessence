<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $classId = $_GET['id'];

    $sql = "SELECT VIDEO_URL, VIDEO_TIPO FROM TR_VIDEOS WHERE IDVIDEO = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $classId);
    $stmt->execute();
    $stmt->bind_result($videoBlob, $videoTipo);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    header("Content-Type: $videoTipo");
    echo $videoBlob;
    exit();
} else {
    echo "No se proporcionó un ID de video válido.";
    exit();
}
?>