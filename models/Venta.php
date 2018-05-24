<?php
class Venta {
  private $ID;
  private $Total;
  private $Fecha;

  public function __GET($k) {
    return $this->$k;
  }

  public function __SET($k, $v) {
    return $this->$k = $v;
  }
}
?>
