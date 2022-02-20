<?php

require('./config/funciones.php');
require('./conexion.php');

$db = new Database();
$conexion = $db->conectar();

if (!$conexion) {
    echo 'error en la conexion';
    die();
}

// Recepción de datos
$nombre = $_POST["nombre"];
$pass_actual = $_POST["pass_actual"];
$pass_nueva = $_POST["pass_nueva"];

//Compruebo si el nombre existe en la BD
if (comprobar_existencia('usuarios', 'user', $nombre, 'loginform')) {
    //compruebo  los patrones para validar la pass
    if ($_POST) {
        $error_encontrado = "";
        if (validar_clave($_POST["pass_actual"], $error_encontrado)) {
            echo "PASSWORD VÁLIDO" . "<br>";
            //Hago el update
            $sql = "UPDATE usuarios set pass = '$pass_nueva' WHERE user = '$nombre'";
            if (mysqli_query($conexion, $sql)) {
                echo "Usuario modificado correctamente" . "<br>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
            }
            mysqli_close($conexion);
        } else {
            echo "PASSWORD NO VÁLIDO: " . $error_encontrado;
        }
    } else {
        echo 'Las pass no coinciden' . "<br><br>";
    }
} else {
    echo 'Este usuario no está registrado en la bd';
}
