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
    td {
      text-align: center;
    }
  </style>
</head>

<body style="background-color:#272727">
  <?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location: http://localhost/php/auth/login.html");
  }
  ?>
  <!--Container Header and nav-->
  <div class="container ">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom  mb-sl-3">
      <a href="../../../paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none text-white">
      <img src="../../../img/logo-white.png" width="150" height="50" alt="" >
      </a>

      <ul class="nav nav-pills">
        <!--Username-->
        <li class="nav-item "><a href="../../../user/configuracionCuenta/vista/editarPerfil.php" class="nav-link text-white">
            <?php
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
        if (!isset($_SESSION["usuario"])) {
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
          } else {
            echo ('<li class="nav-item"><a href="../../../about-us.php" class="nav-link text-white">Quienes somos</a></li>');
          }
        }
        ?>
        <?php
        if ($_SESSION['usuario']['ID_Role'] == 2) {
          echo ('<li class="nav-item"><a href="carrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4 "></i></a></li>');
        }
        ?>
        <?php
        if ($_SESSION['usuario']['ID_Role'] == 1) {
          echo ('<li class="nav-item"><a href="../../../admin/pedido/vista/pedidos.php" class="nav-link text-white">Pedidos</a></li>');
          echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link active">Lista de usuarios</a></li>');
        } elseif ($_SESSION['usuario']['ID_Role'] == 3) {
          echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link active">Lista de usuarios</a></li>');
        }
        ?>
        <li class="nav-item"><a id="cerrar" class="nav-link text-white">Cerrar sesión</a></li>
      </ul>
    </header>
  </div>

  <!--Content page-->
  <div class="container  my-5 ">
  <div class="text-center border-bottom border-white my-5">
      <h1 class="h2 mt-2 text-white">Usuarios registrados</h1>
    </div>
    <!--Table users-->
    <div class="container p-3 text-center">
      <table id="tablaUsuarios" class="w-100">
        <thead class=" container border ">
          <th class="hide text-white">ID:</th>
          <th class="text-white">Nombre</th>
          <th class="text-white">Email</th>
          <th class="text-white">Teléfono</th>
          <th class="text-white">Dirección</th>
          <th class="text-white">Roles</th>
          <th class="text-white" id="acciones">Acciones</th>
        </thead>
        <tbody class="text-white" id="tbody">
        </tbody>
      </table>
    </div>
    <!--Controls buttons-->
    <div id="paginacion" class="container mt-5">
      <div id="paginacion" class="text-center ">
        <button class="btn btn-primary" id="primera">Primera</button>
        <button class="btn btn-primary" id="anterior">Anterior</button>
        <!--Total de paginas-->
        <button class="btn btn-primary disabled" id="contadorActual"></button>
        <button class="btn btn-primary disabled" id="contador"></button>
        <!---->
        <button class="btn btn-primary" id="siguiente">Siguiente</button>
        <button class="btn btn-primary" id="ultima">Última</button>

        <?php
        if ($_SESSION['usuario']['ID_Role'] == 3) {
          echo ('<a href="crearUsuario.php" class="btn btn-success">Crear Usuario</a>');
        }
        ?>
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
  <script type="text/javascript" src="../controlador/javascriptUsuarios.js"></script>
  <script type="text/javascript">
    window.addEventListener("load", loadEvents);
  </script>
</body>

</html>