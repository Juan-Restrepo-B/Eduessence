<?php
include("con_db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

try {
    // Consulta a la base de datos
    $query = "SELECT PERSONA_NOMBRES, PERSONA_APELLIDOS, PERSONA_CORREO FROM TR_PERSONA";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nombreApellido = $row['PERSONA_NOMBRES'] . ' ' . $row['PERSONA_APELLIDOS'];
            $email = $row['PERSONA_CORREO'];

            $mail = new PHPMailer(true);

            try {
                // Configuración del servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'eduessence.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'pruebas@eduessence.com';
                $mail->Password = 'nH2VCuS[4gEA';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Cambiado a SMTPS
                $mail->Port = 465; // Puerto para SMTPS

                // Deshabilitar la verificación del certificado
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                // Configuración de codificación de caracteres
                $mail->CharSet = 'UTF-8'; // Esto soluciona el problema de las tildes y caracteres especiales
                
                // Remitente y destinatario
                $mail->setFrom("info@eduessence.com", "EDUESSENCE");
                $mail->addAddress($email);
                $mail->isHTML(true);

                $mail->Subject = "INVITACIÓN A SIMPOSIO VIRTUAL EDUESSENCE 2024 ACTUALIZACIÓN EN PIE DIABÉTICO";

                // Personalizar el cuerpo del correo con datos del usuario
                $mail->Body = '
                <table width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border: 1px solid #ddd;">
                    <tr>
                        <td style="text-align: center; padding: 20px;">
                            <img src="https://www.eduessence.com/img/logo.png" alt="Logo de Eduessence" width="300">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; text-align: left;">
                            <p style="font-size: 16px; font-weight: bold;">Buen día, Sr(a). ' . htmlspecialchars($nombreApellido, ENT_QUOTES, 'UTF-8') . '</p>
                            <p>Hoy estamos invitándolo a nuestro SIMPOSIO VIRTUAL EDUESSENCE 2024 que se realizará el 30 de
                                noviembre de este año.
                                En nuestra plataforma totalmente gratuita los esperamos. Puede acceder al video de cómo registrarse
                                haciendo clic en la imagen de abajo:</p>
                            <table width="100%" cellspacing="0" cellpadding="0" style="background-color: #eef; padding: 20px; text-align: center;">
                                <tr>
                                    <td>
                                        <p style="font-size: 20px; font-weight: bold; margin: 0;">CÓMO REGISTRARSE</p>
                                        <br>
                                        <a href="https://www.youtube.com/watch?v=VD5-w1H6hYc" target="_blank" style="text-decoration: none;">
                                            <img src="https://img.youtube.com/vi/VD5-w1H6hYc/0.jpg" alt="Ver video en YouTube" style="width: 400px; border: 1px solid #ddd;">
                                        </a>
                                        <br><br>
                                        <a href="https://eduessence.com/php/login.php" style="font-size: 16px; font-weight: bold; border: solid 2px #007bff; padding: 5px 10px; border-radius: 10px; 
                                        margin-button: 10px; text-decoration: none;">REGISTRARME</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; padding: 20px; font-size: 12px;">
                            Atentamente,<br>
                            El equipo de Eduessence
                        </td>
                    </tr>
                </table>';

                // Enviar el correo
                $mail->send();
                echo "Correo enviado a: $email";
            } catch (Exception $e) {
                echo "Error al enviar el correo a $email. Error: {$mail->ErrorInfo}<br>";
            }
        }
    } else {
        echo "No se encontraron usuarios.";
    }
} catch (Exception $e) {
    echo "Error al conectarse a la base de datos: " . $e->getMessage();
}

$conn->close();
?>