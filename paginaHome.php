<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/allPages.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/estiloUsuario.css">
    <link rel="icon" type="image/png" href="uploads/logo-page.png">
    <script src="js/slideShow.js"></script>
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
    <link href="downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <title>Pizzería Girona</title>

</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("location: http://localhost/practicas/auth/login.html");
    }
    ?>
    <!--Container Header and nav-->
    <div class="container ">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark mb-sl-3">
            <a href="paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img src="img/logo.png" width="150" height="50" alt="" >
                <!--<h1>Pizzería Girona</h1>-->
            </a>

            <ul class="nav nav-pills">
                <!--Username-->
                <li class="nav-item "><a href="user/configuracionCuenta/vista/editarPerfil.php" class="nav-link text-reset">
                        <?php
                        if (!isset($_SESSION["usuario"])) {
                        } else {
                            echo ($_SESSION["usuario"]["email"]);
                        }
                        ?>
                    </a></li>
                <!--Redirect to pages-->
                <!--<li class="nav-item"><a href="Ofertas/vista/listaOfertas.php" class="nav-link ">Ofertas</a></li>-->
                <!--<li class="nav-item"><a href="menus.html" class="nav-link">Menus</a></li>-->
                <!--<li class="nav-item"><a href="reservar.html" class="nav-link active">Reservar</a></li>-->
                <li class="nav-item"><a href="Productos/vista/listaProductos.php" class="nav-link">Productos</a></li>
                <li class="nav-item"><a href="user/pedirAdomicilio/direccion.php" class="nav-link ">Pedir a domicilio</a></li>
                <li class="nav-item"><a href="about-us.php" class="nav-link">Quienes somos</a></li>
                <?php
                if (!isset($_SESSION["usuario"])) {
                    //echo ('<li class="nav-item"><a href="carrito/carrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
                } else {
                    if ($_SESSION['usuario']['ID_Role'] == 2) {
                        echo ('<li class="nav-item"><a href="carrito/vista/mostrarCarrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
                    }
                }
                ?>
                <?php
                if ($_SESSION['usuario']['ID_Role'] == 1) {
                    echo ('<li class="nav-item"><a href="../../../admin/pedido/vista/pedidos.php" class="nav-link">Pedidos</a></li>');
                    echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link">Lista de usuarios</a></li>');
                } else if ($_SESSION['usuario']['ID_Role'] == 3) {
                    echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link">Lista de usuarios</a></li>');
                }
                ?>
                <?php
                if (!isset($_SESSION["usuario"])) {
                } else {
                    echo ('<li class="nav-item"><a id="cerrar" href="auth/logout.php" class="nav-link">Cerrar sesión</a></li>');
                }
                ?>
            </ul>
        </header>
    </div>

    <?php
    if ($_SESSION['usuario']['ID_Role'] == 2) {
        echo ('
        <!--Content page-->
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
        ');
    } elseif ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
        header("location: http://localhost/practicas/Productos/vista/listaProductos.php");
    }
    ?>
    <!--SweetAlert-->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script> -->
    <script src="downloads/bootstrap-5.0.1-dist/js/bootstrap.min.js">
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script> -->
    <script src="downloads/bootstrap-5.0.1-dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/about-us.js"></script>
    <script type="text/javascript">
        window.addEventListener("load", loadEvents);
    </script>

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
    </footer>
</body>

</html>