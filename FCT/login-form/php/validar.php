<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Password</title>
</head>
<body>
   <?php
      require('./config/funciones.php');

      if ($_POST){
         $error_encontrado="";
         if (validar_clave($_POST["clave"], $error_encontrado)){
            echo "PASSWORD VÁLIDO";
         }else{
            echo "PASSWORD NO VÁLIDO: " . $error_encontrado;
         }
      }
   ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    Escribe una clave:
    <input type=password name="clave">
    <input type="submit" value="Enviar">
    </form>
</body>
</html>