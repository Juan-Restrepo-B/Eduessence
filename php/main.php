<?php
session_start();

$usuario = $_SESSION['useremail'];
$ip_cliente = $_SERVER['REMOTE_ADDR'];


function showButtons($buttonNumber)
{
    include("conexion.php");

    $usuario = $_SESSION['useremail'];

    $sql = "SELECT PERMISSION_USER, PERMISSION_IDTIPPERMISSION
    FROM UN_PERMISSIONS WHERE PERMISSION_USER = '" . $usuario . "'";

    // Preparar la consulta
    $stmt = $conn->query($sql);

    while ($mostrar = mysqli_fetch_array($stmt)) {

        $user_permission = $mostrar['PERMISSION_IDTIPPERMISSION'];

        if ($user_permission == 1) { // Administrador
            return true;
        } elseif ($user_permission == 2) {
            return in_array($buttonNumber, [2]);
        } elseif ($user_permission == 5) {
            return in_array($buttonNumber, []);
        } elseif ($user_permission == 3) {
            return in_array($buttonNumber, []);
        } elseif ($user_permission == 4) {
            return in_array($buttonNumber, []);
        }

        return false;
    }
}


// Verificar si el usuario ya tiene una sesión activa en otro navegador
if (isset($_SESSION['useremail'])) {
    // Obtener el nombre de usuario actual
    $currentUsername = $_SESSION['useremail'];

    // Consultar la base de datos para verificar si el nombre de usuario tiene una sesión activa en otro lugar
    // Supongamos que tienes una tabla llamada 'LOG_USUARIO' donde almacenas información sobre los eventos de inicio y cierre de sesión
    include("conexion.php");

    // Consulta para obtener el último evento de inicio o cierre de sesión del usuario actual
    $sql = "SELECT * FROM LOG_USUARIO WHERE LU_USUARIO_USER = '$currentUsername' AND LU_RESULTACTION = 'Éxito' ORDER BY LU_FECHORA DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastEvent = $row["LU_ACTIONEVNET"];
        $lastResultAction = $row["LU_RESULTACTION"];

        // Verificar el último evento y el resultado de la acción
        if ($lastEvent === "INICIO DE SESIÓN" && $lastResultAction === "Éxito") {
            include("conexion.php");

            $useremail = $_SESSION['useremail'];
            $ip_cliente = $_SERVER['REMOTE_ADDR'];

            $sql = "INSERT INTO LOG_USUARIO
            (LU_FECHORA, LU_USUARIO_USER, LU_DIRECCIONIP, LU_ACTIONEVNET, LU_RESULTACTION, LU_DETALLE, LU_ESTADO)
            VALUES(NOW(), ?, ?, 'INICIO DE SESIÓN', 'Fallido', 'Inicio de sesión fallido ya cuenta con una sesion iniciada', 'ACTIVO')";

            // Preparar la consulta
            $stmt = $conn->prepare($sql);

            // Asignar los valores utilizando bind_param o bindValue, por ejemplo:
            $stmt->bind_param("ss", $useremail, $ip_cliente);

            // Ejecutar la consulta
            $stmt->execute();
            
            header("Location: ../index.php");
            exit();
        } elseif ($lastEvent === "CERRAR SESIÓN" && $lastResultAction === "Éxito") {
            include("conexion.php");

            $useremail = $_SESSION['useremail'];
            $ip_cliente = $_SERVER['REMOTE_ADDR'];

            $sql = "INSERT INTO LOG_USUARIO
            (LU_FECHORA, LU_USUARIO_USER, LU_DIRECCIONIP, LU_ACTIONEVNET, LU_RESULTACTION, LU_DETALLE, LU_ESTADO)
            VALUES(NOW(), ?, ?, 'INICIO DE SESIÓN', 'Éxito', 'Inicio de sesión exitoso', 'ACTIVO')";

            // Preparar la consulta
            $stmt = $conn->prepare($sql);

            // Asignar los valores utilizando bind_param o bindValue, por ejemplo:
            $stmt->bind_param("ss", $useremail, $ip_cliente);

            // Ejecutar la consulta
            $stmt->execute();
        }
    }
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="68x68" href="../img/logo1.png">
    <link rel="stylesheet" href="../css/styles_main.css">
    <title>EDUESSENCE</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../img/logo.png" alt="">
            </div>
            <div class="option">
                <div class="start">
                    <form method="post" action="logout.php">
                        <button class="btn-login" type="submit" name="logout">CERRAR SESIÓN</button>
                    </form>
                </div>
                <!-- <div class="main">
                    <input type="checkbox" id="btn-main" class="btn-main">
                    <label for="btn-main" class="lbl-main">
                        <span id="spn1"></span>
                        <span id="spn2"></span>
                        <span id="spn3"></span>
                    </label> -->
            </div>
            </div>
        </nav>
        <div class="fondMain"></div>
        <ul class="ul-main" id="main-menu">
            <h2>MENÚ</h2>
            <li><a href="../index.php">INICIO</a></li>
            <li><a href="#">SERVICIOS</a></li>
            <li><a href="#">CUMBRES</a></li>
            <li><a href="#">CURSOS</a></li>
            <li><a href="#">SIMPOSIOS</a></li>
        </ul>
    </header>
    <main class="screen-manager">
        <Section class="options">
            <div class="main-menu">
                <?php if (showButtons(1)): ?>
                    <div class="icon-container">
                        <a href="calendar_edit.php" class="menu-icon" target="contentMain"> <!-- CALENDARIO -->
                            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                style="fill: rgba(0, 0, 0, 1);">
                                <path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm4-4h2v2h-2zm4-4h2v2h-2z"></path>
                                <path
                                    d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z">
                                </path>
                            </svg>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="icon-container">
                    <a href="../clases/index.php" class="menu-icon" target="contentMain"> <!-- CHARLAS -->
                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1);">
                            <path
                                d="M18 11c0-.959-.68-1.761-1.581-1.954C16.779 8.445 17 7.75 17 7c0-2.206-1.794-4-4-4-1.516 0-2.822.857-3.5 2.104C8.822 3.857 7.516 3 6 3 3.794 3 2 4.794 2 7c0 .902.312 1.726.817 2.396A1.993 1.993 0 0 0 2 11v8c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-2.637l4 2v-7l-4 2V11zm-5-6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2zM6 5c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2z">
                            </path>
                        </svg>
                    </a>
                </div>
                <div class="icon-container">
                    <a href="../document/index.php" class="menu-icon" target="contentMain"> <!-- CUADERNILLOS -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1);">
                            <path
                                d="M8.267 14.68c-.184 0-.308.018-.372.036v1.178c.076.018.171.023.302.023.479 0 .774-.242.774-.651 0-.366-.254-.586-.704-.586zm3.487.012c-.2 0-.33.018-.407.036v2.61c.077.018.201.018.313.018.817.006 1.349-.444 1.349-1.396.006-.83-.479-1.268-1.255-1.268z">
                            </path>
                            <path
                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM9.498 16.19c-.309.29-.765.42-1.296.42a2.23 2.23 0 0 1-.308-.018v1.426H7v-3.936A7.558 7.558 0 0 1 8.219 14c.557 0 .953.106 1.22.319.254.202.426.533.426.923-.001.392-.131.723-.367.948zm3.807 1.355c-.42.349-1.059.515-1.84.515-.468 0-.799-.03-1.024-.06v-3.917A7.947 7.947 0 0 1 11.66 14c.757 0 1.249.136 1.633.426.415.308.675.799.675 1.504 0 .763-.279 1.29-.663 1.615zM17 14.77h-1.532v.911H16.9v.734h-1.432v1.604h-.906V14.03H17v.74zM14 9h-1V4l5 5h-4z">
                            </path>
                        </svg>
                    </a>
                </div>
                <div class="icon-container"> <!-- DIPLOMMAS -->
                    <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);">
                        <path d="M2 7v1l11 4 9-4V7L11 4z"></path>
                        <path
                            d="M4 11v4.267c0 1.621 4.001 3.893 9 3.734 4-.126 6.586-1.972 7-3.467.024-.089.037-.178.037-.268V11L13 14l-5-1.667v3.213l-1-.364V12l-3-1z">
                        </path>
                    </svg>
                </div>
                <?php if (showButtons(3)): ?>
                    <div class="icon-container"> <!-- MAQUETEADOR -->
                        <!-- <a href="#" class="menu-icon" target="contentMain"> -->
                        <svg class="admin menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1);">
                            <path
                                d="M20 6c0-2.168-3.663-4-8-4S4 3.832 4 6v2c0 2.168 3.663 4 8 4s8-1.832 8-4V6zm-8 13c-4.337 0-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3c0 2.168-3.663 4-8 4z">
                            </path>
                            <path d="M20 10c0 2.168-3.663 4-8 4s-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3z">
                            </path>
                        </svg>
                        <!-- </a> -->
                    </div>
                <?php endif; ?>
                <div class="icon-container end-option">
                    <a href="users.php" class="menu-icon" target="contentMain"> <!-- USUARIO -->
                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path
                                d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z">
                            </path>
                        </svg>
                    </a>
                    <!-- <div class="dropup-menu">
                        <?php if (showButtons(1)): ?>
                            <div class="button5 button_wrapper">
                                <a href="#" class="button">
                                    DIPLOMAS
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (showButtons(1)): ?>
                            <div class="button9 button_wrapper">
                                <a href="#" class="button">
                                    USUARIOS
                                </a>
                            </div>
                        <?php endif; ?>
                    </div> -->
                </div>
            </div>
        </Section>
        <section class="main-menu-container">
            <iframe src="users.php" name="contentMain" frameborder="0"></iframe>
        </section>
    </main>
    <footer class="bg-light footer">
        <div class="containerFooter">
            <div class="row">
                <div class="optionL">
                    <ul class="list-inline mb-2">
                        <!-- <li class="list-inline-item"><a href="index.php">HOME</a></li>
                        <li class="list-inline-item"><span>⋅</span></li>
                        <li class="list-inline-item"><a href="php/about.php">ABOUT</a></li>
                        <li class="list-inline-item"><span>⋅</span></li>
                        <li class="list-inline-item"><a href="#">PRODUCTS</a></li>
                        <li class="list-inline-item"><span>⋅</span></li>
                        <li class="list-inline-item"><a href="#form-contact">CONTACT</a></li> -->
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">© Juan Restrepo 2023. All Rights Reserved.</p>
                </div>
                <div class="logos">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="https://www.facebook.com/EduessenceSimposio"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                    style="fill: rgba(255, 255, 255, 1)">
                                    <path
                                        d="M12.001 2.002c-5.522 0-9.999 4.477-9.999 9.999 0 4.99 3.656 9.126 8.437 9.879v-6.988h-2.54v-2.891h2.54V9.798c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.24 0-1.628.772-1.628 1.563v1.875h2.771l-.443 2.891h-2.328v6.988C18.344 21.129 22 16.992 22 12.001c0-5.522-4.477-9.999-9.999-9.999z">
                                    </path>
                                </svg></i></a></li>
                        <li class="list-inline-item"><a href="https://www.facebook.com/EduessenceSimposio"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                    style="fill: rgba(255, 255, 255, 1)">
                                    <path
                                        d="M20.947 8.305a6.53 6.53 0 0 0-.419-2.216 4.61 4.61 0 0 0-2.633-2.633 6.606 6.606 0 0 0-2.186-.42c-.962-.043-1.267-.055-3.709-.055s-2.755 0-3.71.055a6.606 6.606 0 0 0-2.185.42 4.607 4.607 0 0 0-2.633 2.633 6.554 6.554 0 0 0-.419 2.185c-.043.963-.056 1.268-.056 3.71s0 2.754.056 3.71c.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.043 1.268.056 3.71.056s2.755 0 3.71-.056a6.59 6.59 0 0 0 2.186-.419 4.615 4.615 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.187.043-.962.056-1.267.056-3.71-.002-2.442-.002-2.752-.058-3.709zm-8.953 8.297c-2.554 0-4.623-2.069-4.623-4.623s2.069-4.623 4.623-4.623a4.623 4.623 0 0 1 0 9.246zm4.807-8.339a1.077 1.077 0 0 1-1.078-1.078 1.077 1.077 0 1 1 2.155 0c0 .596-.482 1.078-1.077 1.078z">
                                    </path>2
                                    <circle cx="11.994" cy="11.979" r="3.003"></circle>
                                </svg></i></a></li>
                        <li class="list-inline-item"><a
                                href="https://www.youtube.com/channel/UCgAQr-pjDbcPFetV5S43M8w"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                    style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                    <path
                                        d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831zM9.996 15.005l.005-6 5.207 3.005-5.212 2.995z">
                                    </path>
                                </svg>
                                </svg></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
<script defer src="../js/redirect.js"></script>
<!-- <script defer src="../js/nav.js"></script> -->
<script>
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });
</script>

</html>