<?php
session_start();

$usuario = isset($_SESSION['useremail']) ? $_SESSION['useremail'] : null;
$ip_cliente = $_SERVER['REMOTE_ADDR'];

if (isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
} else {
    $idcurso = null;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cargar Video</title>
</head>

<body>
    <h1>Cargar Curso</h1>
    <form action="model/courses/upload_video.php" method="post" enctype="multipart/form-data">
        <label for="titulo">Título del Video:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>
        <label for="video">Seleccionar Video:</label>
        <input type="file" name="video" id="video" accept="video/*" required><br><br>
        <input type="hidden" name="idcurso" value="<?php echo htmlspecialchars($idcurso); ?>">
        <input type="submit" value="Cargar Video">
    </form>
</body>

</html>