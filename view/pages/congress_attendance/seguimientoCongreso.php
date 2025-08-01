<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="68x68" href="view/img/logo1.png">
    <!-- <meta http-equiv="refresh" content="30;url=inicio"> -->
    <link rel="stylesheet" href="view\css\congress_attendance\Style_RegistroE.css">
    <title>Check-in exitoso</title>
</head>
<?php
session_start();
?>

<body>
    <div id="Emergente" class="Emergente">
        <div class="order">
            <div class="container">
                <div class="contenido">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z">
                            </path>
                            <path d="M9.999 13.587 7.7 11.292l-1.412 1.416 3.713 3.705 6.706-6.706-1.414-1.414z"></path>
                        </svg>
                    </div>
                    <div class="text">
                            SIMPOCIO REGISTRADO
                        <br>
                        <span>
                            <?php echo $_SESSION['userid'] ?? $_SESSION['useremail'] ?? 'Usuario no registrado'; ?>
                        <br><br>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>&copy;Todos los derechos reservados por &nbsp;
        <div class="class"> Juan Restrepo</div>
        </p>
    </footer>
</body>

</html>