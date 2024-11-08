<?php
// Configurar la tarea programada usando schtasks
$phpPath = 'tareaProgramada\validate_user_activity.php';
$scriptPath = 'tareaProgramada\validate_user_activity.php';
$taskName = 'ValidateUserActivity';
$taskDescription = 'Tarea programada para validar la actividad del usuario y actualizar el estado del certificado.';
$startTime = '00:00'; // Hora de inicio en formato HH:MM

// Comando para crear la tarea programada
$command = "schtasks /create /tn \"$taskName\" /tr \"$phpPath $scriptPath\" /sc daily /st $startTime /f /rl highest /ru SYSTEM /d MON,TUE,WED,THU,FRI,SAT,SUN /v1";

// Ejecutar el comando
exec($command, $output, $returnVar);

if ($returnVar === 0) {
    echo "Tarea programada creada exitosamente.";
} else {
    echo "Error al crear la tarea programada.";
    print_r($output);
}
?>