<?php
//Funciones
require('./config/funciones.php');
// Conexión con la base de datos
require('./conexion.php');

$db = new Database();
$conexion = $db->conectar();

if(!$conexion){
    echo 'error en la conexion';
    die();
}

// Recepción de datos
$nombre = $_POST["nombre"];
$pass = $_POST["pass"];
$repitepass = $_POST["repite_pass"];


//Compruebo si el nombre existe en la BD
if(!comprobar_existencia('usuarios','user',$nombre,'loginform') ){
//compruebo si el pass y repite pass son iguales
    if(strcmp($pass,$repitepass) ===0){
    echo 'Las pass coinciden'."<br><br>";      
        //compruebo  los patrones para validar la pass
        if ($_POST){
            $error_encontrado="";
            if (validar_clave($_POST["pass"], $error_encontrado)){
                echo "PASSWORD VÁLIDO". "<br>";
                //Hago el insert
                $sql = "INSERT INTO usuarios (user,pass) VALUES ('$nombre','$pass')";
                if (mysqli_query($conexion, $sql)) {
                        echo "Nuevo usuario insertado correctamente"."<br>";
                } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
                }
                mysqli_close($conexion);
            }else{
            echo "PASSWORD NO VÁLIDO: " . $error_encontrado;
            }
        }
    }else{
    echo 'Las pass no coinciden'."<br><br>";
    }
} else {
    echo 'Este usuario ya esta registrado en la bd - Por favor elija otro.';
}      
?>
