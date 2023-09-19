<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="48x48" href="../img/logo1.png">
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
                    <button class="btn-login" onclick="redireccionarALogin()">INICIAR SESIÓN</button>
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
        <div class="fondMain"></div>
        <ul class="ul-main" id="main-menu">
            <h2>MENÚ</h2>
            <li><a href="index.php">INICIO</a></li>
            <li><a href="#services">SERVICIOS</a></li>
            <li><a href="#">CUMBRES</a></li>
            <li><a href="#cursos">CURSOS</a></li>
        </ul>
    </header>
    <main>
        <section>
            <div class="container">
                <div class="container-row">
                    <div class="container-row__title">
                        <h2 class="container-row__title-h2">SUMMIT <span>2021</span></h2>
                    </div>
                    <div class="container-row__text">
                        <p class="container-row__text-p">
                            Es un espacio dedicado al crecimiento profesional tanto teórico como práctico por intermedio
                            de la
                            educación continuada del personal médico y paramédico.
                        </p>
                    </div>
                    <div class="container-row__button">
                        <button>Repetición Charlas SUMMIT 2021</button>
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
                        <li class="list-inline-item"><a href="index.php">HOME</a></li>
                        <li class="list-inline-item"><span>⋅</span></li>
                        <li class="list-inline-item"><a href="php/about.php">ABOUT</a></li>
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
<script src="../js/nav.js"></script>

</html>