<?php
session_start();

$usuario = $_SESSION['user'];

include('conexion.php');

$result = mysqli_query($conn, "SELECT * FROM PERSONA WHERE PER_CORREO =  '" . $usuario . "'");

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
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
                                <img src="../img/users/<?php echo $row["PER_IMG"]; ?>" alt="">
                            </div>
                            <div class="container-left__name-user">
                                <h3>
                                    <?php echo strtoupper($row["PER_NOMBRES"]); ?>
                                    <br>
                                    <?php echo strtoupper($row["PER_APELLIDOS"]); ?>
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
                                    <li class="container-left__main-il"><a href="">
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
                                    <?php echo strtoupper($row["PER_USERS"]); ?>
                                </h2>
                            </div>
                            <form action="">
                                <div class="container-rigth__Nombre container-rigth__input">
                                    <input type="text" placeholder="<?php echo strtoupper($row["PER_NOMBRES"]); ?>">
                                </div>
                                <div class="container-rigth__Apellidos container-rigth__input">
                                    <input type="text" placeholder="<?php echo strtoupper($row["PER_APELLIDOS"]); ?>">
                                </div>
                                <div class="container-rigth__Documentos container-rigth__input">
                                    <input type="text" placeholder="<?php echo strtoupper($row["PER_DOCUMENTO"]); ?>">
                                </div>
                                <div class="container-rigth__email container-rigth__input">
                                    <input type="text" placeholder="<?php echo $row["PER_CORREO"]; ?>">
                                </div>
                                <div class="container-rigth__telefono container-rigth__input">
                                    <input type="text" placeholder="<?php echo strtoupper($row["PER_TELEFONO"]); ?>">
                                </div>
                                <div class="container-rigth__pais container-rigth__input">
                                    <input type="text" placeholder="<?php echo strtoupper($row["PER_PAIS"]); ?>">
                                </div>
                                <?php
        }
    }
}
?>
                    <button class="btn-update">ACTUALIZAR CUENTA</button>
                </form>
            </div>
        </div>
    </main>
</body>
<script src="../js/redirect.js"></script>
<script>
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