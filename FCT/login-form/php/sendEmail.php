<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, X-Auth-Token');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Content-Type: application/json');

include('models/resultModel.php');

    // GUARDO EN VARIABLES LOS DATOS RECIBIDOS DE ANGULAR
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $comentario = $_POST['comentario'];

    $subject = 'Mensaje de ' . $nombre. ' desde formulario web.';

    $headers = "From:".$nombre." <".$email."> \r\n";
    $headers .= "Reply-To: ".$email." \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    //$headers .= "Cc: ".$marketing_contact."\r\n";	// Comentar si no hay copia	

    $body = "
        <h3>$nombre envió el siguiente mensaje a través de la web:</h3>
        <p>$comentario</p>
    ";

    $result = new ResultModel();

    if(!empty($telefono)) {
        $body .= "<p>Puedes contactar con $nombre en el teléfono: $telefono</p>";
    }

    if(mail("gutisoft13@gmail.com", "=?UTF-8?B?".base64_encode($subject)."=?=", $body, $headers)) {
        http_response_code(200);
        $result->setResultado(200);
        $result->setMensaje('¡ Formulario enviado !');
    } else {
        http_response_code(500);
        $result->setResultado(500);
        $result->setMensaje('¡ No enviado !');
    };

    echo json_encode($result);

?>