<?php
include("con_db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Consulta a la base de datos
$query = "SELECT IDUSUARIO, PERSONA_NOMBRES, PERSONA_APELLIDOS, PERSONA_CORREO, USUARIO_USER FROM TR_PERSONA INNER JOIN TR_USUARIOS ON PERSONA_CORREO = USUARIO_NOMBRE WHERE IDPERSONA IN (2155)";
$result = $conn->query($query);



if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nombreApellido = $row['PERSONA_NOMBRES'] . ' ' . $row['PERSONA_APELLIDOS'];
        $email = $row['PERSONA_CORREO'];
        $usuario = $row['USUARIO_USER'];
        $idusuarios = $row['IDUSUARIO'];
        $nuevaClave = '$2y$10$wX/j8s7EpDRe8pRFnEMXoeZSmB.6RODpH5NI/pqE.vQ70lU4zEi2y';

        // Escapar valores para evitar inyección SQL
        $idusuarios = $conn->real_escape_string($idusuarios);
        $update = "UPDATE TR_USUARIOS SET USUARIO_CLAVE='$nuevaClave' WHERE IDUSUARIO='$idusuarios'";

        if ($conn->query($update) === TRUE) {
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

                $mail->Subject = "RESTABLECER CONTRASEÑA EDUESSENCE";
                $mail->Body = '<table width="100%" cellspacing="0" cellpadding="0"
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
                                        <p style="font-size: 16px; font-weight: bold;">Buen día, Sr(a). ' . htmlspecialchars($nombreApellido, ENT_QUOTES, 'UTF-8') . '</p>
                                        <p>Para el comité de Eduessence, es un placer contar con ustedes dentro del grupo de Eduessence
                                            Academy en esta gran academia de impacto latinoamericano, desarrollado webinars, charlas,
                                            talleres, congresos, simposios, cursos a la medida, entre otros.</p>
                                        <p>Nos complace compartir de manera virtual y/o presencial con todos en nuestros eventos.</p>
                                        <table width="100%" cellspacing="0" cellpadding="0"
                                            style="background-color: #eef; padding: 20px; border-left: 5px solid #007bff;">
                                            <tr>
                                                <td>
                                                    <p style="font-size: 16px; font-weight: bold; margin: 0;">DATOS DE INGRESO</p>
                                                    <p>Usuario: ' . htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8') . ' </p>
                                                    <p>Contraseña: Eduessence2023*</p>
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
                echo "Correo enviado a: $email";
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error al actualizar la base de datos: " . $conn->error;
        }
    }
} else {
    echo "No se encontraron registros.";
}

$conn->close();