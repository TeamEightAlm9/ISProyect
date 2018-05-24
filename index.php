<?php
  require_once 'services/ServicioUsuario.php';
  require_once 'models/Usuario.php';

  $advertence;

  $serviceusr = new ServicioUsuario;
  $user = $serviceusr->islogin('y');
  if (null != $user) {
    header('Location: principal.php');
  }
  
  if(isset($_REQUEST['action'])){
    $user = $_REQUEST['user'];
    $pass = $_REQUEST['pass'];
    if (null != $user) {
      $usuario = $serviceusr->obtenerName($user);
      if (null != $usuario) {
        if ($usuario->__GET('Pass') == $pass) {
          $serviceusr->login($usuario->__GET('ID'), 'y');
          header('Location: principal.php');
        }else {
          $advertence = "Contraseña incorrecta";
        }
      }else {
        $advertence = "Usuario incorrecto";
      }
    }else{
      $advertence = "Ingrese los datos";
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
    body {
      background-image: url(img/background-inicio.jpg);
    }
    .principal{
      width: 500px;
      background-color: rgba(52, 52, 52, 0.72);
      border: 1px solid rgba(52, 52, 52, 0.72);
      border-radius: 15px;
    }
    .form{
      width: 320px;
    }
    .form input[type="text"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form input[type="password"] {
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }
    @media only screen and (min-width: 576px) {

    }
    @media only screen and (min-width: 768px) {

    }
    @media only screen and (min-width: 992px) {

    }
    @media only screen and (min-width: 993px) {

    }
    </style>
    <title>Acceso</title>
  </head>
  <body class="text-center text-white">
    <!-- content here -->
    <div class="container pt-5">
      <div class="p-5 mx-auto principal">
        <img class="mt-5" src="img/plato.svg" width="90" height="90" alt="logo">
        <h2 class="display pt-3">Iniciar Sesión</h2>
        <form class="form mx-auto pt-1 pb-5" method="post" action="?action=ingresar">
          <input class="form-control" type="text" name="user" value="" placeholder="Usuario">
          <input class="form-control " type="password" name="pass" value="" placeholder="Contraseña">
          <span class="text-danger"> <?php
          if (isset($_REQUEST['action'])) {
            echo "* ".$advertence;
          }
          ?> </span>
          <button class="form-control btn btn-danger mt-3" type="submit" name="button">Acceder</button>
        </form>
      </div>
    </div>

    <!-- fin content -->


    <!-- plugins for bootstrap and others here -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- final plugins -->
  </body>
</html>
