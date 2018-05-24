<?php
class Producto {
  private $ID;
  private $Nombre;
  private $Descu;
  private $Precio;
  private $Cantidad;

  public function __GET($k) {
    return $this->$k;
  }

  public function __SET($k, $v) {
    return $this->$k = $v;
  }
}
?>
