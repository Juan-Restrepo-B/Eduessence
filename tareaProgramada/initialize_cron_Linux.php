<?php
// Ruta al ejecutable de PHP
$phpPath = 'tareaProgramada\validate_user_activity.php';
// Ruta al script PHP que deseas ejecutar
$scriptPath = 'tareaProgramada\validate_user_activity.php';
// Nombre del cron job
$cronJob = "0 0 * * * $phpPath $scriptPath";

// Añadir el cron job al crontab del usuario actual
exec("crontab -l", $output);
if (!in_array($cronJob, $output)) {
    $output[] = $cronJob;
    file_put_contents('/tmp/crontab.txt', implode(PHP_EOL, $output) . PHP_EOL);
    exec("crontab /tmp/crontab.txt");
    unlink('/tmp/crontab.txt');
    echo "Cron job añadido exitosamente.";
} else {
    echo "El cron job ya existe.";
}
?>