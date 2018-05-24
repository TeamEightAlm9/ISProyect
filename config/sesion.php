<?php
  require_once '../services/ServicioUsuario.php';
  require_once '../models/Usuario.php';

  $serviceusr = new ServicioUsuario;
  $user = $serviceusr->islogin('y');
  if (null != $user) {
    $serviceusr->login($user->__GET('ID'), 'n');
    header('Location: ../principal.php');
  }
 ?>
