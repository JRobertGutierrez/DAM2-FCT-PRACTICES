<?php

require('./config/funciones.php');
require('./conexion.php');

$db = new Database();
$conexion = $db->conectar();

if(!$conexion){
    echo 'error en la conexion';
    die();
}

$query = mysqli_query($conexion, "SELECT * FROM usuarios;");

$result= mysqli_num_rows($query);

if($result >0){//Utilizo NON BREAKING SPACE nbsp para dar un espacio
    echo "<h2 style='color:#3456db;'>LISTADO DE USUARIOS DE LA BD</h2>";
    while($fila = mysqli_fetch_array($query)){
        echo "<b>".'ID: '."</b>" . $fila['idusuario'].'&nbsp;&nbsp;&nbsp;&nbsp;';
        echo 'USER: ' . $fila['user'].'&nbsp;&nbsp;&nbsp;&nbsp;';
        echo 'PASS: ' . $fila['pass'];
        echo '<br>';
    } 
}
