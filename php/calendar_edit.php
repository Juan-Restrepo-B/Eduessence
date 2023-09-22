<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="48x48" href="../img/logo1.png">
    <link rel="stylesheet" href="../css/styles_calendar_edit.css">
    <title>EDUESSENCE</title>
    <script defer>
        function mostrarFormulario5(event) {
            var formularioEmergente = document.getElementById("formularioEmergente5");
            formularioEmergente.style.display = "block";
        }

        function ocultarFormulario5() {
            var formularioEmergente = document.getElementById("formularioEmergente5");
            formularioEmergente.style.display = "none";
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
                            style="fill: rgba(0, 0, 0, 1);">
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
                    <tr>
                        <td class title>NOMBRE CALENDARIO</td>
                    </tr>
                    <?php
                    include("conexion.php");
                    $ip_cliente = $_SERVER['REMOTE_ADDR'];

                    date_default_timezone_set('America/Bogota');

                    $sql = "SHOW TABLES";
                    $result = $conn->query($sql);

                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td class="cal">
                                        <a href="calendar_data.php?database=<?php echo $row["Tables_in_$database"]; ?>"
                                            target="contentCalendar" class="mostrarFormulario5" onclick="mostrarFormulario5()">
                                            <?php echo strtoupper($row["Tables_in_$database"]); ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "No se encontraron tablas en la base de datos '$database'.";
                        }
                    } else {
                        echo "Error en la consulta";
                    }

                    ?>
                </table>
                <div id="formularioEmergente5" class="formularioEmergente5" style="display: none;">
                    <div class="order5">
                        <div class="formulario5">
                            <iframe name="contentCalendar" frameborder="0"></iframe>
                            <br>
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