<?php
        session_start();
        if(!isset($_SESSION["usuario"])||($_SESSION['usuario']['ID_Role'] =='2')){
             header("location: http://localhost/php/comun/logout.php");
        }
        include'../../../comun/conexionDB.php';
        //require'../../../comun/conexionDB.php';


        $id= mysqli_escape_string($mysqli,$_POST['idProducto1']);
        $nombreProducto= mysqli_escape_string($mysqli,$_POST['nombreProducto']);
        $precioProducto= mysqli_escape_string($mysqli,$_POST['precioProducto']);

        $productUpdated=$mysqli->query("UPDATE producto SET Nombre = '$nombreProducto' , Precio='$precioProducto' WHERE ID_Producto=$id");    
        echo ($mysqli->error);
        if(!$mysqli->error){
            header("location: ../../../Productos/vista/listaProductos.php");
        }
        $productUpdated->free();
        $mysqli->close();
?>