<?php
include("con_db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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

    // Remitente y destinatario
    $mail->setFrom("info@eduessence.com", "EDUESSENCE");
    $mail->addAddress("{{email}}");
    $mail->isHTML(true);

    $mail->Subject = "REGISTRO DE USUARIO EN EDUESSENCE";

    $mail->Body =  '<table width="100%" cellspacing="0" cellpadding="0"
        style="max-width: 600px; margin: auto; background-color: #ffffff; border: 1px solid #ddd;">
        <tr>
            <td style="text-align: center; padding: 20px;">
                <img src="https://www.eduessence.com/img/logo.png" alt="Logo de Eduessence" width="300">
            </td>
        </tr>
        <tr>
            <td style="text-align: right; padding-right: 20px; font-size: 12px;">
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; text-align: left;">
                <p style="font-size: 16px; font-weight: bold;">Buen día, Sr(a). {{nombreApellido}}</p>
                <p>Para el comité de Eduessence, es un placer contar con ustedes dentro del grupo de Eduessence
                    Academy en esta gran academia de impacto latinoamericano, desarrollado webinars, charlas,
                    talleres, congresos, simposios, cursos a la medida, entre otros.</p>
                <p>Nos complace compartir de manera virtual y/o presencial con todos en nuestros eventos.</p>
                <table width="100%" cellspacing="0" cellpadding="0"
                    style="background-color: #eef; padding: 20px; border-left: 5px solid #007bff;">
                    <tr>
                        <td>
                            <p style="font-size: 16px; font-weight: bold; margin: 0;">DATOS DE INGRESO</p>
                            <p>Usuario: {{Usuario}}</p>
                            <a href="https://eduessence.com/php/login.php"style="font-size: 16px; font-weight: bold; border: solid 2px #007bff; padding: 5px 10px; border-radius: 10px; margin-button: 10px; 
                            text-decoration: none;">INGRESA AQUI</a>
                        </td>
                    </tr>
                </table>
                <p>Esperamos contar con ustedes en nuestros próximos eventos.</p>
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
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
}
?>