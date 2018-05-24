<?php
  require_once 'services/ServicioUsuario.php';
  require_once 'models/Usuario.php';

  $validation="";
  $userService = new ServicioUsuario;
  $usuario = new Usuario;
  $user = $userService->islogin('y');
  if (null == $user) {
    header('Location: index.php');
  }

  if(isset($_REQUEST['action'])){
      switch($_REQUEST['action']){
          case 'actualizar':
              if (null != $_REQUEST['id'] and null != $_REQUEST['name'] and null != $_REQUEST['apellidos'] and null != $_REQUEST['pass'] and null != $_REQUEST['cargo']) {
                $usuario->__SET('ID',              $_REQUEST['id']);
                $usuario->__SET('Nombre',          $_REQUEST['name']);
                $usuario->__SET('Apellidos',       $_REQUEST['apellidos']);
                $usuario->__SET('Pass',            $_REQUEST['pass']);
                $usuario->__SET('Cargo',           $_REQUEST['cargo']);

                $userService->actualizar($usuario);
                header('Location: usuario.php');
              }else{
                $validation = "*Introduzca Todos los datos!!";
              }

              break;

          case 'registrar':
              if (null != $_REQUEST['id'] and null != $_REQUEST['name'] and null != $_REQUEST['apellidos'] and null != $_REQUEST['pass'] and null != $_REQUEST['cargo']) {
                $usuario->__SET('ID',              $_REQUEST['id']);
                $usuario->__SET('Nombre',          $_REQUEST['name']);
                $usuario->__SET('Apellidos',       $_REQUEST['apellidos']);
                $usuario->__SET('Pass',            $_REQUEST['pass']);
                $usuario->__SET('Cargo',           $_REQUEST['cargo']);
                $usuario->__SET('Login',           'n');

                $userService->registrar($usuario);
                header('Location: usuario.php');
              }else{
                $validation = "*Introduzca Todos los datos!!";
              }
              break;

          case 'eliminar':
              $userService->eliminar($_REQUEST['id']);
              header('Location: usuario.php');
              break;

          case 'editar':
              $usuario = $userService->obtener($_REQUEST['id']);
              break;
      }
    }

 ?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS and others here-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <style media="screen">
    .menu{
      border-right: 2px solid rgb(18, 18, 18);
      background-color: rgba(52, 52, 52);
      height: 100vh;
    }
    .nav-link:hover{
      background-color: rgba(100, 100, 100);
    }
    .pv{
      height: 100vh;
    }
    </style>
    <title>Cuentas</title>
  </head>
  <body>
    <!-- content here -->
    <main class="container-fluid">
      <div class="row">
        <div class="col-2 menu sticky-top">
          <div class="d-flex flex-column pt-5 border-bottom">
            <img class="mx-auto" src="img/usuario.svg" width="60" height="60" alt="">
            <p class="text-white mx-auto mb-4 pt-3"><?php echo $user->__GET('Nombre'). " - " . $user->__GET('Cargo'); ?></p>
          </div>
          <nav class="nav flex-column text-center">
            <a class="nav-link py-4 border-bottom text-white" href="principal.php">Punto de Venta</a>
            <a class="nav-link py-4 border-bottom text-white" href="almacen.php">Almacen</a>
            <a class="nav-link py-4 border-bottom text-secondary active" href="usuario.php">Gestion de Usuarios</a>
            <a class="nav-link py-4 border-bottom text-danger" href="config/sesion.php">Cerrar Sesion</a>
          </nav>
        </div>
        <!-- menu end here -->
        <div class="col-10">
          <div class="row">
            <div class="col-12 bg-light">
              <h1>Gestion de Usuarios</h1>
            </div>
            <div class="col-12">
              <form class="p-2" action="?action=<?php echo $usuario->ID > 0 ? 'actualizar' : 'registrar'; ?>" method="post">
                <div class="form-row">
                  <div class="form-group col-4">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control form-control-sm" name="id" id="id" value="<?php echo $usuario->__GET('ID'); ?>">
                  </div>
                  <div class="form-group col-8">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo $usuario->__GET('Nombre'); ?>">
                  </div>
                  <div class="form-group col-12">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control form-control-sm" name="apellidos" id="apellidos" value="<?php echo $usuario->__GET('Apellidos'); ?>">
                  </div>
                  <div class="form-group col-6">
                    <label for="pass">Contraseña:</label>
                    <input type="text" class="form-control form-control-sm" name="pass" id="pass" value="<?php echo $usuario->__GET('Pass'); ?>">
                  </div>
                  <div class="form-group col-6">
                    <label for="cargo">Cargo:</label>
                    <input type="text" class="form-control form-control-sm" name="cargo" id="cargo" value="<?php echo $usuario->__GET('Cargo'); ?>">
                  </div>
                  <div class="form-group col-10">
                    <span class="text-danger"><?php echo $validation; ?><span>
                  </div>
                  <div class="form-group col-2">
                    <button type="submit" class="btn btn-danger" name="auser">Añadir Usuario</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($userService->listar() as $r): ?>
                      <tr>
                          <th scope="row"><?php echo $r->__GET('ID'); ?></th>
                          <td><?php echo $r->__GET('Nombre'); ?></td>
                          <td><?php echo $r->__GET('Apellidos'); ?></td>
                          <td><?php echo $r->__GET('Pass'); ?></td>
                          <td><?php echo $r->__GET('Cargo'); ?></td>
                          <td>
                            <div class="d-flex">
                              <a class="btn btn-warning" href="?action=editar&id=<?php echo $r->ID; ?>">Editar</a>
                              <a class="btn ml-1 btn-danger" href="?action=eliminar&id=<?php echo $r->ID; ?>">Eliminar</a>
                            </div>
                          </td>
                      </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- fin content -->


    <!-- plugins for bootstrap and others here -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- final plugins -->
  </body>
</html>
