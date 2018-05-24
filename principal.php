<?php
  require_once 'services/ServicioUsuario.php';
  require_once 'services/ServicioProducto.php';
  require_once 'services/ServicioVenta.php';
  require_once 'services/ServicioInventario.php';
  require_once 'models/Usuario.php';
  require_once 'models/Producto.php';
  require_once 'models/Venta.php';
  require_once 'models/Inventario.php';

  $validation="";
  $userService = new ServicioUsuario;
  $user = $userService->islogin('y');
  if (null == $user) {
    header('Location: index.php');
  }
  $pService = new ServicioProducto;
  $producto = new Producto;
  $invService = new ServicioInventario;
  $invObj = new Inventario;

  if(isset($_REQUEST['action'])){
      switch($_REQUEST['action']){
          case 'actualizar':
            if (null != $_REQUEST['id'] and null != $_REQUEST['cantidad'] and null != $_REQUEST['soporte-id']) {
              $id = $_REQUEST['soporte-id'];
              $apoyo = $invService->obtener($id);
              $producto->__SET('ID', $_REQUEST['id']);
              $producto->__SET('Nombre', $apoyo->__GET('Nombre'));
              $producto->__SET('Descu', $apoyo->__GET('Descu'));
              $producto->__SET('Precio', $apoyo->__GET('Precio'));
              $producto->__SET('Cantidad', $_REQUEST['cantidad']);

              $pService->actualizar($producto);
              header('Location: principal.php');
            }else {
              $validation = "*Introduzca Todos los datos!!";
            }
              break;

          case 'registrar':
            if (null != $_REQUEST['id'] and null != $_REQUEST['cantidad'] and null != $_REQUEST['soporte-id']) {
              $id = $_REQUEST['soporte-id'];
              $apoyo = $invService->obtener($id);
              $producto->__SET('ID', $_REQUEST['id']);
              $producto->__SET('Nombre', $apoyo->__GET('Nombre'));
              $producto->__SET('Descu', $apoyo->__GET('Descu'));
              $producto->__SET('Precio', $apoyo->__GET('Precio'));
              $producto->__SET('Cantidad', $_REQUEST['cantidad']);

              $pService->registrar($producto);
              header('Location: principal.php');
            }
            else {
                $validation = "*Introduzca Todos los datos!!";
            }
              break;

          case 'eliminar':
              $pService->eliminar($_REQUEST['id']);
              header('Location: principal.php');
              break;
          case 'venta':
              foreach ($pService->listar() as $r) {
                /** Proceso para agregar las ventas va aqui
                *   Falta la vista de las ventas que se han hecho
                **/
                $pService->eliminar($r->__GET('ID'));
              }
              break;
          case 'acceso':
            if ($user->__GET('Cargo') == "adm" or $user->__GET('Cargo') == "gerente") {
              if ($_REQUEST['p'] == "almacen") {
                header('Location: almacen.php');
              }
              if ($_REQUEST['p'] == "users") {
                header('Location: usuario.php');
              }
            }
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
    <title>Punto de Venta</title>
  </head>
  <body>
    <!-- content here -->
    <main class="container-fluid">
      <div class="row">
        <div class="col-2 menu sticky-top">
          <div class="d-flex flex-column pt-5 border-bottom">
            <img class="mx-auto" src="img/usuario.svg" width="60" height="60" alt="">
            <p class="text-white mx-auto mb-4 pt-3"> <?php echo $user->__GET('Nombre'). " - " . $user->__GET('Cargo'); ?> </p>
          </div>
          <nav class="nav flex-column text-center">
            <a class="nav-link py-4 border-bottom text-secondary active" href="principal.php">Punto de Venta</a>
            <a class="nav-link py-4 border-bottom text-white" href="?action=acceso&p=almacen">Almacen</a>
            <a class="nav-link py-4 border-bottom text-white" href="?action=acceso&p=users">Gestion de Usuarios</a>
            <a class="nav-link py-4 border-bottom text-danger" href="config/sesion.php">Cerrar Sesion</a>
          </nav>
        </div>
        <!-- menu end here -->

        <div class="col-10">
          <div class="row">
            <div class="col-12 px-1 py-1 border-bottom bg-light">
              <form class="" action="..." method="post">
                <div class="form-group mb-1 d-flex justify-content-between align-items-center">
                  <h1>Punto de Venta</h1>
                  <a class="btn btn-outline-danger" href="?action=venta">Registrar Venta</a>
                </div>
              </form>
            </div>
            <div class="col-12">
              <form class="p-2" action="?action=<?php echo $producto->ID > 0 ? 'actualizar' : 'registrar'; ?>" method="post">
                <div class="row justify-content-end">
                  <div class="form-group col-6">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" name="id" id="id" value="<?php echo $producto->__GET('ID'); ?>">
                  </div>
                  <div class="form-group col-6">
                    <label for="cantidad">Cantidad:</label>
                    <input type="text" class="form-control" name="cantidad" id="cantidad" value="<?php echo $producto->__GET('Cantidad'); ?>">
                  </div>
                  <div class="form-group col-12">
                    <select name="soporte-id" class="form-control">
                      <?php foreach ($invService->listar() as $r): ?>
                      <option value="<?php echo $r->__GET('ID'); ?>"><?php echo $r->__GET('Nombre'); ?></option>
                      <?php endforeach; ?>
                    </select>
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
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($pService->listar() as $r): ?>
                      <tr>
                          <th scope="row"><?php echo $r->__GET('ID'); ?></th>
                          <td><?php echo $r->__GET('Nombre'); ?></td>
                          <td><?php echo $r->__GET('Descu'); ?></td>
                          <td><?php echo $r->__GET('Precio'); ?></td>
                          <td><?php echo $r->__GET('Cantidad'); ?></td>
                          <td>
                            <div class="d-flex">
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
