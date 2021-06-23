<?php
        session_start();
        if(!isset($_SESSION["usuario"])||($_SESSION['usuario']['ID_Role'] =='2')){
             header("location: http://localhost/php/comun/logout.php");
        }
        include'../../../comun/conexionDB.php';

        
        $id=mysqli_real_escape_string($mysqli,$_GET['idProd']);

        

        $userEmail=$_SESSION['usuario'];
        $usuarioUpdated=$mysqli->query("DELETE FROM producto WHERE producto.ID_Producto=$id");    
        echo ($mysqli->error);
        if(!$mysqli->error){
            header("location: ../../../Productos/vista/listaProductos.php");
        }

        //$id->free();
        $mysqli->close();
?>