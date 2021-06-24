<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="registro.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
   
    <title>Registro</title>
    <style>
        input:invalid+span:after {
            position: absolute;
            content: '✖';
            padding-left: 5px;
            color: #8b0000;
        }

        input:valid+span:after {
            position: absolute;
            content: '✓';
            padding-left: 5px;
            color: #009000;
        }

        #erroresForm {
            color: #8b0000;
        }
    </style>

</head>

<body>
    <section class="contact-box">
    <div class="row no-gutters bg-dark">
           <div class="col-xl-7 col-lg-12 d-flex">
                <div class="container align-self-center p-6">
                    <h1 class="font-weight-bold mb-3 text-light">Crea tu cuenta gratis</h1>
                    <div class="form-group">
                        <button class="btn btn-outline-dark d-inline-block text-light mr-2 mb-3 width-100"><i class="icon ion-logo-google lead align-middle mr-2"></i> Google </button>
                        <button class="btn btn-outline-dark d-inline-block text-light mb-3 width-100"><i class="icon ion-logo-facebook lead align-middle mr-2"></i> Facebook</button>
                    </div>
                    <p class="text-muted mb-5" >Ingresa la siguiente información para registrarte.</p>

    
        
        
        <?php
        if (isset($_POST["enviar"])) {
            include 'comun/conexionDB.php';
                        
            $Email = mysqli_real_escape_string($mysqli,$_POST['Email']);
            $Nombre = mysqli_real_escape_string($mysqli,$_POST["Nombre"]);
            $Telefono = mysqli_real_escape_string($mysqli,$_POST["Telefono"]);
            $Password = mysqli_real_escape_string($mysqli,$_POST["Password"]);

            $comprobacion = $mysqli->query("SELECT * from usuario WHERE usuario.Email='$Email'");
            if (mysqli_num_rows($comprobacion) <= 0) {
                if ($_POST['Password'] == $_POST['ConfirmarPassword']) {
                    require 'comun/encryptcontra.php';
                    $result = $mysqli->query("INSERT INTO usuario (Nombre,Telefono,Password,Email) VALUES ('$Nombre','$Telefono','$PasswordCrypt','$Email')");
                    echo ($mysqli->error);
                    session_start();
                    $_SESSION['usuario'] = array();
                    $_SESSION['usuario']['email'] = $Email;
                    $_SESSION['usuario']['ID_Role'] = '2';
                    $mysqli->query("UPDATE usuario SET validado=1 WHERE usuario.Email ='$Email'");
                    echo ($mysqli->error);
                    echo ("<script>  error = 0; </script>");
                    header("location: auth/login.html");
                } else {
                    echo ("<script>  error = 1; </script>");
                }
            } else {
                echo ("<script>  error = 2; </script>");
            }

            echo ($mysqli->error);
            $mysqli->close();
        }
        ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="formularioSignUp" method="POST">
                <div class="form-row mb-2">
                    <div class="form-group col-md-5">    
                        <label class="font-weight-bold text-light" for="" id="labels">Nombre<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="Nombre" id="formBorders" required>
                </div>
                </div>
                <div class="form-row mb-2">
                <div class="form-group col-md-6">
                        <label class="font-weight-bold text-light" for="" id="labels">Email<span class="text-danger">*</span></label>
                        <input class="form-control" type="email" name="Email" required>
                </div>
                </div>
                <div class="form-row mb-2">
                <div class="form-group col-md-6">
                        <label class="font-weight-bold text-light" for="" id="labels">Contraseña<span class="text-danger">*</span></label>
                        <input class="form-control" type="password" id="Password" name="Password" required>
                </div>
                </div>
                <div class="form-row mb-2">
                <div class="form-group col-md-6">
                        <label class="font-weight-bold text-light" for="" id="labels">Confirma tu Contraseña<span class="text-danger">*</span></label>
                        <input class="form-control" type="password" id="ConfirmarPassword" name="ConfirmarPassword" required>
                </div>
                </div>
                <div class="form-row mb-2">
                <div class="form-group col-md-6">
                        <label class="font-weight-bold text-light" for="" id="labels">Teléfono<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="Telefono" required placeholder="xxx-xxx-xxx" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}"></input>
                <span class="validity"></span>
                <span class="validity"></span>
                </div>
                </div>
                <div class="form-group mb-5">
                                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="politicas" name="politicas" required></input> 
                <label class="form-check-label text-muted">He leído y
                acepto las <a href="../politicasdeprivacidad.html">Políticas de Privacidad</a></label>
                <br />
                <span id="erroresForm" style="color: red;"></span>
                <br />
                <button class="btn btn-primary width-100" type="submit" name="enviar">Regístrate</button>
            </form>
            <small class="d-inline-block text-muted mt-5">Todos los derechos reservados | © 2021 Templune</small>
        </div>
    </div>
    </div>
    </section>

    <!--SweetAlert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        var error;
        try {
            switch (error) {
                case 1:
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en las contraseñas',
                        text: '¡¡ Las Contraseñas deben ser iguales !!',
                    })

                    error = null;
                    break;
                case 2:
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en el correo',
                        text: '¡¡ Este email ya esta registrado !!',
                    })
                    error = null;
                    break;

                case 0:
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario registrado correctamente',
                        text: '¡¡ Te registraste correctamente !!',
                        timer: 2000
                    })
                    error = null;
                    break;
                default:
                    break;
            }
        } catch (error) {
            console.log("LA variable error no se define hasta que se haga el intento");
        }

    </script>
 

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>