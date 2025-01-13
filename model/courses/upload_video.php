<?php
session_start();

include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['titulo']) && isset($_POST['idcurso']) && isset($_FILES['video'])) {
        $titulo = $_POST['titulo'];
        $idcurso = $_POST['idcurso'];
        $video = $_FILES['video'];

        // Verificar si el archivo se ha subido correctamente
        if ($video['error'] === UPLOAD_ERR_OK) {
            $videoTmpPath = $video['tmp_name'];
            $videoName = $video['name'];

            // Leer el contenido del archivo
            $videoContent = file_get_contents($videoTmpPath);

            // Preparar la consulta SQL para insertar el video en la base de datos
            $sql = "INSERT INTO TR_VIDEOS (VIDEO_TITULO, VIDEO_URL, VIDEO_IDCURSO) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $titulo, $videoContent, $idcurso);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "El video se ha cargado correctamente.";
            } else {
                echo "Error al cargar el video: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error al subir el archivo: " . $video['error'];
        }
    } else {
        echo "Error: Datos del formulario incompletos.";
    }
}

$conn->close();
?>