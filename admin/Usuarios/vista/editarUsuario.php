<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/allPages.css">
    <link rel="icon" type="image/png" href="../../../uploads/logo-page.png">
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
    <link href="../../../downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <title>Pizzería Girona</title>
    <style>
        table {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <!--Container Header and nav-->
    <div class="container ">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark mb-sl-3">
            <a href="../../../paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img src="../../../uploads/logo-page.png" alt="" class="icoLogo">
                <h1>Pizzería Girona</h1>
            </a>

            <ul class="nav nav-pills">
                <!--Username-->
                <li class="nav-item "><a href="../../../user/configuracionCuenta/vista/editarPerfil.php" class="nav-link text-reset">
                        <?php
                        session_start();
                        echo ($_SESSION["usuario"]["email"]);
                        ?>
                    </a></li>
                <!--Redirect to pages-->
                <!--<li class="nav-item"><a href="../../../Ofertas/vista/listaOfertas.php" class="nav-link ">Ofertas</a></li>-->
                <!--<li class="nav-item"><a href="menus.html" class="nav-link">Menus</a></li>-->
                <!--<li class="nav-item"><a href="reservar.html" class="nav-link active">Reservar</a></li>-->
                <li class="nav-item"><a href="../../../Productos/vista/listaProductos.php" class="nav-link">Productos</a></li>
                <?php
                if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
                } else {
                    echo ('<li class="nav-item"><a href="../../../user/pedirAdomicilio/direccion.php" class="nav-link ">Pedir a domicilio</a></li>');
                }
                ?>
                <!--<li class="nav-item"><a href="../../../about-us.php" class="nav-link">Quienes somos</a></li>-->
                <?php
                if ($_SESSION['usuario']['ID_Role'] == 2) {
                    echo ('<li class="nav-item"><a href="carrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a></li>');
                }
                ?>
                <?php
                if ($_SESSION['usuario']['ID_Role'] == 1) {
                    echo ('<li class="nav-item"><a href="../../../admin/pedido/vista/pedidos.php" class="nav-link">Pedidos</a></li>');
                    echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link active">Lista de usuarios</a></li>');
                } elseif ($_SESSION['usuario']['ID_Role'] == 3) {
                    echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link active">Lista de usuarios</a></li>');
                }
                ?>
                <li class="nav-item"><a id="cerrar" class="nav-link">Cerrar sesión</a></li>
            </ul>
        </header>
    </div>

    <!--Contenido pagina-->
    <div class="container border border-dark p-2">
        <div class=" border border-dark my-1 text-center">
            <h1 class="h2 mt-2">Editar usuario</h1>
        </div>
        <div class="container p-3">
            <form action="../modelo/editarUsuario.php" method="POST">
                <input type="number" style="display: none;" id="idUsuario" name="idUsuario">
                <div class="container border text-center p-4">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required></input>
                </div>
                <div class="container border text-center p-3 my-2">
                    <label for="email">Email:</label>
                    <input type="text" disabled id="email"></input>
                </div>
                <div class="container border text-center p-3 my-2">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" required placeholder="xxx-xxx-xxx" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}"></input>
                </div>
                <div class="container border text-center p-3 my-2">
                    <label for="role">Role:</label>
                    <select id="selectorRole">
                    </select>
                </div>
                <input type="text" style="display: none;" name="idRole" id="IDRole">
                <div class="container border text-center p-3 my-2">
                    <a class=" btn btn-primary" href="listaUsuarios.php">Volver</a>
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button id="eliminar" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>



    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script> -->
    <script src="../../../downloads/bootstrap-5.0.1-dist/js/bootstrap.min.js">
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script> -->
    <script src="../../../downloads/bootstrap-5.0.1-dist/js/bootstrap.bundle.min.js">
    </script>

    <!--SweetAlert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="../controlador/editarUsuario.js"></script>
    <script type="text/javascript">
        window.addEventListener("load", loadEvents);
    </script>
</body>

</html>