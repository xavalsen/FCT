<?php
session_start();
if (!isset($_SESSION["usuario"]) || ($_SESSION['usuario']['ID_Role'] != '3')) {
    header("location: http://localhost/php/comun/logout.php");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../../../comun/conexionBD.php");

    $nombre = mysqli_escape_string($mysqli,$_POST['nombre']);
    $email = mysqli_escape_string($mysqli,$_POST['email']);
    $telefono = mysqli_escape_string($mysqli,$_POST['telefono']);
    $password = mysqli_escape_string($mysqli,$_POST['contrasena']);
    $idRole = mysqli_escape_string($mysqli,$_POST['idRole']);
    
    $comprobacion = $mysqli->query("SELECT * from usuario WHERE usuario.Email='$email'");
    echo ($mysqli->error);
    if(!empty($comprobacion) && mysqli_num_rows($comprobacion)>0) {
        //echo("Este usuario ya existe");
        header("location: ../vista/crearUsuario.php?error=Este usuario ya existe, Cambie el correo");
    }else{
        require("../../../comun/encryptcontra.php");
        $sql ="INSERT INTO usuario (Nombre, Telefono, Password, Email, ID_Role) VALUES ('$nombre','$telefono','$passwordCrypt','$email',$idRole)";
        $result = $mysqli->query($sql);
        echo ($mysqli->error);
        if (!$mysqli->error) {
            header("location: ../vista/listaUsuarios.php");   
        }
    $result->free();  
    $mysqli->close();
    }
}
?>
