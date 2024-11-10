<?php
session_start();

// Conxion con BD
include("conexion.php");
$ip_cliente = $_SERVER['REMOTE_ADDR'];

// Establecer la zona horaria a "America/Bogota"
date_default_timezone_set('America/Bogota');

// Variables
$color = 'red';
$currentHour = date('H');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir el correo electrónico y la contraseña enviados por el usuario
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Realizar la consulta SQL para verificar las credenciales
    $sql = "SELECT USUARIO_USER, USUARIO_CLAVE, USUARIO_NOMBRE FROM TR_USUARIOS INNER JOIN TR_PERSONA ON USUARIO_NOMBRE = PERSONA_CORREO WHERE (USUARIO_USER = ? OR USUARIO_NOMBRE = ?)AND PERSONA_ESTADO = 'ACTIVO'";
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario con ese correo electrónico
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["USUARIO_CLAVE"];

        // Verificar si la contraseña es válida
        if (password_verify($password, $storedPassword)) {
            //     $user_permission = $row['USERS_PERMISOS'];
            //     $_SESSION['user_permission'] = $user_permission;
            // Las credenciales son válidas, iniciar sesión
            $useremail = $row["USUARIO_NOMBRE"];
            $_SESSION['useremail'] = $useremail; // Store the value in the session

            header("Location: main.php"); // Redirigir a la página principal
            exit();
        } else {
            $color = 'red';
            $error_message = "Contraseña incorrecta.";
        }
    } else {
        $color = 'red';
        $error_message = "Usuario no encontrado.";
    }

    // Cerrar la consulta preparada
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="48x48" href="../img/logo1.png">
    <link rel="stylesheet" href="../css/styles_login.css">
    <title>EDUESSENCE</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../img/logo.png" alt="">
            </div>
            <div class="option">
                <div class="main">
                    <input type="checkbox" id="btn-main" class="btn-main">
                    <label for="btn-main" class="lbl-main">
                        <span id="spn1"></span>
                        <span id="spn2"></span>
                        <span id="spn3"></span>
                    </label>
                </div>
            </div>
        </nav>
        <div class="fondMain"></div>
        <ul class="ul-main" id="main-menu">
            <h2>MENÚ</h2>
            <li><a href="../index.php">INICIO</a></li>
            <li><a href="../index.php#services">SERVICIOS</a></li>
            <li><a href="#">CUMBRES</a></li>
            <li><a href="#">CURSOS</a></li>
        </ul>
    </header>
    <main>
        <section>
            <div class="container" id="container">
                <div class="right-panel-active form-container in-container" id="in-container">
                    <div class="panel-active">
                        <div class="panel-active__texto">
                            <h2>¡Eduessence: Tu Puerta al Conocimiento actualizado en el trabajo ilimitado!
                                <br><br>
                                ¿Estás listo para desbloquear un mundo de oportunidades? Únete a Eduessence hoy y accede
                                a eventos de élite, cursos innovadores y conexiones globales. Transforma tu aprendizaje
                                y alcanza nuevos horizontes.
                                <br><br>
                                ¡Inicia sesión y continua tu viaje hacia nuevos conocimientos
                                practicos!
                            </h2>
                        </div>
                        <br>
                        <button class="btn-cuenta" id="btn-cuenta">INICIAR SESION</button>
                    </div>
                </div>
                <div class="right-panel-active form-container up-container">
                    <div class="panel-active">
                        <div class="panel-active__texto">
                            <h2>¡Eduessence: Tu Puerta al Conocimiento actualizado en el trabajo ilimitado!
                                <br><br>
                                ¿Estás listo para desbloquear un mundo de oportunidades? Únete a Eduessence hoy y accede
                                a eventos de élite, cursos innovadores y conexiones globales. Transforma tu aprendizaje
                                y alcanza nuevos horizontes.
                                <br><br>
                                ¡Regístrate ahora y comienza tu viaje hacia nuevos conocimientos
                                practicos!
                            </h2>
                        </div>
                        <br>
                        <button class="btn-NewCuenta" id="btn-NewCuenta">REGISTRARSE</button>
                    </div>
                </div>
                <div class="form-container sign-up-container">
                    <form action="register.php" method="POST">
                        <img src="../img/logo.png" alt="">
                        <h1>CREAR CUENTA</h1>
                        <input type="text" name="nombres" placeholder="Nombres" required>
                        <input type="text" name="apellidos" placeholder="Apellidos" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password1" placeholder="Password" required>
                        <br>
                        <button type="submit" class="btn-register">REGISTRARSE</button>
                    </form>
                </div>

                <div class="form-container sign-in-container">
                    <form action="login.php" method="POST">
                        <img src="../img/logo.png" alt="">
                        <h1>INICIAR SESION</h1>
                        <div class="social-container">
                            <a href="" class="social"><i class="fab fa-facebook-f"></i></a>
                            <a href="" class="social"><i class="fab fa-gooogle-plus-g"></i></a>
                            <a href="" class="social"><i class="fab fa-likendin-in"></i></a>
                        </div>
                        <input type="text" placeholder="Usuario o Email" name="email" required>
                        <input type="password" placeholder="Password" name="password" required>
                        <br>
                        <?php if (isset($error_message)): ?>
                            <span style="color: <?= $color; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                    style="fill: rgba(255, 0, 0, 1);transform: ;msFilter:;">
                                    <path
                                        d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z">
                                    </path>
                                    <path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path>
                                </svg>
                                <?= $error_message; ?>
                            </span>
                        <?php endif; ?>
                        <br>
                        <!-- <span><a href="">Forgot your password?</a></span> -->
                        <br><br>
                        <button id="btn-logging" class="btn-logging">INICIAR</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-light footer">
        <div class="containerFooter">
            <div class="row">
                <div class="optionL">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item"><a href="../index.php">INICIO</a></li>
                        <li class="list-inline-item"><span>⋅</span></li>
                        <li class="list-inline-item"><a href="../index.php#services">SERVICIOS</a></li>
                        <li class="list-inline-item"><span>⋅</span></li>
                        <li class="list-inline-item"><a href="#">CUMBRES</a></li>
                        <li class="list-inline-item"><span>⋅</span></li>
                        <li class="list-inline-item"><a href="#">CURSOS</a></li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">© Juan Restrepo 2023. All Rights Reserved.</p>
                    <p class="text-muted small mb-4 mb-lg-0">© Diego Bastidas 2023. All Rights Reserved.</p>
                </div>
                <div class="logos">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/EduessenceSimposio" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                    style="fill: rgba(255, 255, 255, 1)">
                                    <path
                                        d="M12.001 2.002c-5.522 0-9.999 4.477-9.999 9.999 0 4.99 3.656 9.126 8.437 9.879v-6.988h-2.54v-2.891h2.54V9.798c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.24 0-1.628.772-1.628 1.563v1.875h2.771l-.443 2.891h-2.328v6.988C18.344 21.129 22 16.992 22 12.001c0-5.522-4.477-9.999-9.999-9.999z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://instagram.com/eduess2022?igshid=NjIwNzIyMDk2Mg==" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                    style="fill: rgba(255, 255, 255, 1)">
                                    <path
                                        d="M20.947 8.305a6.53 6.53 0 0 0-.419-2.216 4.61 4.61 0 0 0-2.633-2.633 6.606 6.606 0 0 0-2.186-.42c-.962-.043-1.267-.055-3.709-.055s-2.755 0-3.71.055a6.606 6.606 0 0 0-2.185.42 4.607 4.607 0 0 0-2.633 2.633 6.554 6.554 0 0 0-.419 2.185c-.043.963-.056 1.268-.056 3.71s0 2.754.056 3.71c.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.043 1.268.056 3.71.056s2.755 0 3.71-.056a6.59 6.59 0 0 0 2.186-.419 4.615 4.615 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.187.043-.962.056-1.267.056-3.71-.002-2.442-.002-2.752-.058-3.709zm-8.953 8.297c-2.554 0-4.623-2.069-4.623-4.623s2.069-4.623 4.623-4.623a4.623 4.623 0 0 1 0 9.246zm4.807-8.339a1.077 1.077 0 0 1-1.078-1.078 1.077 1.077 0 1 1 2.155 0c0 .596-.482 1.078-1.077 1.078z">
                                    </path>2
                                    <circle cx="11.994" cy="11.979" r="3.003"></circle>
                                </svg>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.youtube.com/channel/UCgAQr-pjDbcPFetV5S43M8w" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                    style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                    <path
                                        d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831zM9.996 15.005l.005-6 5.207 3.005-5.212 2.995z">
                                    </path>
                                </svg>
                            </a>
                            </i>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="../js/redirect.js"></script>
<script src="../js/login.js"></script>
<script src="../js/nav.js"></script>
<script>
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    document.addEventListener('selectstart', function (e) {
        e.preventDefault();
    });
</script>

</html>