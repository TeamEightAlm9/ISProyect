<?php
class Inventario {
  private $ID;
  private $Nombre;
  private $Descu;
  private $Costo;
  private $Precio;
  private $Cantidad;
  private $FechaIngreso;

  public function __GET($k) {
    return $this->$k;
  }

  public function __SET($k, $v) {
    return $this->$k = $v;
  }
}
?>
