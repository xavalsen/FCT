<?php
require '../comun/conexionDB.php';


//$email = $_POST['email'];
$password = mysqli_real_escape_string($mysqli,$_POST['password']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
// $passwordS = mysqli_real_escape_string($mysqli, $_POST['password']);

//$passwordS = htmlspecialchars($password, $flags = ENT_COMPAT | ENT_HTML401, $encoding = ini_get("default_charset"), $double_encode = true);


$comprobacion = $mysqli->query("SELECT * from usuario WHERE usuario.Email='$email'");
echo ($mysqli->error);


if (mysqli_num_rows($comprobacion) <= 0) {
    /*echo ('<div class="fondo">
    <div class="error">
    <h2>¡UPS..!</h2>
    <h1>Usuario no registrado</h1>
    <p>Vuelve a la pagina de inicio y registrate</p>
    <a href="index.html">Go back home</a>
    </div>
    </div>');*/
    header('location: ../mensajes/noReg.html');
} else {
    $row = $comprobacion->fetch_object();

    if (password_verify($password, $row->Password)) {
        echo ("Usuario: " . $row->Nombre . " conectado");
        $RoleUsuActive = $row->ID_Role;
        session_start();
        $_SESSION['usuario'] = array();
        $_SESSION['usuario']['email'] = $email;
        $_SESSION['usuario']['ID_Role'] = $RoleUsuActive;
        $mysqli->query("UPDATE usuario SET Validado=1 WHERE usuario.Email ='$email'");
        echo ($mysqli->error);
        header("location:../paginaHome.php");
    } else {
       // echo ("contraseña incorrecta"/* . $email ." ". $password ." hh " . $password . " fdfd " . $row->Password*/);
        header("location: ../mensajes/noPass.html");
    }
}
$mysqli->close();
?>