<?php
  require_once 'services/ServicioUsuario.php';
  require_once 'services/ServicioInventario.php';
  require_once 'models/Usuario.php';
  require_once 'models/Inventario.php';

  $validation="";
  $userService = new ServicioUsuario;
  $user = $userService->islogin('y');
  if (null == $user) {
    header('Location: index.php');
  }
  $invService = new ServicioInventario;
  $invObj = new Inventario;

  if(isset($_REQUEST['action'])){
      switch($_REQUEST['action']){
          case 'actualizar':
            if (null != $_REQUEST['id'] and null != $_REQUEST['nombre'] and null != $_REQUEST['desc'] and null != $_REQUEST['costo'] and null != $_REQUEST['precio'] and null != $_REQUEST['cantidad'] and null != $_REQUEST['date']) {
              $invObj->__SET('ID',              $_REQUEST['id']);
              $invObj->__SET('Nombre',          $_REQUEST['nombre']);
              $invObj->__SET('Descu',           $_REQUEST['desc']);
              $invObj->__SET('Costo',           $_REQUEST['costo']);
              $invObj->__SET('Precio',          $_REQUEST['precio']);
              $invObj->__SET('Cantidad',        $_REQUEST['cantidad']);
              $invObj->__SET('FechaIngreso',    $_REQUEST['date']);

              $invService->actualizar($invObj);
              header('Location: almacen.php');
            }else{
              $validation = "*Introduzca Todos los datos!!";
            }

              break;

          case 'registrar':
          if (null != $_REQUEST['id'] and null != $_REQUEST['nombre'] and null != $_REQUEST['desc'] and null != $_REQUEST['costo'] and null != $_REQUEST['precio'] and null != $_REQUEST['cantidad'] and null != $_REQUEST['date']) {
            $invObj->__SET('ID',              $_REQUEST['id']);
            $invObj->__SET('Nombre',          $_REQUEST['nombre']);
            $invObj->__SET('Descu',           $_REQUEST['desc']);
            $invObj->__SET('Costo',           $_REQUEST['costo']);
            $invObj->__SET('Precio',          $_REQUEST['precio']);
            $invObj->__SET('Cantidad',        $_REQUEST['cantidad']);
            $invObj->__SET('FechaIngreso',    $_REQUEST['date']);

            $invService->registrar($invObj);
            header('Location: almacen.php');
          }else{
            $validation = "*Introduzca Todos los datos!!";
          }
              break;

          case 'eliminar':
              $invService->eliminar($_REQUEST['id']);
              header('Location: almacen.php');
              break;

          case 'editar':
              $invObj = $invService->obtener($_REQUEST['id']);
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
    <title>Almacen</title>
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
            <a class="nav-link py-4 border-bottom text-secondary active" href="almacen.php">Almacen</a>
            <a class="nav-link py-4 border-bottom text-white" href="usuario.php">Gestion de Usuarios</a>
            <a class="nav-link py-4 border-bottom text-danger" href="config/sesion.php">Cerrar Sesion</a>
          </nav>
        </div>
        <!-- menu end here -->
        <div class="col-10">
          <div class="row">
            <div class="col-12 bg-light">
              <h1>Gestion de Almacen</h1>
            </div>
            <div class="col-12">
              <form class="p-2" action="?action=<?php echo $invObj->ID > 0 ? 'actualizar' : 'registrar'; ?>" method="post">
                <div class="form-row">
                  <div class="form-group col-4">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control form-control-sm" name="id" id="id" value="<?php echo $invObj->__GET('ID'); ?>">
                  </div>
                  <div class="form-group col-8">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" id="name" value="<?php echo $invObj->__GET('Nombre'); ?>">
                  </div>
                  <div class="form-group col-12">
                    <label for="desc">Descripcion:</label>
                    <input type="text" class="form-control form-control-sm" name="desc" id="desc" value="<?php echo $invObj->__GET('Descu'); ?>">
                  </div>
                  <div class="form-group col-6">
                    <label for="costo">Costo:</label>
                    <input type="number" class="form-control form-control-sm" name="costo" id="costo" value="<?php echo $invObj->__GET('Costo'); ?>">
                  </div>
                  <div class="form-group col-6">
                    <label for="precio">Precio:</label>
                    <input type="number" class="form-control form-control-sm" name="precio" id="precio" value="<?php echo $invObj->__GET('Precio'); ?>">
                  </div>
                  <div class="form-group col-6">
                    <label for="cantidad">Cantidad Total:</label>
                    <input type="number" class="form-control form-control-sm" name="cantidad" id="cantidad" value="<?php echo $invObj->__GET('Cantidad'); ?>">
                  </div>
                  <div class="form-group col-6">
                    <label for="date">Fecha de Ingreso:</label>
                    <input type="date" class="form-control form-control-sm" name="date" id="date" value="<?php echo $invObj->__GET('FechaIngreso'); ?>">
                  </div>
                  <div class="form-group col-10">
                    <span class="text-danger"><?php echo $validation; ?><span>
                  </div>
                  <div class="form-group col-2">
                    <button type="submit" class="btn btn-danger" name="aproduct">Añadir Producto</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-12">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Nombre del Producto</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Fecha de Ingreso</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($invService->listar() as $r): ?>
                      <tr>
                          <th scope="row"><?php echo $r->__GET('ID'); ?></th>
                          <td><?php echo $r->__GET('Nombre'); ?></td>
                          <td><?php echo $r->__GET('Descu'); ?></td>
                          <td><?php echo $r->__GET('Costo'); ?></td>
                          <td><?php echo $r->__GET('Precio'); ?></td>
                          <td><?php echo $r->__GET('Cantidad'); ?></td>
                          <td><?php echo $r->__GET('FechaIngreso'); ?></td>
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
