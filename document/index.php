<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_form.css">
</head>

<body>
    <div class="container">
        <div class="list_class">
            <table>
                <?php
                session_start();

                $usuario = $_SESSION['useremail'];
                $ip_cliente = $_SERVER['REMOTE_ADDR'];

                include("conexion.php");

                $sql = "SELECT CURSO_NOMBRE, IDCURSOS FROM UN_CARRERA uc 
                INNER JOIN TR_CURSOS tc ON uc.CARRERA_IDCURSO = tc.IDCURSOS
                WHERE CARRERA_CURESTADO = 'ACTIVO'
                AND IDCURSOS = 2
                AND CARRERA_USUARIO_NOMBRE = '" . $usuario . "'";
                $result = $conn->query($sql);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr class="titleQuery">
                            <td>
                                <?php echo strtoupper($row["CURSO_NOMBRE"]); ?>
                            </td>
                        </tr>
                        <?php
                        $idCurso = $row["IDCURSOS"];

                        $sql1 = 
                        "SELECT IDOCUMENT, DOCUMENT_TITULO FROM UN_CARRERA uc 
                        INNER JOIN TR_DOCUMENTS td ON uc.CARRERA_IDCURSO = td.DOCUMENT_IDCURSO
                        WHERE CARRERA_CURESTADO = 'ACTIVO'
                        AND td.DOCUMENT_IDCURSO =  '" . $idCurso . "'
                        GROUP BY IDOCUMENT, DOCUMENT_TITULO";
                        $result1 = $conn->query($sql1);

                        if ($result1) {
                            while ($row1 = $result1->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td class="cal">
                                        <a href="class.php?classId=<?php echo $row1["IDOCUMENT"]; ?>" class="mostrarFormulario5"
                                            target="contentIframe">
                                            <?php echo strtoupper($row1["DOCUMENT_TITULO"]); ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }
                $conn->close();
                ?>
            </table>
        </div>
        <div class="contentIframe">
            <iframe src="" name="contentIframe" frameborder="0"></iframe>
        </div>
    </div>
</body>
<script defer type="text/javascript">
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    document.addEventListener('selectstart', function (e) {
        e.preventDefault();
    });
</script>

</html>