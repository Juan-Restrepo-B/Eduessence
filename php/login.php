<?php
session_start();

// Conxion con BD
include("conexion.php");

// Establecer la zona horaria a "America/Bogota"
date_default_timezone_set('America/Bogota');

// Variables
$color = 'red';
$currentHour = date('H');

// Recibe la informacion del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe el usuario y en caso contrario asigna una cadena vacía
    $usuario = isset($_POST["email"]) ? $_POST["email"] : '';
    // Recibe el password y en caso contrario asigna una cadena vacía
    $password = isset($_POST["password"]) ? $_POST["password"] : '';

    // Verifica si ambos campos están llenos
    if (!empty($usuario) && !empty($password)) {
        // Realiza la validación del usuario
        $query = mysqli_query($conn, "SELECT USERS_PERMISOS FROM USERS WHERE USER = '" . $usuario . "'");
        $nr = mysqli_num_rows($query);

        if ($nr == 1) {
            // Realiza la validación de la contraseña
            $query1 = mysqli_query($conn, "SELECT PASS FROM USERS WHERE USER = '" . $usuario . "' AND PASS = '" . $password . "'");
            $nr1 = mysqli_num_rows($query1);

            if ($nr1 == 1) {
                $row = mysqli_fetch_assoc($query);
                $user_permission = $row['USERS_PERMISOS'];
                $_SESSION['user_permission'] = $user_permission;
                $_SESSION['user'] = $usuario;
                header("Location: main.php");
                exit();
            } else {
                $color = 'red';
                $error_message = 'Contraseña incorrecta';
            }
        } else {
            $color = 'red';
            $error_message = 'Usuario incorrecto';
        }
    } else {
        $color = 'red';
        $error_message = 'Por favor, completa ambos campos';
    }
}
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
            <h2>MAIN</h2>
            <li><a href="../index.php">HOME</a></li>
            <li><a href="#">ABOUT</a></li>
            <li><a href="#">PRODUCTS</a></li>
            <li><a href="#">CONTACT</a></li>
        </ul>
    </header>
    <main>
        <section>
            <div class="container" id="container">
                <div class="right-panel-active form-container in-container" id="in-container">
                    <div class="panel-active">
                        <br>
                        <button class="btn-cuenta" id="btn-cuenta">INICIAR SESION</button>
                    </div>
                </div>
                <div class="right-panel-active form-container up-container">
                    <div class="panel-active">
                        <div class="panel-active__texto">
                            <h2>¡Eduessence: Tu Puerta al Conocimiento actualizado en el trabajo Ilimitado!
                                <br><br>
                                ¿Estás listo para desbloquear un mundo de oportunidades? Únete a Eduessence hoy y accede
                                a eventos de élite, cursos innovadores y conexiones globales. Transforma tu aprendizaje
                                y
                                alcanza nuevos horizontes.
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
                    <form action="login.php">
                        <img src="../img/logo.png" alt="">
                        <h1>CREAR CUENTA</h1>
                        <div class="social-container">
                            <a href="" class="social"><i class="fab fa-facebook-f"></i></a>
                            <a href="" class="social"><i class="fab fa-gooogle-plus-g"></i></a>
                            <a href="" class="social"><i class="fab fa-likendin-in"></i></a>
                        </div>
                        <input type="text" placeholder="Nombres">
                        <input type="text" placeholder="Apellidos">
                        <input type="email" placeholder="Email">
                        <input type="password" placeholder="Password">
                        <br><br>
                        <button id="btn-register" class="btn-register">REGISTRARSE</button>
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
                        <input type="email" placeholder="Email" name="email" required>
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
                        <span><a href="">Forgot your password?</a></span>
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
                        <li class="list-inline-item"><a href="../index.php">HOME</a></li>
                        <li class="list-inline-item"><span>⋅</span></li>
                        <li class="list-inline-item"><a href="">ABOUT</a></li>
                        <li class="list-inline-item"><span>⋅</span></li>
                        <li class="list-inline-item"><a href="#">PRODUCTS</a></li>
                        <li class="list-inline-item"><span>⋅</span></li>
                        <li class="list-inline-item"><a href="#form-contact">CONTACT</a></li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">© Juan Restrepo 2023. All Rights Reserved.</p>
                </div>
                <div class="logos">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="40"
                                    height="40" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1)">
                                    <path
                                        d="M12.001 2.002c-5.522 0-9.999 4.477-9.999 9.999 0 4.99 3.656 9.126 8.437 9.879v-6.988h-2.54v-2.891h2.54V9.798c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.24 0-1.628.772-1.628 1.563v1.875h2.771l-.443 2.891h-2.328v6.988C18.344 21.129 22 16.992 22 12.001c0-5.522-4.477-9.999-9.999-9.999z">
                                    </path>
                                </svg></i></a></li>
                        <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="40"
                                    height="40" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1)">
                                    <path
                                        d="M20.947 8.305a6.53 6.53 0 0 0-.419-2.216 4.61 4.61 0 0 0-2.633-2.633 6.606 6.606 0 0 0-2.186-.42c-.962-.043-1.267-.055-3.709-.055s-2.755 0-3.71.055a6.606 6.606 0 0 0-2.185.42 4.607 4.607 0 0 0-2.633 2.633 6.554 6.554 0 0 0-.419 2.185c-.043.963-.056 1.268-.056 3.71s0 2.754.056 3.71c.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.043 1.268.056 3.71.056s2.755 0 3.71-.056a6.59 6.59 0 0 0 2.186-.419 4.615 4.615 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.187.043-.962.056-1.267.056-3.71-.002-2.442-.002-2.752-.058-3.709zm-8.953 8.297c-2.554 0-4.623-2.069-4.623-4.623s2.069-4.623 4.623-4.623a4.623 4.623 0 0 1 0 9.246zm4.807-8.339a1.077 1.077 0 0 1-1.078-1.078 1.077 1.077 0 1 1 2.155 0c0 .596-.482 1.078-1.077 1.078z">
                                    </path>
                                    <circle cx="11.994" cy="11.979" r="3.003"></circle>
                                </svg></i></a></li>
                        <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="40"
                                    height="40" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1)">
                                    <path
                                        d="M20 3H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM8.339 18.337H5.667v-8.59h2.672v8.59zM7.003 8.574a1.548 1.548 0 1 1 0-3.096 1.548 1.548 0 0 1 0 3.096zm11.335 9.763h-2.669V14.16c0-.996-.018-2.277-1.388-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248h-2.667v-8.59h2.56v1.174h.037c.355-.675 1.227-1.387 2.524-1.387 2.704 0 3.203 1.778 3.203 4.092v4.71z">
                                    </path>
                                </svg></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="../js/redirect.js"></script>
<script src="../js/login.js"></script>
<script src="../js/nav.js"></script>

</html>