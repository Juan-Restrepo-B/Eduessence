<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="48x48" href="../img/logo1.png">
    <link rel="stylesheet" href="view\css\summit\styles_summit25.css">
    <title>EDUESSENCE</title>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="view/img/logo.png" alt="">
            </div>
            <div class="option">
                <div class="start">
                    <button class="btn-login" onclick="redirectLogin()">INICIAR SESIÓN</button>
                </div>
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
        <div class="background-menu"></div>
        <ul class="ul-main" id="main-menu">
            <h2>MENÚ</h2>
            <li><a href="/inicio">INICIO</a></li>
            <li><a href="/inicio#services">SERVICIOS</a></li>
            <li><a href="#">CUMBRES</a></li>
            <li><a href="#">CURSOS</a></li>
        </ul>
    </header>
    <main>
        <section>
            <div class="main-container">
                <div class="main-content main-left-side">
                    <div class="container-row">
                        <div class="container-row__title">
                            <h2 class="container-row__title-h2">SUMMIT <br> <span>2025</span></h2>
                        </div>
                        <div class="logos-marcas">
                            <div class="logo-marca">
                                <img src="view/img/logos/SIPEHA.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="container-row__text">
                        <p class="container-row__text-p c-gray">
                            Es un espacio dedicado al crecimiento profesional tanto teórico como práctico por intermedio
                            de la
                            educación continuada del personal médico y paramédico.
                        </p>
                    </div>
                    <div class="max-900px">
                        <li class="list" ><div class="negrilla"> PRE SUMMIT </div>CURSO ESPECIALIZADO EN PODOLOGIA 6 DE AGOSTO DE 2025<div class="negrilla"> EN UNINORTE</div></li>
                        <li class="list"  ><div class="negrilla"> PRE SUMMIT </div>CURSO ESPECUALIZADO EN PODOLOGIA 7 DE AGOSTO DE 2025</li>
                        <li>SUMMIT EN PIE DIABETICO Y HERIDAS COMPLEJAS 7 Y 8 DE AGOSTO DE 2025</li>
                        <p class="negrilla">LUGAR DEL EVENTO CENTRO DE CONVENCIONES BLUE GARDENS, BARRANQUILLA COLOMBIA</p>
                    </div>
                </div>

                <div class="main-content main-right-side">
                    <video src="view/video/summit/public_summit_2025.mp4" controls></video>
                    <button class="btn-summit2" onclick="redirectLogin()">INSCRIBIRME</button>
                </div>
            </div>

        </section>

    </main>
    <footer class="bg-light footer">
        <div class="containerFooter">
            <div class="row">
                <div class="optionL">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item"><a href="/inicio">INICIO</a></li>
                        <li class="list-inline-item"><span>⋅</span></li>
                        <li class="list-inline-item"><a href="/inicio#services">SERVICIOS</a></li>
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
                                    style="fill: rgba(255, 255, 255, 1);">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script defer src="view/js/global/redirect.js"></script>
<script defer src="view/js/global/dropdown_menu.js"></script>
<!-- <script defer src="view/js/global/screen_lock.js"></script> -->

</html>