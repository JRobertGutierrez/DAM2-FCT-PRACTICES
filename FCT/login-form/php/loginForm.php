<?php

// Conexión con la base de datos
require('./conexion.php');

$db = new Database();
$conexion = $db->conectar();

if(!$conexion){
    echo 'error en la conexion';
    die();
}
    if(!empty($_POST)){
        // echo "Has pulsado enviar";
        //Compruebo que los campos no esten vacios
        if(empty($_POST['nombre']) || empty($_POST['pass'])){
            echo "<br>" .'Alguno de los campos esta vacío'; 
        }else{

        // Recepción de datos
        $nombre = $_POST["nombre"];
        $pass = $_POST["pass"];
        // echo "<br>" . "El nombre es: " .$nombre . " y la clave es: " .$pass;

        
            // Consulto si los datos recibidos coinciden con los de la base de datos
                $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE user = '$nombre' AND pass='$pass'");

                $result = mysqli_num_rows($query);
            
            // Respuesta
            if($result > 0){
                $_SESSION['user'] = $data['nombre'];
                $_SESSION['pass'] = $data['pass'];

                // header('location: sistema/');
                header('Location: ../sistema/start-page.html');
        
            }else{
                // echo "<br>" .'El usuario o la clave son incorrectos';
                header('Location: ../errors/error-login.html');
            }
    }
}
?>
