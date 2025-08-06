<?php
session_start();

$usuario = isset($_SESSION['useremail']) ? $_SESSION['useremail'] : null;
$ip_cliente = $_SERVER['REMOTE_ADDR'];

include_once '../../../model/main_process/new_session.php';
include_once '../../../model/main_process/role_confirm.php';

if ($usuario === null || $usuario === '') {
    header("Location: /login");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="68x68" href="view/img/logo1.png">
    <link rel="stylesheet" href="view/css//main/styles_main.css">
    <title>EDUESSENCE</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="view/img/logo.png" alt="">
            </div>
            <div class="containerAlert">
                <!-- <div class="alert">
                    <div class="rowAlert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                            style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                            <path d="M11.001 10h2v5h-2zM11 16h2v2h-2z"></path>
                            <path
                                d="M13.768 4.2C13.42 3.545 12.742 3.138 12 3.138s-1.42.407-1.768 1.063L2.894 18.064a1.986 1.986 0 0 0 .054 1.968A1.984 1.984 0 0 0 4.661 21h14.678c.708 0 1.349-.362 1.714-.968a1.989 1.989 0 0 0 .054-1.968L13.768 4.2zM4.661 19 12 5.137 19.344 19H4.661z">
                            </path>
                        </svg>
                        <h2>
                            RECOMENDAMOS NO CERRAR EL NAVEGADOR SIN HABER FINALIZADO LA SESIÓN, <br> PARA EVITAR
                            BLOQUEOS DE
                            LA CUENTA
                        </h2>
                    </div>
                </div> -->
            </div>
            <div class="option">
                <div class="start">
                    <form method="post" action="../../../model/global/logout.php">
                        <button class="btn-login" type="submit" name="logout">CERRAR SESIÓN</button>
                    </form>
                </div>
            </div>
            </div>
        </nav>
    </header>
    <main class="screen-manager">
        <Section class="options">
            <div class="main-menu">
                <?php if (showButtons(1)): ?>
                    <div class="icon-container">
                        <a href="/calendario" class="menu-icon" target="contentMain">
                            <!-- CALENDARIO -->
                            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                style="fill: rgba(0, 0, 0, 1);">
                                <path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm4-4h2v2h-2zm4-4h2v2h-2z"></path>
                                <path
                                    d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z">
                                </path>
                            </svg>
                            <div class="hover-text">CALENDARIO</div>
                        </a>
                    </div>

                <?php endif; ?>
                <?php if (showButtons(1)): ?>
                    <div class="icon-container">
                        <a href="/validar_pago_curso" class="menu-icon" target="contentMain">
                            <!-- validar pago curso -->
                            <svg class="menu-icon" fill="#000000" viewBox="0 0 24 24" transform="" id="injected-svg">
                                <path
                                    d="M21 8H7c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h14c.55 0 1-.45 1-1V9c0-.55-.45-1-1-1m-1 8c-1.1 0-2 .9-2 2h-8c0-1.1-.9-2-2-2v-4c1.1 0 2-.9 2-2h8c0 1.1.9 2 2 2z" />
                                <path d="M18 4H3c-.55 0-1 .45-1 1v11h2V6h14zM14 12a2 2 0 1 0 0 4 2 2 0 1 0 0-4" />
                            </svg>
                            <div class="hover-text">VALIDAR PAGOS CURSOS</div>
                        </a>
                    </div>

                <?php endif; ?>
                <?php if (showButtons(1)): ?>
                    <div class="icon-container">
                        <a href="/curso_update" class="menu-icon" target="contentMain"><!-- CARGAR CURSO -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                <path
                                    d="M12.001 1.993C6.486 1.994 2 6.48 2 11.994c.001 5.514 4.487 10 10 10 5.515 0 10.001-4.486 10.001-10s-4.486-10-10-10.001zM12 19.994c-4.41 0-7.999-3.589-8-8 0-4.411 3.589-8 8.001-8.001 4.411.001 8 3.59 8 8.001s-3.589 8-8.001 8z">
                                </path>
                                <path d="m12.001 8.001-4.005 4.005h3.005V16h2v-3.994h3.004z"></path>
                            </svg>
                            <div class="hover-text">CARGAR CURSO</div>
                        </a>
                    </div>

                <?php endif; ?>
                <!-- <div class="icon-container">
                    <a href="../clases/index.php" class="menu-icon" target="contentMain"> CHARLAS 
                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1);">
                            <path
                                d="M18 11c0-.959-.68-1.761-1.581-1.954C16.779 8.445 17 7.75 17 7c0-2.206-1.794-4-4-4-1.516 0-2.822.857-3.5 2.104C8.822 3.857 7.516 3 6 3 3.794 3 2 4.794 2 7c0 .902.312 1.726.817 2.396A1.993 1.993 0 0 0 2 11v8c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-2.637l4 2v-7l-4 2V11zm-5-6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2zM6 5c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2z">
                            </path>
                        </svg>
                        <div class="hover-text">CHARLAS</div>
                    </a>
                </div>-->
                <div class="icon-container">
                    <a href="/cuadernillo" class="menu-icon" target="contentMain"> <!-- CUADERNILLOS -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path
                                d="M8.267 14.68c-.184 0-.308.018-.372.036v1.178c.076.018.171.023.302.023.479 0 .774-.242.774-.651 0-.366-.254-.586-.704-.586zm3.487.012c-.2 0-.33.018-.407.036v2.61c.077.018.201.018.313.018.817.006 1.349-.444 1.349-1.396.006-.83-.479-1.268-1.255-1.268z">
                            </path>
                            <path
                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM9.498 16.19c-.309.29-.765.42-1.296.42a2.23 2.23 0 0 1-.308-.018v1.426H7v-3.936A7.558 7.558 0 0 1 8.219 14c.557 0 .953.106 1.22.319.254.202.426.533.426.923-.001.392-.131.723-.367.948zm3.807 1.355c-.42.349-1.059.515-1.84.515-.468 0-.799-.03-1.024-.06v-3.917A7.947 7.947 0 0 1 11.66 14c.757 0 1.249.136 1.633.426.415.308.675.799.675 1.504 0 .763-.279 1.29-.663 1.615zM17 14.77h-1.532v.911H16.9v.734h-1.432v1.604h-.906V14.03H17v.74zM14 9h-1V4l5 5h-4z">
                            </path>
                        </svg>
                    </a>
                    <div class="hover-text">CUADERNILLOS</div>
                </div>
                <div class="icon-container"> <!-- CURSOS -->
                    <a href="/cursos" class="menu-icon" target="contentMain">
                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1);">
                            <path
                                d="M6.012 18H21V4a2 2 0 0 0-2-2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.805 5 19s.55-.988 1.012-1zM8 6h9v2H8V6z">
                            </path>
                        </svg>
                    </a>
                    <div class="hover-text">CURSOS</div>
                </div>
                <div class="icon-container"> <!-- DIPLOMMAS -->
                    <a href="/certificado" class="menu-icon" target="contentMain">
                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1);">
                            <path d="M2 7v1l11 4 9-4V7L11 4z"></path>
                            <path
                                d="M4 11v4.267c0 1.621 4.001 3.893 9 3.734 4-.126 6.586-1.972 7-3.467.024-.089.037-.178.037-.268V11L13 14l-5-1.667v3.213l-1-.364V12l-3-1z">
                            </path>
                        </svg>
                    </a>
                    <div class="hover-text">CERTIFICADOS</div>
                </div>
                <div class="icon-container">
                    <a href="/scan_qr" class="menu-icon" target="contentMain"> <!-- SCAN QR -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <!--Boxicons v3.0 https://boxicons.com | License  https://docs.boxicons.com/free-->
                            <path d="m4,4h4v-2h-4c-1.1,0-2,.9-2,2v4h2v-4Z"></path>
                            <path d="m4,16h-2v4c0,1.1.9,2,2,2h4v-2h-4v-4Z"></path>
                            <path d="m20,20h-4v2h4c1.1,0,2-.9,2-2v-4h-2v4Z"></path>
                            <path d="m20,2h-4v2h4v4h2v-4c0-1.1-.9-2-2-2Z"></path>
                            <path
                                d="m9.5,5h-3c-.83,0-1.5.67-1.5,1.5v3c0,.83.67,1.5,1.5,1.5h3c.83,0,1.5-.67,1.5-1.5v-3c0-.83-.67-1.5-1.5-1.5Zm-.5,4h-2v-2h2v2Z">
                            </path>
                            <path
                                d="m9.5,13h-3c-.83,0-1.5.67-1.5,1.5v3c0,.83.67,1.5,1.5,1.5h3c.83,0,1.5-.67,1.5-1.5v-3c0-.83-.67-1.5-1.5-1.5Zm-.5,4h-2v-2h2v2Z">
                            </path>
                            <path
                                d="m14.5,11h3c.83,0,1.5-.67,1.5-1.5v-3c0-.83-.67-1.5-1.5-1.5h-3c-.83,0-1.5.67-1.5,1.5v3c0,.83.67,1.5,1.5,1.5Zm.5-4h2v2h-2v-2Z">
                            </path>
                            <path d="M13 13H15V15H13z"></path>
                            <path d="M15 15H17V17H15z"></path>
                            <path d="M17 17H19V19H17z"></path>
                            <path d="M17 13H19V15H17z"></path>
                        </svg>
                    </a>
                    <div class="hover-text">SCANNER QR</div>
                </div>
                <?php if (showButtons(3)): ?>
                    <div class="icon-container"> <!-- WORDPRES -->
                        <!-- <a href="#" class="menu-icon" target="contentMain"> -->
                        <!-- <svg class="admin menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                style="fill: rgba(0, 0, 0, 1);">
                                <path
                                    d="M20 6c0-2.168-3.663-4-8-4S4 3.832 4 6v2c0 2.168 3.663 4 8 4s8-1.832 8-4V6zm-8 13c-4.337 0-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3c0 2.168-3.663 4-8 4z">
                                </path>
                                <path d="M20 10c0 2.168-3.663 4-8 4s-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3z">
                                </path>
                            </svg>
                            <div class="hover-text">WORDPRES</div> -->
                        <!-- </a> -->
                    </div>
                <?php endif; ?>
                <div class="icon-container end-option">
                    <a href="usuario" class="menu-icon" target="contentMain"> <!-- USUARIO -->
                        <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path
                                d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z">
                            </path>
                        </svg>
                        <div class="hover-text">USUARIO</div>
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
            <iframe id="mainIframe" name="contentMain" frameborder="0"></iframe>
        </section>
    </main>
    <footer class="bg-light footer">
        <div class="containerFooter">
            <div class="row">
                <div class="optionL">
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
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Sr(a) usuario(a).</h2>
            <p>Por favor valide los datos personales estos seran utilizados para la generacion de los certificados.</p>
        </div>
    </div> -->

</body>

<script src="view/js/global/redirect.js"></script>
<script defer src="view/js/global/screen_lock.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const popup = document.getElementById('popup');
        const closeBtn = document.querySelector('.close-btn');

        closeBtn.addEventListener('click', () => {
            popup.style.display = 'none';
        });
    });
</script>

<script>
    // Detectar ancho de la ventana
    const iframe = document.getElementById('mainIframe');

    if (window.innerWidth <= 768) {
        // Dispositivo móvil
        iframe.src = 'scan_qr';
    } else {
        // PC o tablet
        iframe.src = 'cursos';
    }
</script>

</html>