<?php
session_start();

include('conexion.php');

//$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];
$useremail = $_SESSION['useremail'];

$sql = "SELECT CARRERA_USUARIO_NOMBRE, 
        CARRERA_IDCURSO, CURSO_NOMBRE, 
        CARRERA_CERTESTADO, 
        CARRERA_IDTIPARTICIPANTE, 
        CURSO_CERTIFICADO,
        CURSO_LOGOIMG
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
    <link rel="stylesheet" href="css/styles_index_dipl.css">
    <title>DIPLOMAS</title>
</head>

<body>
    <section>
        <div class="patrocinadores">
            <div class="title">
                <h1>DIPLOMAS</h1>
            </div>
            <div class="gallery">
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="sponsor">
                            <img src="../img/logos/<?php echo $row["CURSO_LOGOIMG"]; ?>" alt="Logo Curso">
                            <h2>
                                <?php echo strtoupper($row["CURSO_NOMBRE"]); ?>
                            </h2>
                            <div class="btn">
                                <a href="certificados/Diplomas.php?idUser=<?php echo $row["CARRERA_USUARIO_NOMBRE"]; ?>&tipA=<?php echo $row["CARRERA_IDTIPARTICIPANTE"]; ?>&idCurso=<?php echo $row["CARRERA_IDCURSO"]; ?>" target="_blank">Ver</a>
                                <a href="certificados/Diplomas.php?idUser=<?php echo $row["CARRERA_USUARIO_NOMBRE"]; ?>&tipA=<?php echo $row["CARRERA_IDTIPARTICIPANTE"]; ?>&idCurso=<?php echo $row["CARRERA_IDCURSO"]; ?>">Descargar</a>
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