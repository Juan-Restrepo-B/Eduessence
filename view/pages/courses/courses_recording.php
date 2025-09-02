<?php
session_start();

// Verificamos sesión
if (!isset($_SESSION['useremail'])) {
    header("Location: /login");
    exit;
}

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

include("../../../model/conexion.php");

// Obtener idcurso de forma segura
$idcurso = isset($_GET['idcurso']) ? intval($_GET['idcurso']) : 0;
if ($idcurso <= 0) {
    echo "Curso inválido.";
    exit;
}

/**
 * CONSULTA: nombre del curso (prepared statement)
 */
$curso_nombre = '';
$sql = "SELECT tc.CURSO_NOMBRE, tc.IDCURSOS
        FROM UN_CARRERA uc
        INNER JOIN TR_CURSOS tc ON uc.CARRERA_IDCURSO = tc.IDCURSOS
        WHERE CARRERA_CURESTADO = 'ACTIVO'
          AND tc.IDCURSOS = ?
          AND CARRERA_USUARIO_NOMBRE = ?
        LIMIT 1";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('is', $idcurso, $usuario);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        $curso_nombre = $row['CURSO_NOMBRE'];
    }
    $stmt->close();
}

/**
 * CONSULTA: videos del curso (prepared statement)
 */
$videos = [];
$sql1 = "SELECT tv.IDVIDEO, tv.VIDEO_TITULO, tv.VIDEO_RUTA, tv.VIDEO_PATH
         FROM UN_CARRERA uc
         INNER JOIN TR_VIDEOS tv ON uc.CARRERA_IDCURSO = tv.VIDEO_IDCURSO
         WHERE CARRERA_CURESTADO = 'ACTIVO'
           AND CARRERA_IDTIPARTICIPANTE = 'ASISTENTE'
           AND tv.VIDEO_IDCURSO = ?
         GROUP BY tv.IDVIDEO, tv.VIDEO_TITULO, tv.VIDEO_RUTA, tv.VIDEO_PATH
         ORDER BY tv.IDVIDEO";
if ($stmt1 = $conn->prepare($sql1)) {
    $stmt1->bind_param('i', $idcurso);
    $stmt1->execute();
    $res1 = $stmt1->get_result();
    while ($r = $res1->fetch_assoc()) {
        $ruta = $r['VIDEO_PATH']; // aquí viene el link directo
        $videos[] = [
            'id' => (int)$r['IDVIDEO'],
            'titulo' => $r['VIDEO_TITULO'],
            'ruta' => $ruta,
            'url' => $ruta // usamos la ruta directamente
        ];
    }
    $stmt1->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(strtoupper($curso_nombre ?: 'CURSO')); ?></title>
    <link rel="stylesheet" href="view/css/courses/styles_courses_recording.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .topbar { display:flex; align-items:center; gap:.5rem; padding: .75rem; border-bottom:1px solid #eee; }
        .container { display:flex; gap:1rem; width:100%; padding:1rem; box-sizing:border-box; }
        .list_class { width:320px; max-height:80vh; overflow:auto; border-right:1px solid #ddd; padding-right:1rem; }
        .list_class table { width:100%; border-collapse: collapse; }
        .title { font-weight:700; font-size:1.05rem; padding: 0.5rem 0; }
        .cal { padding:0.35rem 0; }
        .cal a { text-decoration:none; display:block; padding: .5rem; border-radius:6px; color:#111; background:transparent; }
        .cal a:hover { background:#f3f3f3; }
        .contentIframe { flex:1; padding-left:1rem; }
        video { width:90%; background:#000; border-radius:6px; }
        .no-videos { padding:1rem; color:#666; }
    </style>
</head>
<body>
        <a href="/curso_info?idcurso=<?php echo $idcurso ?>" style="margin-top: 1rem; margin-left: 1rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                <path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path>
            </svg>
        </a>

    <div class="container">
        <div class="list_class">
            <table>
                <?php if (empty($videos)): ?>
                    <tr><td class="no-videos">No hay videos disponibles para este curso.</td></tr>
                <?php else: ?>
                    <?php foreach ($videos as $v): ?>
                        <tr>
                            <td class="cal">
                                <a href="#" class="mostrarFormulario5 buttonSimposio"
                                   data-url="<?php echo htmlspecialchars($v['url']); ?>"
                                   data-videoid="<?php echo (int)$v['id']; ?>"
                                   data-titulo="<?php echo htmlspecialchars($v['titulo']); ?>">
                                    <?php echo htmlspecialchars(strtoupper($v['titulo'])); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>

        <div class="contentIframe">
            <video id="videoPlayer" controls preload="metadata">
                <source id="playerSource" src="" type="video/mp4">
                Tu navegador no soporta la reproducción de video.
            </video>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var botones = document.querySelectorAll(".buttonSimposio");
    var videoPlayer = document.getElementById("videoPlayer");
    var playerSource = document.getElementById("playerSource");

    botones.forEach(function (boton) {
        boton.addEventListener("click", function (event) {
            event.preventDefault();

            var url = boton.getAttribute("data-url");
            var titulo = boton.getAttribute("data-titulo");
            var videoId = boton.getAttribute("data-videoid");
            var useremail = "<?php echo addslashes($_SESSION['useremail']); ?>";
            var ip_cliente = "<?php echo addslashes($_SERVER['REMOTE_ADDR']); ?>";

            if (!url) {
                alert('No se pudo obtener la URL del video. Contacta al administrador.');
                return;
            }

            // Grabar log por AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "model/courses/insertar_log.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            var params = "useremail=" + encodeURIComponent(useremail) +
                         "&ip_cliente=" + encodeURIComponent(ip_cliente) +
                         "&simposio=" + encodeURIComponent(titulo) +
                         "&video_id=" + encodeURIComponent(videoId);
            xhr.send(params);

            // Cargar video en player y reproducir
            playerSource.src = url;
            videoPlayer.load();
            videoPlayer.play().catch(function (err) {
                console.log('No se pudo iniciar reproducción automática:', err);
            });
        });
    });
});
</script>

</body>
</html>
