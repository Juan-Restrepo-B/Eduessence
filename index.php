<?php
include_once 'model/global/clear_cache.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="68x68" href="view/img/logo1.png">
    <link rel="stylesheet" href="view/css/index/styles_index.css">
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
            <li><a href="inicio">INICIO</a></li>
            <li><a href="#services">SERVICIOS</a></li>
            <li><a href="#">CUMBRES</a></li>
            <li><a href="#">CURSOS</a></li>
        </ul>
    </header>
    <main>
        <section>
            <div class="containerA">
                <div class="rowA">

                    <div class="left">
                        <img class="left-gift" src="view/img/index/section1/fondogif.gif" alt="companylogo">
                    </div>
                    <div class="center">
                        <div class="sub-slider">
                            <div id="title-slide1" class="sub-slide visible">
                                <h2>¿Qué es <br> summit?</h2>
                            </div>
                            <div id="title-slide2" class="sub-slide invisible">
                                <h2>¿Quiénes <br> somos?</h2>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="slider">
                            <div id="slide1" class="slide-content visible">
                                <div class="slide-background txt">
                                    <p>Es un espacio dedicado al crecimiento
                                        profesional tanto teórico como práctico
                                        por intermedio de la educación continuada
                                        del personal médico y paramédico.
                                        Rompiendo paradigmas al compartir
                                        experiencias con los pares de otras latitudes,
                                        en iguales o parecidas limitantes.
                                        Así mismo, la correlación con la
                                        medicina basada en la evidencia y el
                                        conocimiento de nuevas tendencias en
                                        el cuidado integral de las personas.</p>
                                </div>
                            </div>
                            <div id="slide2" class="slide-content invisible">
                                <div class="slide-background bg-secundario txt1">
                                    <p>Edu-Essence® Es una compañía que se
                                        especializa en educación para el trabajo
                                        y desarrollo humano,teniendo como objetivos,
                                        promover la formación en la practica del trabajo
                                        mediante el desarrollo de conocimientos
                                        técnicos y habilidades para el aprovechamiento
                                        de competencias laborales especificas,
                                        contribuyendo al proceso deformación integral
                                        y permanente en aspectos académicos
                                        o laborales, mediante programas flexibles
                                        y coherentes con las necesidades
                                        y expectativas de la persona, la sociedad,
                                        las demandas del mercado laboral,
                                        del sector productivo y del entorno.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
        <section>
            <div class="containerB">
                <div class="fondB"></div>
                <div class="rowB">
                    <div class="rowB2">
                        <div class="rowB3" id="cursos">
                            <div class="fondB3"></div>
                            <div class="containerRowB3">
                                <div class="titleB3">
                                    <h2>SUMMIT</h2>
                                </div>
                                <div class="opcionB3">
                                    <div class="summit">
                                        <button class="btn-summit" onclick="redirectSummit21()">SUMMIT
                                            2021</button>
                                    </div>
                                    <div class="summit">
                                        <button class="btn-summit" onclick="redirectLogin()">SUMMIT
                                            2023</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="rowB4" id="services">
                            <div class="fondB4"></div>
                            <div class="containerRowB4">
                                <div class="titleB4">
                                    <h2>SERVICIOS</h2>
                                </div>
                                <div class="optionRowB">
                                    <ul class="list-rowB mb-2">
                                        <li class="list-inline-item"><a href="#">WEBINARS / CHARLAS / TALLERES</a></li>
                                        <li class="list-inline-item"><a href="#">CONGRESOS / SIMPOSIOS</a></li>
                                        <li class="list-inline-item"><a href="#">CURSOS A LA MEDIDA</a></li>
                                        <li class="list-inline-item"><a href="#">PROTOCOLOS / CONSENSOS / PATIENT
                                                JOURNEY</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="containerC">
                <div class="rowC">
                    <div class="tilteC">
                        <h2>PROXIMOS</h2>
                        <h2><span>EVENTOS</span></h2>
                    </div>
                    <div class="calendar">
                        <iframe src="view/pages/calendar/calendar.php" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="containerD">
                <div class="rowD">
                    <h2>VIDEOS</h2>
                    <div class="videos">
                        <iframe src="https://www.youtube.com/embed/EVBPerfuz6Q?si=m1qK1ZiyFegSxiNQ"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                        <iframe src="https://www.youtube.com/embed/zzRJ-sBBICw?si=goVnV6rPNaYM_SlX"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                        <iframe src="https://www.youtube.com/embed/r2K6EorZotU?si=m-S5BeiIfhHTsBnc"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                        <iframe src="https://www.youtube.com/embed/Es3v5XfaR0c?si=a-aWlNqVOJmPJeEl"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="containerE">
                <div class="rowE">
                    <div class="izqE">
                        <div class="logoE">
                            <img src="view/img/logos/Simposio2025.jpeg" alt="">
                        </div>
                        <div class="summit">
                            <button class="btn-summit2" onclick="redirectLogin()">INSCRIBIRME</button>
                            <button class="btn-summit2" onclick="redirectSummit2025()">MAS INFORMACIÓN</button>
                        </div>
                    </div>
                    <div class="derE">
                        <div class="infoE">
                            <h2>PATROCINADORES SUMMIT 2025</h2>
                        </div>
                        <div class="gallery">
                            
                            <div class="sponsor">
                                <img src="view/img/logos/SIPEHA.png"
                                    alt="Patrocinador 6">
                            </div>

                            <div class="sponsor-d">
                                <img src="view/img/patrocinadores/Logo_Cure_-_Natrox_page-0001-removebg-preview.png"
                                    alt="Patrocinador 6">
                            </div>

                            <div class="sponsor-d">
                                <img src="view/img/patrocinadores/PRAXIS Logo.png" alt="Patrocinador 11">
                            </div>
                            
                            <div class="sponsor-d">
                                <img src="view/img/logos/BAUSCH-HEALTH.jpeg"
                                    alt="Patrocinador 6">
                            </div>
                            
                            <div class="sponsor">
                                <img src="view/img/logos/CONVATEC.jpeg"
                                    alt="Patrocinador 6">
                            </div>
                            
                            <div class="sponsor">
                                <img src="view/img/logos/PROCAPS.jpeg"
                                    alt="Patrocinador 6">
                            </div>
                            
                            <div class="sponsor-d">
                                <img src="view/img/logos/UNIVERSIDAD-NORTE.jpeg"
                                    alt="Patrocinador 6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pop-up-memories-summit-2023" class="pop-up-memories-summit-2023" style="display: none;">
                <div class="order">
                    <div class="formulario">
                        <h2>RECUERDOS SUMMIT 2023</h2>
                        <br>
                        <iframe src="view/img/album_summit.htm" frameborder="0"></iframe>
                        <br><br>
                        <button class="btn-secundary" type="button" name="close" onclick="hidePopUp()">CERRAR</button>
                    </div>
                </div>
            </div>
            <div class="patrocinadores"></div>
        </section>
        <section>
            <div class="containerF">
                <div class="rowE">
                    <div class="izqE">
                        <div class="logoE">
                            <img src="view/img/logos/Simposio2024.jpeg" alt="">
                        </div>
                    </div>
                    <div class="derE">
                        <div class="infoE">
                            <h2>SIMPOSIO VIRTUAL EDUESSENCE DE PIE DIABETICO 2024</h2>
                        </div>
                        <br>
                        <div class="logos-marcas">
                            <div class="logo-marca">
                                <img src="view/img/logos/SIPEHA.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rowF">
                    <div class="izqF">
                        <div class="logoE">
                            <img src="view/img/logos/Summin2023.png" alt="">
                        </div>
                        <div class="summit">
                            <button class="btn-summit2" onclick="enablePopUp()" id="mostrarFormulario">RECUERDOS
                                SUMMIT 2023</button>
                        </div>
                    </div>
                    <div class="derE2">
                        <div class="infoE">
                            <h2>SUMMIT EDUESSENCE 2023 PIE DIABETICO,
                                HERIDAS COMPLEJAS Y SUS COMORBILIDADES</h2>
                        </div>
                        <div class="logos-marcas">
                            <div class="logo-marca-item">
                                <img src="view/img/logos/Alcaldia-Barranquilla.png" alt="">
                            </div>
                            <div class="logo-marca-item">
                                <img src="view/img/logos/D-Foot.png" alt="">
                            </div>
                            <div class="logo-marca-item">
                                <img src="view/img/logos/Colombia_UniversidadSimonBolivar.png" alt="">
                            </div>
                        </div>
                    </div>
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
                                    </path>
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
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script defer src="view/js/global/redirect.js"></script>
<script defer src="view/js/global/dropdown_menu.js"></script>
<script defer src="view/js/global/screen_lock.js"></script>

<script src="view/js/index/slider.js"></script>
<script src="view/js/index/pop-up.js"></script>

</html>