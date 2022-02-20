<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/* require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php'; */

// Load Composer's autoloader
require '../vendor/autoload.php';

require('vars.php');
//Conexión a la BD
require('./conexion.php');

$db = new Database();
$conexion = $db->conectar();

if (!$conexion) {
    echo 'error en la conexion';
    die();
}

// Recepción de datos
$usuario = $_POST['nombre'];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$comentario = $_POST["comentario"];

//Sentencia
$sql = mysqli_query($conexion, "SELECT * FROM usuarios WHERE user = '$usuario' LIMIT 1");

$result = $sql;
//Compruebo si el nombre existe en la BD
if ($sql->num_rows === 1) {
    $row = $sql->fetch_assoc();
    $_SESSION['user'] = $row['user'];
    echo 'El usuario ' . $usuario . ' es correcto.';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0; // Enable verbose debug output -> (0 Apagado) - (1 mensajes del cliente) - (2 mensajes del cliente y servidor)
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through - smtp.mail.yahoo.com
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $useremail;                     // SMTP username
        $mail->Password   = $passemail;                               // SMTP password
        $mail->SMTPSecure = 'TLS';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged - probado SSL para yahoo y port 465
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->CharSet = "UTF-8"; // Para que aguante tildes, eñes, etc.

        //Recipients
        $mail->setFrom($useremail, 'Administrador');
        //$mail->addAddress('correo@gmail.com', 'Destino');     // Add a recipient
        $mail->addAddress($email, $usuario);               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments - Esto es para el envío de ficheros
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Pruebas de recuperación de contraseña olvidada';
        $mail->Body .= "<h1 style='color:#3498db;'>Hola $usuario</h1>";
        $mail->Body .= "Tu password actualizada es: " . "<b>" . $row['pass'] . "</b>";
        $mail->Body .= "<p>El teléfono que nos has facilitado es el " . $telefono . "</p>";
        $mail->Body .= "<h3 style='color:#3456db;'>Tu comentario es el siguiente:</h3>";
        $mail->Body .= "<p>$comentario</p>";
        //$mail->Body .= "<p>Fecha y Hora: " . date("d-m-Y h:i:s") . "</p>"; Otro formato de date
        $mail->Body .= "<p>Fecha y Hora: " . date('l jS \of F Y h:i:s A') . "</p>";
        //$mail->AltBody = "Este es el cuerpo en texto plano para clientes de correo electrónico no HTML";

        $mail->send();
        echo '<br>';
        echo 'El mensaje se envió correctamente';
    } catch (Exception $e) {
        echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
    }
} else { //0 registros.
    echo '<br>';
    echo 'Este usuario no está registrado en la bd';
}
