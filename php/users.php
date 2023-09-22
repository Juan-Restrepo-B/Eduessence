<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];

include('conexion.php');

$result = mysqli_query($conn, "SELECT * FROM TR_PERSONA INNER JOIN TR_USUARIOS ON USUARIO_NOMBRE = PERSONA_CORREO WHERE PERSONA_CORREO =  '" . $usuario . "'");

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $actualizacionRealizada = false;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["actualizarCuenta"])) { // Verificar si se presionó el botón "ACTUALIZAR CUENTA"
                    $actualizacionRealizada = true;

                    // Recuperar los datos del formulario
                    $nombres = isset($_POST["nombres"]) ? $_POST["nombres"] : $row["PERSONA_NOMBRES"];
                    $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : $row["PERSONA_APELLIDOS"];
                    $documento = isset($_POST["documento"]) ? $_POST["documento"] : $row["PERSONA_DOCUMENTO"];
                    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : $row["PERSONA_TELEFONO"];
                    $pais = isset($_POST["pais"]) ? $_POST["pais"] : $row["PERSONA_PAIS"];

                    // Verificar si la variable $usuario no está vacía
                    if (!empty($usuario)) {
                        // Inicializar un array para almacenar los campos que se van a actualizar
                        $updates = array();

                        if ($nombres !== $row["PERSONA_NOMBRES"]) {
                            $updates[] = "PERSONA_NOMBRES = '$nombres'";
                        }

                        if ($apellidos !== $row["PERSONA_APELLIDOS"]) {
                            $updates[] = "PERSONA_APELLIDOS = '$apellidos'";
                        }

                        if ($documento !== $row["PERSONA_DOCUMENTO"]) {
                            $updates[] = "PERSONA_DOCUMENTO = '$documento'";
                        }

                        if ($telefono !== $row["PERSONA_TELEFONO"]) {
                            $updates[] = "PERSONA_TELEFONO = '$telefono'";
                        }

                        if ($pais !== $row["PERSONA_PAIS"]) {
                            $updates[] = "PERSONA_PAIS = '$pais'";
                        }

                        // Verificar si se van a realizar actualizaciones
                        if (!empty($updates)) {
                            // Construir la consulta SQL de actualización
                            $sql = "UPDATE TR_PERSONA SET " . implode(", ", $updates) . " WHERE PERSONA_CORREO = '" . $usuario . "'";

                            // Ejecutar la consulta SQL
                            if ($conn->query($sql) === TRUE) {

                                $useremail = $row["USUARIO_NOMBRE"];
                                $ip_cliente = $_SERVER['REMOTE_ADDR'];
                    
                                $sql = "INSERT INTO LOG_USUARIO
                                (LU_FECHORA, LU_USUARIO_USER, LU_DIRECCIONIP, LU_ACTIONEVNET, LU_RESULTACTION, LU_DETALLE, LU_ESTADO)
                                VALUES(NOW(), ?, ?, 'ACTALZACIÓN DE DATOS', 'Éxito', 'Actualización de datos exitoso', 'ACTIVO')";
                    
                                // Preparar la consulta
                                $stmt = $conn->prepare($sql);
                    
                                // Asignar los valores utilizando bind_param o bindValue, por ejemplo:
                                $stmt->bind_param("ss", $useremail, $ip_cliente);
                    
                                // Ejecutar la consulta
                                $stmt->execute();
                                header("Location: " . $_SERVER['PHP_SELF']);
                                exit;
                            } else {
                                echo "Error al actualizar los datos: " . $conn->error;
                            }
                        } else {
                        }
                    } else {
                        echo "El campo de correo está vacío.";
                    }
                }
            }

            ?>
            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="icon" type="image/png" sizes="48x48" href="../img/logo1.png">
                <link rel="stylesheet" href="../css/styles_users.css">
                <title>EDUESSENCE</title>
            </head>

            <body>
                <main>
                    <div class="title">
                        <div class="title__h2">
                            <h2>CUENTA</h2>
                        </div>
                    </div>
                    <div class="container">
                        <div class="container-left">
                            <div class="container-left__img">
                                <img src="../img/users/<?php echo $row["USUARIO_IMAGEN"]; ?>" alt="">
                            </div>
                            <div class="container-left__name-user">
                                <h3>
                                    <?php echo strtoupper($row["PERSONA_NOMBRES"]); ?>
                                    <br>
                                    <?php echo strtoupper($row["PERSONA_APELLIDOS"]); ?>
                                </h3>
                            </div>
                            <div class="container-left__link-user">
                                <a href="">Ver perfil</a>
                            </div>
                            <div class="container-left__main">
                                <ul class="container-left__main-ul">
                                    <li class="container-left__main-il"><a href="">
                                            <div class="container-left__main-il__svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                    <path
                                                        d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z">
                                                    </path>
                                                </svg>
                                                &nbsp;&nbsp;
                                                <span>CUENTA</span>
                                            </div>
                                        </a></li>
                                    <li class="container-left__main-il"><a href="#" id="mostrarFormulario"
                                            data-idpersona="<?php echo $row['PERSONA_CORREO']; ?>">
                                            <div class="container-left__main-il__svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                    <path
                                                        d="M20.995 6.9a.998.998 0 0 0-.548-.795l-8-4a1 1 0 0 0-.895 0l-8 4a1.002 1.002 0 0 0-.547.795c-.011.107-.961 10.767 8.589 15.014a.987.987 0 0 0 .812 0c9.55-4.247 8.6-14.906 8.589-15.014zM12 19.897C5.231 16.625 4.911 9.642 4.966 7.635L12 4.118l7.029 3.515c.037 1.989-.328 9.018-7.029 12.264z">
                                                    </path>
                                                    <path d="m11 12.586-2.293-2.293-1.414 1.414L11 15.414l5.707-5.707-1.414-1.414z">
                                                    </path>
                                                </svg>
                                                &nbsp;&nbsp;
                                                <span>CAMBIAR CLAVE</span>
                                            </div>
                                        </a></li>
                                    <li class="container-left__main-il"><a href="">
                                            <div class="container-left__main-il__svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                    <path
                                                        d="m15.71 15.71 2.29-2.3 2.29 2.3 1.42-1.42-2.3-2.29 2.3-2.29-1.42-1.42-2.29 2.3-2.29-2.3-1.42 1.42L16.58 12l-2.29 2.29zM12 8a3.91 3.91 0 0 0-4-4 3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4zM6 8a1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2 1.91 1.91 0 0 1-2-2zM4 18a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3v1h2v-1a5 5 0 0 0-5-5H7a5 5 0 0 0-5 5v1h2z">
                                                    </path>
                                                </svg>
                                                &nbsp;&nbsp;
                                                <span>BORRAR CUENTA</span>
                                            </div>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="container-rigth">
                            <div class="container-rigth__users">
                                <h2>Cuenta:
                                    <?php echo strtoupper($row["USUARIO_USER"]); ?>
                                </h2>
                            </div>
                            <form action="" method="post">
                                <label for="nombres">NOMBRES:</label>
                                <div class="container-rigth__Nombre container-rigth__input">
                                    <input type="text" name="nombres" placeholder="<?php echo strtoupper($row["PERSONA_NOMBRES"]); ?>"
                                        value="<?php echo strtoupper($row["PERSONA_NOMBRES"]); ?>">
                                </div>
                                <label for="apellidos">APELLIDOS:</label>
                                <div class="container-rigth__Apellidos container-rigth__input">
                                    <input type="text" name="apellidos"
                                        placeholder="<?php echo strtoupper($row["PERSONA_APELLIDOS"]); ?>"
                                        value="<?php echo strtoupper($row["PERSONA_APELLIDOS"]); ?>">
                                </div>
                                <label for="documento">DOCUMENTO:</label>
                                <div class="container-rigth__Documentos container-rigth__input">
                                    <input type="text" name="documento"
                                        placeholder="<?php echo strtoupper($row["PERSONA_DOCUMENTO"]); ?>"
                                        value="<?php echo strtoupper($row["PERSONA_DOCUMENTO"]); ?>">
                                </div>
                                <label for="correo">CORREO:</label>
                                <div class="container-rigth__email container-rigth__input">
                                    <input type="text" name="correo" placeholder="<?php echo $row["PERSONA_CORREO"]; ?>" readonly>
                                </div>
                                <label for="telefono">TELEFONO:</label>
                                <div class="container-rigth__telefono container-rigth__input">
                                    <input type="text" name="telefono" placeholder="<?php echo strtoupper($row["PERSONA_TELEFONO"]); ?>"
                                        value="<?php echo strtoupper($row["PERSONA_TELEFONO"]); ?>">
                                </div>
                                <label for="pais">PAÍS:</label>
                                <div class="container-rigth__pais container-rigth__input">
                                    <input type="text" name="pais" placeholder="<?php echo strtoupper($row["PERSONA_PAIS"]); ?>"
                                        value="<?php echo strtoupper($row["PERSONA_PAIS"]); ?>">
                                </div>
                                <button class="btn-update" name="actualizarCuenta">ACTUALIZAR CUENTA</button>
                            </form>

                        </div>
                    </div>
                    <div id="formularioEmergente" class="formularioEmergent" style="display: none;">
                        <div class="order">
                            <div class="formulario">
                                <div>
                                    <form id="cambioClaveForm" action="cambiar_clave.php" method="post">
                                        <label for="newPassword">NUEVA CLAVE:</label>
                                        <div class="container-rigth__telefono container-rigth__input central margin">
                                            <input type="password" name="newPassword" id="newPassword" required>
                                        </div>
                                        <label for="confirmPassword">CONFIRME CLAVE:</label>
                                        <div class="container-rigth__pais container-rigth__input central margin">
                                            <input type="password" name="confirmPassword" id="confirmPassword" required>
                                        </div><br>
                                        <input type="hidden" name="userID" id="userID" value="<?php echo $usuario; ?>">
                                        <div class="central">
                                            <button class="btn-secundary btn-block" type="button" name="close"
                                                onclick="ocultarFormulario()">CERRAR</button>
                                            <button class="btn btn-primary btn-block" type="submit" name="change">CAMBIAR</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </body>
            <?php
        }
    }
}
?>
<script src="../js/redirect.js"></script>
<script defer>
    function mostrarFormulario(event) {
        var formularioEmergente = document.getElementById("formularioEmergente");
        formularioEmergente.style.display = "block";
    }

    function ocultarFormulario() {
        var formularioEmergente = document.getElementById("formularioEmergente");
        formularioEmergente.style.display = "none";
    }

    var enlacesMostrarFormulario = document.querySelectorAll("#mostrarFormulario");
    enlacesMostrarFormulario.forEach(function (enlace) {
        enlace.addEventListener("click", mostrarFormulario);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const inputFields = document.querySelectorAll('.container-rigth__input input');

        inputFields.forEach(function (input) {
            const originalPlaceholder = input.placeholder;

            input.addEventListener('focus', function () {
                if (this.placeholder !== '') {
                    this.value = this.placeholder;
                    this.placeholder = '';
                }
            });

            input.addEventListener('blur', function () {
                if (this.value === '') {
                    this.placeholder = originalPlaceholder;
                }
            });
        });
    });

</script>

</html>