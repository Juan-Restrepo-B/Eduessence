<?php

include_once '../../../model/users/users_process.php';

$usuario_imagen = isset($_SESSION['USUARIO_IMAGEN']) ? $_SESSION['USUARIO_IMAGEN'] : 'default.png';
$persona_nombres = isset($_SESSION['PERSONA_NOMBRES']) ? $_SESSION['PERSONA_NOMBRES'] : 'No encontrado';
$persona_apellidos = isset($_SESSION['PERSONA_APELLIDOS']) ? $_SESSION['PERSONA_APELLIDOS'] : 'No encontrado';

$usuario_nombre = isset($_SESSION['USUARIO_USER']) ? $_SESSION['USUARIO_USER'] : 'No encontrado';

$persona_correo = isset($_SESSION['PERSONA_CORREO']) ? $_SESSION['PERSONA_CORREO'] : 'No encontrado';
$persona_documentos = isset($_SESSION['PERSONA_DOCUMENTO']) ? $_SESSION['PERSONA_DOCUMENTO'] : 'No encontrado';
$persona_telefono = isset($_SESSION['PERSONA_TELEFONO']) ? $_SESSION['PERSONA_TELEFONO'] : 'No encontrado';
$persona_pais = isset($_SESSION['PERSONA_PAIS']) ? $_SESSION['PERSONA_PAIS'] : 'No encontrado';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="48x48" href="../img/logo1.png">
    <link rel="stylesheet" href="view/css/users/styles_users.css">
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
                    <?php if (isset($base64)): ?>
                        <img src="data:image/jpeg;base64,<?php echo $base64; ?>" alt="Imagen desde Blob">
                    <?php else: ?>
                        <p>No se pudo cargar la imagen.</p>
                    <?php endif; ?>
                </div>
                <div class="container-left__name-user">
                    <h3>
                        <?php echo strtoupper($persona_nombres); ?>
                        <br>
                        <?php echo strtoupper($persona_apellidos); ?>
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
                                data-idpersona="<?php echo strtoupper($persona_correo); ?>">
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
                        <?php echo strtoupper($usuario_nombre); ?>
                    </h2>
                </div>
                <form action="../../../model/users/users_process.php" method="post">
                    <label for="nombres">NOMBRES:</label>
                    <div class="container-rigth__Nombre container-rigth__input">
                        <input type="text" name="nombres" placeholder="<?php echo strtoupper($persona_nombres); ?>"
                            value="<?php echo strtoupper($persona_nombres); ?>">
                    </div>
                    <label for="apellidos">APELLIDOS:</label>
                    <div class="container-rigth__Apellidos container-rigth__input">
                        <input type="text" name="apellidos" placeholder="<?php echo strtoupper($persona_apellidos); ?>"
                            value="<?php echo strtoupper($persona_apellidos); ?>">
                    </div>
                    <label for="documento">DOCUMENTO:</label>
                    <div class="container-rigth__Documentos container-rigth__input">
                        <input type="text" name="documento" placeholder="<?php echo strtoupper($persona_documentos); ?>"
                            value="<?php echo strtoupper($persona_documentos); ?>">
                    </div>
                    <label for="correo">CORREO:</label>
                    <div class="container-rigth__email container-rigth__input">
                        <input type="text" name="correo" placeholder="<?php echo strtoupper($persona_correo); ?>"
                            readonly>
                    </div>
                    <label for="telefono">TELEFONO:</label>
                    <div class="container-rigth__telefono container-rigth__input">
                        <input type="text" name="telefono" placeholder="<?php echo strtoupper($persona_telefono); ?>"
                            value="<?php echo strtoupper($persona_telefono); ?>">
                    </div>
                    <label for="pais">PAÍS:</label>
                    <div class="container-rigth__pais container-rigth__input">
                        <input type="text" name="pais" placeholder="<?php echo strtoupper($persona_pais); ?>"
                            value="<?php echo strtoupper($persona_pais); ?>">
                    </div>
                    <button class="btn-update" name="actualizarCuenta">ACTUALIZAR CUENTA</button>
                </form>

            </div>
        </div>
        <div id="formularioEmergente" class="formularioEmergent" style="display: none;">
            <div class="order">
                <div class="formulario">
                    <div>
                        <form id="cambioClaveForm" action="../../../model/users/cambiar_clave.php" method="post">
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

<script src="view/js/global/redirect.js"></script>
<script defer src="view/js/global/screen_lock.js"></script>

<script defer src="view/js/users/users_logic.js"></script>

</html>