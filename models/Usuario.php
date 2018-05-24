<?php
class Usuario {
  private $ID;
  private $Nombre;
  private $Apellidos;
  private $Pass;
  private $Cargo;
  private $Login;

  public function __GET($k) {
    return $this->$k;
  }

  public function __SET($k, $v) {
    return $this->$k = $v;
  }
}
?>
