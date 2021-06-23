<?php
        session_start();
        if(!isset($_SESSION["usuario"])||($_SESSION['usuario']['ID_Role'] =='2')){
             header("location: http://localhost/practicas/comun/logout.php");
        }

        if($_SERVER['REQUEST_METHOD']=='POST'){
            require'../../../comun/conexionDB.php';
        $nombreProducto= mysqli_escape_string($mysqli,$_POST['nombreProducto']);
        $precioProducto= mysqli_escape_string($mysqli,$_POST['precioProducto']);
        $imagen= mysqli_escape_string($mysqli,$_POST['imagen']);
        $categoriaProducto = mysqli_escape_string($mysqli,$_POST['IDcategoria']);
        
        

        $sql = "INSERT INTO producto (Nombre, Precio, img, ID_Categoria) VALUES ('$nombreProducto',$precioProducto,'$imagen',$categoriaProducto)";
        $result=$mysqli->query($sql);  
        echo ($mysqli->error);       
        if(!$mysqli->error){
            header("location: ../../../Productos/vista/listaProductos.php"); 
            $mysqli->close();    

        }
    }
?>