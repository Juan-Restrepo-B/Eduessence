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
                            <br><br>
                            <div class="container-left__main">
                                <ul class="container-left__main-ul">
                                    <li class="container-left__main-il"><a href="">CUENTA</a></li>
                                    <li class="container-left__main-il"><a href="">CAMBIAR CLAVE</a></li>
                                    <li class="container-left__main-il"><a href="">BORRAR CUENTA</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="container-rigth">
                            <div class="container-rigth__users">
                                <h2>Cuenta: <?php echo strtoupper($row["PER_USERS"]); ?></h2>
                            </div>
                            <form action="">
                                <div class="container-rigth__Nombre">
                                    <input type="text" placeholder="<?php echo strtoupper($row["PER_NOMBRES"]); ?>">
                                </div>
                                <div class="container-rigth__Apellidos">
                                    <input type="text" placeholder="<?php echo strtoupper($row["PER_APELLIDOS"]); ?>">
                                </div>
                                <div class="container-rigth__Documentos">
                                    <input type="text" placeholder="<?php echo strtoupper($row["PER_DOCUMENTO"]); ?>">
                                </div>
                                <div class="container-rigth__email">
                                    <input type="text" placeholder="<?php echo strtoupper($row["PER_CORREO"]); ?>">
                                </div>
                                <div class="container-rigth__telefono">
                                    <input type="text" placeholder="<?php echo strtoupper($row["PER_TELEFONO"]); ?>">
                                </div>
                                <div class="container-rigth__pais">
                                    <input type="text" placeholder="<?php echo strtoupper($row["PER_PAIS"]); ?>">
                                </div>
                                <?php
        }
    }
}
?>
                    <button>ACTUALIZAR LA CUENTA</button>
                </form>
            </div>
        </div>
    </main>
</body>
<script src="../js/redirect.js"></script>

</html>