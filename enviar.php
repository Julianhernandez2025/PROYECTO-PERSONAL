<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$nombre     = $_POST['nombre'] ?? '';
$correo     = $_POST['correo'] ?? '';
$telefono   = $_POST['telefono'] ?? '';
$tipo_sitio = $_POST['tipo-sitio'] ?? '';
$mensaje    = $_POST['mensaje'] ?? '';

if (!$nombre || !$correo || !$tipo_sitio) {
    echo "Por favor completa todos los campos obligatorios.";
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tu-correo@gmail.com';         
    $mail->Password   = 'tu-contraseña-de-aplicacion'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom($correo, $nombre);
    $mail->addAddress('tu-correo@gmail.com'); 

    $mail->isHTML(true);
    $mail->Subject = 'Nueva solicitud de proyecto web';
    $mail->Body    = "
        <h2>Nueva solicitud desde el sitio web</h2>
        <p><strong>Nombre:</strong> $nombre</p>
        <p><strong>Correo:</strong> $correo</p>
        <p><strong>Teléfono:</strong> $telefono</p>
        <p><strong>Tipo de sitio:</strong> $tipo_sitio</p>
        <p><strong>Mensaje:</strong><br>$mensaje</p>
    ";

    $mail->send();
    echo "✅ Tu solicitud ha sido enviada con éxito. ¡Gracias por contactarnos!";
} catch (Exception $e) {
    echo "❌ Error al enviar el mensaje: {$mail->ErrorInfo}";
}
?>
