<?php

include("conexion.php");

if (isset($_GET['idcurso'])) {
    $idcurso = $_GET['idcurso'];
}

$infCurso = "SELECT * FROM
            TR_CURSOS
            INNER JOIN TR_INFOCURSO ON INFO_IDCURSO = IDCURSOS
            WHERE IDCURSOS = '" . $idcurso . "' ";
$resultinfoCurso = $conn->query($infCurso);
$rowinfcurso = $resultinfoCurso->fetch_assoc();

?>

<div class="popup">
    <div class="popup-content">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: #004aad;">
            <path
                d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z">
            </path>
            <path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path>
        </svg>
        <h2>Sr(a) usuario.</h2>
        <p>Por el momento no se encuentra habilitado el ingreso a visualizar el curso.</p>
        <br>
        <p>Este se habilitara el <?php echo date("d-M-Y g:i a", strtotime($rowinfcurso["CURSO_FECHSTART"])); ?></p>
        <button id="btn-summit" class="btn-summit" onclick="window.location.href='cursos.php?idcurso=<?php echo $idcurso ?>'">Cerrar</button>
    </div>
</div>

<style>
    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border: 2px solid black;
        z-index: 1000;
        display: block;
        width: 500px;
        height: 260px;
        border-radius: 2rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .popup svg {
        margin-bottom: 15px;
        width: 60px;
        height: 60px;
    }

    .popup-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        text-align: center;
        height: 100%;
    }

    .popup p {
        margin: 0;
        font-size: 1rem;
        color: #333;
    }

    .btn-summit {
        padding: 10px 20px;
        border-radius: 5px;
        border: solid 2px #004aad;
        background-color: white;
        color: #004aad;
        margin-top: auto;
        cursor: pointer;
        font-size: 1rem;
        font-weight: bold;
        transition: box-shadow 0.3s;
    }

    .btn-summit:hover {
        box-shadow: 0 0 10px rgb(96, 96, 96);
    }
</style>