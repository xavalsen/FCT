<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/oie_eW6kViafvWWW.png" type="image/x-icon">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/error-mensaje.css">
    <title>Formulario Login</title>
</head>

<body>
    
    <?php

    $Email = $_GET['Email'];
    $Password = $_GET['Password'];
    //$admin = $_GET['admin'];
   

    $mysqli = new mysqli("localhost", "root", "", "practiques");

    if ($mysqli->connect_errno) {
        echo ("Connect failed: " . $mysqli->connect_error);
        exit();
    }
    $comprobacion = $mysqli->query("SELECT * from usuario WHERE Email='$Email'");
    if (mysqli_num_rows($comprobacion) <= 0) {
        //echo("Login no existe");

        echo('<div class="fondo">
        <div class="error">
        <h2>¡UPS..!</h2>
        <h1>Usuario no registrado</h1>
        <p>Vuelve a la pagina de inicio y registrate</p>
        <a href="index.html">Go back home</a>
        </div>
        </div>');
    }else{

        $row = $comprobacion->fetch_object();
        
        
        $comprobacionPasw = $mysqli->query("SELECT * from usuario WHERE  Email='$Email' AND Password='$Password'");
        if (mysqli_num_rows($comprobacionPasw) <= 0) {
            echo('<div class="fondo">
            <div class="error">
            <h2>¡UPS..!</h2>
            <h1>Contraseña erronea</h1>
            <p>Vuelve a la pagina de inicio y repite la contraseña</p>
            <a href="index.html">Go back home</a>
            </div>
            </div>');
        } else{
             $row = $comprobacionPasw->fetch_object(); 
           // echo("Bienvenido ".$row->Nombre. "<br />"."<br />");
            if (($row->ID_Role == 1)) {
               // echo("Eres Aadministrador");
                echo(' <header>
                <nav>
                    <a href="datosusuario.php">Inicio</a>
                    <a href="#">Acerca de</a>
                    <a href="#">Portfolio</a>
                    <a href="#">Servicios</a>
                    <a href="#">Contacto</a>
        
                </nav>
                <section class="textos-header">
                    <h1>Bienvenido</h1>
                    <h2>Administrador</h2>
                </section>
                <div class="wave" style="height: 150px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none"
                        style="height: 100%; width: 100%;">
                        <path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
                            style="stroke: none; fill: rgb(255, 255, 255);"></path>
                    </svg></div>
            </header>
            </div>
                <section class="portafolio">
                    <div class="contenedor">
                        <h2 class="titulo">Productos</h2>
                        <div class="galeria-port">
        
                            <div class="imagen-port">
        
                                <img src="img/img1.jpg" alt="">
                                <a href="Cocina/menuCocina.html">
                                    <div class="hover-galeria">
                                        <!--<img src="img/logo.png" alt="">-->
                                        <p>
                                            <FONT SIZE=5>COCINAS</FONT>
                                        </p>
                                    </div>
                                </a>
                            </div>
        
                            <div class="imagen-port">
                                <img src="img/img2.jpg" alt="">
                                <a href="Ceramica/menuCeramica.html">
                                    <div class="hover-galeria">
                                        <p>
                                            <FONT SIZE=5>BAÑOS</FONT>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="imagen-port">
                                <img src="img/ceramicas.jpg" alt="">
                                <a href="Ceramica/menuCeramica.html">
                                    <div class="hover-galeria">
                                        <p>
                                            <FONT SIZE=5>CERAMICA</FONT>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="imagen-port">
                                <img src="img/baño.jpg" alt="">
                                <a href="decoracion.html">
                                    <div class="hover-galeria">
                                        <p>
                                            <FONT SIZE=5>DECORACION</FONT>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="imagen-port">
                                <img src="img/img5.jpg" alt="">
                                <a href="mcf.html">
                                    <div class="hover-galeria">
                                        <p align="center">
                                            <FONT SIZE=5>MATERIALES DE CONTRUCCIÓN Y FERRETERIA</FONT>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            <footer>
                <div class="contenedor-footer">
                    <div class="content-foo">
                        <h4>Phone</h4>
                        <p>00000000</p>
                    </div>
                    <div class="content-foo">
                        <h4>Email</h4>
                        <p>0000@000.com</p>
                    </div>
                    <div class="content-foo">
                        <h4>Location</h4>
                        <p>00000000</p>
                    </div>
                </div>
                <h2 class="titulo-final">&copy; Alguien</h2>
            </footer>');
                /*header("Location: indexAdmin.html");
                exit();*/
    
            }elseif ($row->ID_Role == 2) {
                /*echo("No eres Administrador");
                header("Location: indexUsuario.html");*/
                echo(' <header>
                <nav>
                    <a href="index.html">Inicio</a>
                    <a href="#">Acerca de</a>
                    <a href="#">Portfolio</a>
                    <a href="#">Servicios</a>
                    <a href="#">Contacto</a>
        
                </nav>
                <section class="textos-header">
                    <h1>Bienvenido</h1>
                    <h2>Usuario</h2>
                </section>
                <div class="wave" style="height: 150px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none"
                        style="height: 100%; width: 100%;">
                        <path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
                            style="stroke: none; fill: rgb(255, 255, 255);"></path>
                    </svg></div>
            </header>
            </div>
                <section class="portafolio">
                    <div class="contenedor">
                        <h2 class="titulo">Productos</h2>
                        <div class="galeria-port">
        
                            <div class="imagen-port">
        
                                <img src="img/img1.jpg" alt="">
                                <a href="Cocina/menuCocina.html">
                                    <div class="hover-galeria">
                                        <!--<img src="img/logo.png" alt="">-->
                                        <p>
                                            <FONT SIZE=5>COCINAS</FONT>
                                        </p>
                                    </div>
                                </a>
                            </div>
        
                            <div class="imagen-port">
                                <img src="img/img2.jpg" alt="">
                                <a href="Ceramica/menuCeramica.html">
                                    <div class="hover-galeria">
                                        <p>
                                            <FONT SIZE=5>BAÑOS</FONT>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="imagen-port">
                                <img src="img/ceramicas.jpg" alt="">
                                <a href="Ceramica/menuCeramica.html">
                                    <div class="hover-galeria">
                                        <p>
                                            <FONT SIZE=5>CERAMICA</FONT>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="imagen-port">
                                <img src="img/baño.jpg" alt="">
                                <a href="decoracion.html">
                                    <div class="hover-galeria">
                                        <p>
                                            <FONT SIZE=5>DECORACION</FONT>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="imagen-port">
                                <img src="img/img5.jpg" alt="">
                                <a href="mcf.html">
                                    <div class="hover-galeria">
                                        <p align="center">
                                            <FONT SIZE=5>MATERIALES DE CONTRUCCIÓN Y FERRETERIA</FONT>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            <footer>
                <div class="contenedor-footer">
                    <div class="content-foo">
                        <h4>Phone</h4>
                        <p>00000000</p>
                    </div>
                    <div class="content-foo">
                        <h4>Email</h4>
                        <p>0000@000.com</p>
                    </div>
                    <div class="content-foo">
                        <h4>Location</h4>
                        <p>00000000</p>
                    </div>
                </div>
                <h2 class="titulo-final">&copy; Alguien</h2>
            </footer>');
            }
        }
        
        
        
        
    }
    echo ($mysqli->error);
    $mysqli->close();
    ?>
    </br>
    </br>
    <!--<script type="text/javascript">
        document.getElementById("mainPage").addEventListener("click", goBack);
        function goBack() {
            window.location = "./index.html";
        }
    </script>-->
</body>

</html>