<?php
        session_start();
        if(!isset($_SESSION["usuario"])||($_SESSION['usuario']['ID_Role'] !='3')){
             header("location: http://localhost/php/comun/logout.php");
        }
        include("../../../comun/conexionBD.php");

        $id= mysqli_escape_string($mysqli,$_POST['idUsuario']);
        $nombre=mysqli_escape_string($mysqli,$_POST['nombre']);
        $telefono=mysqli_escape_string($mysqli,$_POST['telefono']);
        $idRole=mysqli_escape_string($mysqli,$_POST['idRole']);

        $productUpdated=$mysqli->query("UPDATE usuario SET Nombre = '$nombre' , Telefono='$telefono', ID_Role=$idRole WHERE ID_Usuario=$id");    
        echo ($mysqli->error);
        if(!$mysqli->error){
            header("location: ../vista/listaUsuarios.php");
        }else{
            header("location: ../vista/editarUsuario.php?error=Ocurrió un error al editar");
        }
        
        $mysqli->close();
?>