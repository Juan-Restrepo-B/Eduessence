<?php
session_start();

include('../../../model/conexion.php');

//$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];
$useremail = $_SESSION['useremail'];

$sql = "SELECT CARRERA_USUARIO_NOMBRE, 
        CARRERA_IDCURSO, CURSO_NOMBRE, 
        CARRERA_CERTESTADO, 
        CARRERA_IDTIPARTICIPANTE, 
        CURSO_CERTIFICADO,  
        CURSO_LOGOIMG,
        CARRERA_IDTIPARTICIPANTE
        FROM UN_CARRERA uc
        INNER JOIN TR_CURSOS tc 
        ON uc.CARRERA_IDCURSO = tc.IDCURSOS 
        WHERE CARRERA_CERTESTADO = 'SI'
        AND CARRERA_USUARIO_NOMBRE = '" . $useremail . "'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/certificate/style_certificate.css">
    <title>DIPLOMAS</title>
</head>

<body>
    <section>
        <div class="patrocinadores">
            <div class="title">
                <h1>CERTIFICADOS</h1>
            </div>
            <div class="gallery">
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {

                        $blob = $row['CURSO_LOGOIMG'];
                        $base64 = base64_encode($blob);
                        ?>
                        <div class="sponsor">
                            <?php if (isset($base64)): ?>
                                <img src="data:image/jpeg;base64,<?php echo $base64; ?>" alt="Imagen desde Blob">
                            <?php else: ?>
                                <p>No se pudo cargar la imagen.</p>
                            <?php endif; ?>
                            <h2>
                                <?php echo strtoupper($row["CARRERA_IDTIPARTICIPANTE"]); ?>
                            </h2>
                            <h3>
                                <?php echo strtoupper($row["CURSO_NOMBRE"]); ?>
                            </h3>
                            <div class="btn">
                                <a href="/diploma?idUser=<?php echo $row["CARRERA_USUARIO_NOMBRE"]; ?>&tipA=<?php echo $row["CARRERA_IDTIPARTICIPANTE"]; ?>&idCurso=<?php echo $row["CARRERA_IDCURSO"]; ?>"
                                    target="_blank">Ver</a>
                                <a
                                    href="/diploma_des?idUser=<?php echo $row["CARRERA_USUARIO_NOMBRE"]; ?>&tipA=<?php echo $row["CARRERA_IDTIPARTICIPANTE"]; ?>&idCurso=<?php echo $row["CARRERA_IDCURSO"]; ?>">Descargar</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

    </section>
</body>

</html>