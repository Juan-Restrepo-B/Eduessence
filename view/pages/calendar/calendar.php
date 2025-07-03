<?php
//realizar la coneccion a la base de datos
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CALENDARIO</title>
    <link rel="stylesheet" href="../../css/calendar/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/calendar/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/calendar/assets/css/Bootstrap-Calendar.css">
    <link rel="stylesheet" href="../../css/calendar/assets/css/Calendar-BS4-news.css">
    <link rel="stylesheet" href="../../css/calendar/assets/css/Calendar-BS4.css">
    <link rel="stylesheet" href="../../css/calendar/styles_calendar.css">

</head>
<?php
include_once '../../../model/calendar/queryInfo.php';
?>

<body>

    <div style="margin:46px;">
        <?php
        while ($mostrar = $resultado->fetch_assoc()) {
            $mesInCapitalizado = ucwords($mostrar["MesIn"]);
            $lDiaCapitalizado = ucwords($mostrar["LDia"]);
            ?>

            <div class="row row-striped">
                <div class="col-2 text-center ">
                    <!--ingresar el dia -->
                    <h1 class="display-4 "><span class="badge date-green"><?php echo $mostrar['Dia'] ?></span></h1>
                    <!--Ingresa las tres primeras iniciales del mes-->
                    <h2><?php echo $mesInCapitalizado ?></h2>
                </div>
                <div class="col-10">
                    <!--Ingresa nombre titulo de la charla-->
                    <h3 class="text-uppercase"><strong>
                            <?php echo $mostrar['cal_event'] ?>
                        </strong></h3>
                    <ul class="list-inline">
                        <!--ingresa el dia en nombre lunes, martes... domingo-->
                        <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;
                            <?php echo $lDiaCapitalizado ?>
                        </li>
                        <!--ingresa hora inicio y hora final-->
                        <li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                            <?php echo $mostrar['HoraIn'] ?>&nbsp;-&nbsp;
                            <?php echo $mostrar['HoraOut'] ?>&nbsp;
                            GMT-5
                        </li>
                        <!--ingresa ubicaion del evento-->
                        <li class="list-inline-item"><i class="fa fa-location-arrow" aria-hidden="true"></i>&nbsp;
                            <?php echo $mostrar['cal_ubicacion'] ?>
                        </li>
                    </ul>
                    <ul class="list-inline"></ul>
                    <!--ingres nombre del exponenete-->
                    <li class="list-inline-item"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                        <?php echo $mostrar['cal_speaker'] ?>
                    </li>
                    <!--ingresa pais-->
                    <li class="list-inline-item"><i class="fa fa-flag" aria-hidden="true"></i>&nbsp;
                        <?php echo $mostrar['cal_pais'] ?>
                    </li>
                    </ul>
                    <!--ingres descripcion del evento-->
                    <p>
                        <?php echo $mostrar['cal_description'] ?>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        document.addEventListener('selectstart', function (e) {
            e.preventDefault();
        });
    </script>

</body>

</html>