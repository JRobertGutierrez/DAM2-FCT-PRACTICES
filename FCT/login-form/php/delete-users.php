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

//Compruebo si el nombre existe en la BD
if (comprobar_existencia('usuarios', 'user', $nombre, 'loginform')) {
    //compruebo  los patrones para validar la pass
    //Hago el update
    $sql = "DELETE FROM usuarios WHERE user = '$nombre'";
    if (mysqli_query($conexion, $sql)) {
        echo "Usuario eliminado correctamente" . "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
    mysqli_close($conexion);
} else {
    echo 'Este usuario no está registrado en la bd';
}
