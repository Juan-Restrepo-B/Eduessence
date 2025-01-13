<?php
include("../conexion.php"); // Conexión a la base de datos

if (isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
}

$result = $conn->query("SELECT * FROM mensajes WHERE idcurso = '" . $idcurso . "' ORDER BY fecha DESC");
while ($row = $result->fetch_assoc()) {
    echo "<div class='mensaje'><strong>" . htmlspecialchars($row['usuario']) . ":</strong> " . htmlspecialchars($row['mensaje']) . "</div>";
}
?>
