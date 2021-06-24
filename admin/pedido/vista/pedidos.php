<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10">
    <link rel="stylesheet" href="../../../css/allPages.css">
    <link rel="stylesheet" href="../../../css/crear-producto.css">
    <link rel="icon" type="image/png" href="../../../uploads/logo-page.png">
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
    <link href="../../../downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">    
    <!-- CSS Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <title>Pizzería Girona</title>
</head>

<body style="background-color:#272727">
    <!--Container Header and nav-->
    <div class="container ">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-white mb-sl-3">
            <a href="../../../paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <img src="../../../img/logo-white.png" width="150" height="50" alt="" >
            </a>

            <ul class="nav nav-pills">
                <!--Username-->
                <li class="nav-item "><a href="../../../user/configuracionCuenta/vista/editarPerfil.php" class="nav-link text-white">
                        <?php
                        session_start();
                        echo ($_SESSION["usuario"]["email"]);
                        ?>
                    </a></li>
                <!--Redirect to pages-->
                <!--<li class="nav-item"><a href="../../../Ofertas/vista/listaOfertas.php" class="nav-link ">Ofertas</a></li>-->
                <!--<li class="nav-item"><a href="menus.html" class="nav-link">Menus</a></li>-->
                <!--<li class="nav-item"><a href="reservar.html" class="nav-link active">Reservar</a></li>-->
                <li class="nav-item"><a href="../../../Productos/vista/listaProductos.php" class="nav-link text-white">Productos</a></li>
                <?php
                if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
                } else {
                    echo ('<li class="nav-item"><a href="../../../user/pedirAdomicilio/direccion.php" class="nav-link text-white">Pedir a domicilio</a></li>');
                }
                ?>
                <?php
                if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
                    echo ('<li class="nav-item"><a href="pedidos.php" class="nav-link active">Pedidos</a></li>');
                    echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link text-white">Lista de usuarios</a></li>');
                }
                ?>
                <!--<li class="nav-item"><a href="../../../about-us.php" class="nav-link">Quienes somos</a></li>-->
                <li class="nav-item"><a id="cerrar" class="nav-link text-white">Cerrar sesión</a></li>
            </ul>
        </header>
    </div>
    <!--Content page-->
    <!--Container content-->
    <div class="container text-white">
        <h1 class="text-white">Pedidos</h1>
        <hr>
        <!--Container items-->
        <div class="container border border-dark mt-2 w-100 p-1 overflow-auto ">
            <!--Se mostraran todas las reservas-->

            <!--Container-->
            <div class="container border w-100 h-75">
                <!--Contenido res-->
                <table class="container w-100 h-75 my-2">
                    <!--Titulo-->
                    <thead class="border border-white">
                        <!--<th class="text-center">Id pedido</th>-->
                        <th class="text-center ">Cod pedido</th>
                        <th class="text-center">Nombre cliente</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Dirección</th>
                        <th class="text-center">Comentario</th>
                        <th class="text-center">Precio total</th>
                        <th class="text-center">Hora</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                        <!--<th class="text-center">Botones</th>-->
                    </thead>
                    <!--Contenido estructurado-->
                    <tbody id="tbody">
                    </tbody>
                    <!-- Hay que añadir manualmente los tr y td con sus id correspondiendo dependiendo del numero de registros que queramos mostrar por pantalla -->

                </table>
                <div class="container border border-dark" style="display: none;" id="divCambioEstado">
                    <select id="selectEstados" class="text-center">
                    </select>
                    <button id="btnConfirmarCambios" class="btn btn-success">Confirmar</button>
                </div>

            </div>
            <!--Controles botones-->
            <div class="container p-2 mb-3 text-center" id="paginacion">
                <button class="btn btn-primary" id="primera">Primera</button>
                <button class="btn btn-primary" id="anterior">Anterior</button>
                <!--Total de paginas-->
                <button class="btn btn-primary disabled" id="contadorActual"></button>
                <button class="btn btn-primary disabled" id="contador"></button>
                <!---->
                <button class="btn btn-primary" id="siguiente">Siguiente</button>
                <button class="btn btn-primary" id="ultima">Última</button>
            </div>
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
    <script type="text/javascript" src="../controlador/javascriptPedidos.js"></script>
    <script type="text/javascript">
        window.addEventListener("load", loadEvents);
    </script>
</body>

</html>