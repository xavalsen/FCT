<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../css/allPages.css">
  <link rel="stylesheet" href="../../../css/index.css">
  <link rel="icon" type="image/png" href="../../../uploads/logo-page.png">
  <!--SweetAlert-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- CSS only -->
  <link href="../../../downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <title>Pizzería Girona</title>
</head>

<body style="background-color:#272727">  
  <!--Container Header and nav-->
  <div class="container ">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom  mb-sl-3">
      <a href="../../../paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
      <img src="../../../img/logo-white.png" width="150" height="50" alt="" >
      </a>
      <ul class="nav nav-pills">
        <!--Username-->
        <li class="nav-item "><a href="editarPerfil.php" class="nav-link active">
            <?php
            session_start();
            echo ($_SESSION["usuario"]["email"]);
            ?>
          </a></li>
        <!--Redirect to pages-->
        <!--<li class="nav-item"><a href="../../../Ofertas/vista/listaOfertas.php" class="nav-link ">Ofertas</a></li>-->
        <!--<li class="nav-item"><a href="menus.html" class="nav-link">Menus</a></li>-->
        <!--<li class="nav-item"><a href="reservar.html" class="nav-link active">Reservar</a></li>-->
        <li class="nav-item text-white"><a href="../../../Productos/vista/listaProductos.php" class="nav-link text-white">Productos</a></li>
        <?php
        if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
        } else {
          echo ('<li class="nav-item text-white"><a href="../../../user/pedirAdomicilio/direccion.php" class="nav-link text-white">Pedir a domicilio</a></li>');
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
          echo ('<li class="nav-item"><a href="../../../carrito/vista/mostrarCarrito.php" class="nav-link text-white"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
        }
        ?>
        <?php
        if ($_SESSION['usuario']['ID_Role'] == 1) {
          echo ('<li class="nav-item" ><a href="../../../admin/pedido/vista/pedidos.php" class="nav-link text-white">Pedidos</a></li>');
          echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link text-white">Lista de usuarios</a></li>');
        } else if ($_SESSION['usuario']['ID_Role'] == 3) {
          echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link text-white">Lista de usuarios</a></li>');
        }
        ?>
        <li class="nav-item "><a id="cerrar" class="nav-link text-white">Cerrar sesión</a></li>
      </ul>
    </header>
  </div>

  <div class="container-sm h-auto w-auto p-5" >
    <h1 class="text-white">Configuración del perfil</h1>
    <div class="container border border-dark w-100 h-75 p-4 m-3" style="background-color:white">
      <h2>Cambiar contraseña</h2>
      <br>
      <div class="container">
        <form action="../modelo/cambiarContrasena.php" method="POST">
          <div class="d-block">
            <input placeholder="Contraseña actual" class="form-control" type="password" name="passActual" required>
          </div>
          <br>
          <div class="d-block">
            <input placeholder="Nueva contraseña" class="form-control" type="password" name="passNueva" required>
          </div>
          <br>
          <div class="d-block">
            <input placeholder="Confirmar nueva contraseña" class="form-control" type="password" name="passNueva2" required>
            <?php
            if (isset($_GET['error']) == 1) {
              echo "
              <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Problemas con las nuevas contraseñas',
                  text: 'Las contraseñas no son iguales!',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.replace('http://localhost/php/user/configuracionCuenta/vista/editarPerfil.php');                    
                  }
                })
              </script>
              ";
            } else if (isset($_GET['pincorrecto'])) {
              echo "
              <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Hay un problema con la contraseña',
                  text: 'Contraseña actual incorrecta!',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.replace('http://localhost/php/user/configuracionCuenta/vista/editarPerfil.php');                    
                  }
                })
              </script>
              ";
            } else if (isset($_GET['pcorrecto'])) {
              echo "
              <script>               
                Swal.fire({
                  icon: 'success',
                  title: 'Contraseña cambiada',
                  text: 'Se ha actualizado la contraseña!',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.replace('http://localhost/php/user/configuracionCuenta/vista/editarPerfil.php');                    
                  }
                })
              </script>
              ";
            }
            ?>
          </div>
          <br>
          <button class="btn btn-primary btn-lg btn-block" type="submit">Cambiar contraseña</button>
        </form>
      </div>
    </div>
    <div class="container border border-dark w-100 h-75 p-4 m-3" style="background-color:white">
      <h2>Cambiar nombre</h2>
      <br>
      <div class="container">
        <form action="../modelo/cambiarNombre.php" method="POST">
          <div class="d-block">
            <input placeholder="Nuevo nombre"class="form-control" type="text" name="nombre" required>
          </div>
          <?php
          if (isset($_GET['ncorrecto'])) {
            echo "
              <script>                
                Swal.fire({
                  icon: 'success',
                  title: 'El nombre se actualizo correctamente',
                  text: 'Se ha actualizado el nombre!',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.replace('http://localhost/php/user/configuracionCuenta/vista/editarPerfil.php');                    
                  }
                })
              </script>
              ";
          }
          ?>
          <br>
          <button class="btn btn-primary btn-lg btn-block" type="submit">Cambiar nombre</button>
        </form>
      </div>
    </div>
    <div class="container border border-dark w-100 h-75 p-4 m-3" style="background-color:white">
      <h2>Cambiar teléfono</h2>
      <br>
      <div class="container">
        <form action="../modelo/cambiarTelefono.php" method="POST">
          <div class="d-block">
            <input class="form-control" type="text" placeholder="Nuevo Teléfono: xxx-xxx-xxx" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" name="telefono" id="formBorders" required>
            <span class="validity"></span>
          </div>
          <?php
          if (isset($_GET['tcorrecto'])) {
            echo "
              <script>  
                Swal.fire({
                  icon: 'success',
                  title: 'El teléfono se actualizo correctamente',
                  text: 'Se ha actualizado el teléfono!',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.replace('http://localhost/php/user/configuracionCuenta/vista/editarPerfil.php');                    
                  }
                })
              </script>
              ";
          }
          ?>
          <br>
          <button class="btn btn-primary btn-lg btn-block" type="submit">Cambiar teléfono</button>
        </form>
      </div>
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
  <script type="text/javascript" src="../controlador/perfilusuario.js"></script>
  <script type="text/javascript">
    window.addEventListener("load", loadEvents);
  </script>


</body>