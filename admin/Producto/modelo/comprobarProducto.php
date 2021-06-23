<?php

session_start();
if (!isset($_SESSION["usuario"]) || ($_SESSION['usuario']['ID_Role'] == '2')) {
   header("location: http://localhost/php/comun/logout.php");
}

include("../../../comun/conexionBD.php");
if (isset($_POST['nombreProducto']) || isset($_POST['precioProducto'])) {

   $nombre = mysqli_escape_string($mysqli ,$_POST['nombreProducto']);
   $precio = mysqli_escape_string($mysqli ,$_POST['precioProducto']);
   $categoria = mysqli_escape_string($mysqli ,$_POST['categoriaProducto']);
}



$result = $mysqli->query("SELECT * from producto WHERE Nombre='$nombre'");
echo ($mysqli->error);

if (mysqli_num_rows($result) != 0 ) {
   echo ('Ya existe un Producto con este Nombre/1');
} else {
   if ($nombre == "" || $precio == "") {
      echo "Faltan campos por rellenar/2";
   } else {
      echo "Producto válido/0";
   }
}
$result->free();
$mysqli->close();
