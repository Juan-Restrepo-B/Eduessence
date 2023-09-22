<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="48x48" href="../img/logo1.png">
    <link rel="stylesheet" href="../css/styles_calendar_data.css">
    <title>EDUESSENCE</title>
    <script defer>
        function mostrarFormulario5(event) {
            var formularioEmergente = document.getElementById("formularioEmergente5");
            formularioEmergente.style.display = "block";
        }

        function mostrarFormulario() {
            var formularioEmergente = document.getElementById("formularioEmergente");
            formularioEmergente.style.display = "block";
        }

        function ocultarFormulario() {
            var formularioEmergente = document.getElementById("formularioEmergente");
            formularioEmergente.style.display = "none";
            window.onload();
        }

        function ocultarFormulario5() {
            var formularioEmergente = document.getElementById("formularioEmergente5");
            formularioEmergente.style.display = "none";
        }

        var enlacesMostrarFormulario = document.querySelectorAll("#mostrarFormulario5");
        enlacesMostrarFormulario.forEach(function (enlace) {
            enlace.addEventListener("click", mostrarFormulario5);
        });
    </script>
</head>

<body>
    <header>
        <div class="contenedor">
            <nav>
                <div class="add">
                    <a href="#" id="mostrarFormulario" onclick="mostrarFormulario()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(255, 255, 252, 1);">
                            <!-- Icono de más -->
                            <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path>
                            <!-- Círculo exterior -->
                            <path
                                d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z">
                            </path>
                        </svg>
                    </a>
                </div>
            </nav>
        </div>
    </header>
    <!-- Formulario emergente para crear un nuevo punto de ingreso y salida -->
    <div id="formularioEmergente" class="formularioEmergente" style="display: none;">
        <div class="order">
            <div class="formulario">
                <h2>CREAR NUEVO CALENDARIO</h2>
                <form action="" method="post" id="formulario">
                    <label for="name">NOMBRE:</label>
                    <input type="text" id="name" name="name" required=""><br><br>
                    <button class="btn btn-primary btn-block" type="submit" name="register">CREAR</button>
                    &nbsp;&nbsp;
                    <button class="btn btn-secundary btn-block" type="button" name="close"
                        onclick="ocultarFormulario()">CERRAR</button>
                </form>
            </div>
        </div>
    </div>
    <main>
        <div class="container">
            <div class="row">
                <table>
                    <?php
                    session_start();
                    $ip_cliente = $_SERVER['REMOTE_ADDR'];

                    include("conexion.php");

                    date_default_timezone_set('America/Bogota');

                    $datab = isset($_GET['database']) ? $_GET['database'] : 1;


                    $sql = "SELECT * FROM $datab";
                    $result = $conn->query($sql);
                    ?>
                    <tr>
                        <th colspan="9">
                            <?php echo strtoupper($datab); ?>
                        </th>
                    </tr>

                    <tr>
                        <td>NOMBRE EVENTO</td>
                        <td>UBICACIÓN</td>
                        <td>CONFERENCISTA</td>
                        <td>PAIS CONFERENCISTA</td>
                        <td>DESCRIPCIÓN</td>
                        <td>FECHA INICIO</td>
                        <td>FECHA FIN</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $mostrar['cal_event'] ?>
                            </td>
                            <td>
                                <?php echo $mostrar['cal_ubicacion'] ?>
                            </td>
                            <td>
                                <?php echo $mostrar['cal_speaker'] ?>
                            </td>
                            <td>
                                <?php echo $mostrar['cal_pais'] ?>
                            </td>
                            <td>
                                <?php echo $mostrar['cal_description'] ?>
                            </td>
                            <td>
                                <?php echo $mostrar['cal_fecha_in'] ?>
                            </td>
                            <td>
                                <?php echo $mostrar['cal_fecha_out'] ?>
                            </td>
                            <td class="btnfrom cal"><a href="#" id="mostrarFormulario5"
                                    data-idpersona="<?php echo $mostrar['id_calendar']; ?>">EDITAR</a>
                            </td>
                            <td class="btnfrom cal"><a href="#" id="mostrarFormulario5"
                                    data-idpersona="<?php echo $mostrar['id_calendar']; ?>">ELIMINAR</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <div id="formularioEmergente5" class="formularioEmergente5" style="display: none;">
                    <div class="order5">
                        <div class="formulario5">
                            <br><br>
                            <button class="btn btn-secundary btn-block" type="submit" name="close"
                                onclick="ocultarFormulario5()">CERRAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="../js/redirect.js"></script>

</html>