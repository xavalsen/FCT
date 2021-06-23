<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/allPages.css">
  <link rel="icon" type="image/png" href="../../uploads/logo-page.png">
  <!-- CSS only -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
  <link href="../../downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <title>Productos/Admin</title>
  <style>
    td {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 150px;
    }

    input {
      margin-right: 10px;

    }
  </style>
</head>

<body style="background-color:#272727">
  <!--Container Header and nav-->
  <div class="container ">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-white mb-sl-3">
      <a href="../../paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
      <img src="../../img/logo-white.png" width="150" height="50" alt="" >
      </a>

      <ul class="nav nav-pills">
        <!--Username-->
        <li class="nav-item "><a href="../../user/configuracionCuenta/vista/editarPerfil.php" class="nav-link text-white">
            <?php
            session_start();
            if (!isset($_SESSION["usuario"])) {
            } else {
              echo ($_SESSION["usuario"]["email"]);
            }
            ?>
          </a></li>
        <!--Redirect to pages-->
        <!--<li class="nav-item"><a href="../../Ofertas/vista/listaOfertas.php" class="nav-link ">Ofertas</a></li>-->
        <!--<li class="nav-item"><a href="menus.html" class="nav-link">Menus</a></li>-->
        <!--<li class="nav-item"><a href="reservar.html" class="nav-link active">Reservar</a></li>-->
        <li class="nav-item text-white"><a href="listaProductos.php" class="nav-link active text-white">Productos</a></li>
        <?php
        if (!isset($_SESSION["usuario"])) {
          //echo ('<li class="nav-item"><a href="../../user/pedirAdomicilio/direccion.php" class="nav-link ">Pedir a domicilio</a></li>');
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
          } else {
            echo ('<li class="nav-item"><a href="../../user/pedirAdomicilio/direccion.php" class="nav-link text-white">Pedir a domicilio</a></li>');
          }
        }
        ?>
        <?php
        if (!isset($_SESSION["usuario"])) {
          echo ('<li class="nav-item"><a href="../../about-us.php" class="nav-link">Quienes somos</a></li>');
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
          } else {
            echo ('<li class="nav-item"><a href="../../about-us.php" class="nav-link">Quienes somos</a></li>');
          }
        }
        ?>
        <?php
        if (!isset($_SESSION["usuario"])) {
          //echo ('<li class="nav-item"><a href="carrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 2) {
            echo ('<li class="nav-item"><a href="../../carrito/vista/mostrarCarrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
          }
        }
        ?>
        <?php
        if (!isset($_SESSION["usuario"])) {
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 1) {
            echo ('<li class="nav-item"><a href="../../admin/pedido/vista/pedidos.php" class="nav-link text-white">Pedidos</a></li>');
            echo ('<li class="nav-item"><a href="../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link text-white">Lista de usuarios</a></li>');
          } elseif ($_SESSION['usuario']['ID_Role'] == 3) {
            echo ('<li class="nav-item"><a href="../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link text-white">Lista de usuarios</a></li>');
          }
        }
        ?>
        <?php
        if (!isset($_SESSION["usuario"])) {
        } else {
          echo ('<li class="nav-item"><a id="cerrar" class="nav-link cursor: pointer text-white">Cerrar sesión</a></li>');
        }
        ?>
      </ul>
    </header>
  </div>

  <!--Page content-->
  <div id="containerProducts" class="container">
    <div class="text-center border-bottom border-white my-1">
      <h1 class="h2 mt-2 text-white">Productos</h1>
    </div>
    <!-- Filtrado con selector, añadiremos id categoria en el GET, autofocus en Todo y id categoria 0 sera para poder controlar query desde php -->
    <label for="selectorFiltrado" class="text-white">Filtrar por categoría de producto:</label>
    <select id="selectorFiltrado"></select>

    <!--Contenedor de productos-->
    <table id="tablaProductos" style="width: 90%;" class="container w-100 text-center my-1 ">
      <!--<thead class="container border border-dark rounded-4 color-White-6 my-3 w-80 h-25 p-2 mx-1 d-flex text-start">
        <th>Imagen:</th>
        <th>Nombre Producto:</th>
        <th>Precio:</th>
        <th>Acciones:</th>
      </thead>-->
      <tbody id="tbody">
      </tbody>
    </table>
    <span id="errores"> </span>

    <div id="paginacion" class="container p-2 mb-3 text-center">
      <button class="btn btn-primary" id="primera">Primera</button>
      <button class="btn btn-primary" id="anterior">Anterior</button>
      <!--Total de paginas-->
      <button class="btn btn-primary disabled" id="contadorActual"></button>
      <button class="btn btn-primary disabled" id="contador"></button>
      <!---->
      <button class="btn btn-primary" id="siguiente">Siguiente</button>
      <button class="btn btn-primary" id="ultima">Última</button>
      <?php
      if (!isset($_SESSION["usuario"])) {
        echo ('<a class="btn btn-success hide" id="crearProd" href="../../admin/Producto/vista/crearProducto.php">Crear Producto</a>');
      } else {
        if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
          echo ('<a class="btn btn-success" id="crearProd" href="../../admin/Producto/vista/crearProducto.php">Crear Producto</a>');
        } else {
          echo ('<a class="btn btn-success hide" id="crearProd" href="../../admin/Producto/vista/crearProducto.php">Crear Producto</a>');
        }
      }
      ?>
    </div>
  </div>


  <a id="carrito" href="../../carrito/vista/mostrarCarrito.php" class="hide">Carrito compra</a>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
  </script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
  </script> -->
  <script src="../../downloads/bootstrap-5.0.1-dist/js/bootstrap.min.js">
  </script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
  </script> -->
  <script src="../../downloads/bootstrap-5.0.1-dist/js/bootstrap.bundle.min.js">
  </script>

  <!--SweetAlert-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="../controlador/javascriptProductos.js"></script>
  <script type="text/javascript">
    window.addEventListener("load", loadEvents);
  </script>
</body>

</html>