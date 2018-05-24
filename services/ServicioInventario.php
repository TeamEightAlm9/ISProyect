<?php
/**
 *  Servicio para la conexion con la base de datos para la tabla Inventario
 */

class ServicioInventario{
  private $db;
  private $tName = 'Inventario';

  // constructor
  public function __CONSTRUCT(){
    try{
      //se crea la PDO(php data object) para acceder a la base de datos
      $this->db = new PDO('mysql:host=localhost;dbname=pv', 'root', '');
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
      die($e->getMessage());
    }                                 //catch
  }

  /**
  * Metodo para registrar
  **/
  public function registrar(Inventario $data){
    try {
      $sql = "INSERT INTO ".$this->tName."(ID, Nombre, Descu, Costo, Precio, Cantidad, FechaIngreso)
        VALUES(?,?,?,?,?,?,?)";
      $this->db->prepare($sql)->execute(
        array(
          $data->__GET('ID'),
          $data->__GET('Nombre'),
          $data->__GET('Descu'),
          $data->__GET('Costo'),
          $data->__GET('Precio'),
          $data->__GET('Cantidad'),
          $data->__GET('FechaIngreso')
        )
      );
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  /**
  * Metodo para eliminar un registro de la tabla inventario
  **/
  public function eliminar($ID){
    try {
      $stm = $this->db->prepare("DELETE FROM ".$this->tName." WHERE ID=?");
      $stm->execute(array($ID));
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  /**
  * Metodo para actualizar un registro
  **/
  public function actualizar(Inventario $data){
    try {
      $sql = "UPDATE ".$this->tName." SET Nombre=?, Descu=?, Costo=?, Precio=?, Cantidad=?, FechaIngreso=? WHERE ID=?";
      $this->db->prepare($sql)
        ->execute(
          array(
            $data->__GET('Nombre'),
            $data->__GET('Descu'),
            $data->__GET('Costo'),
            $data->__GET('Precio'),
            $data->__GET('Cantidad'),
            $data->__GET('FechaIngreso'),
            $data->__GET('ID')
          )
        );
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  /**
  * Metodo para listar los registros de la tabla
  **/
  public function listar(){
    try {
      $result = array();
      $stm = $this->db->prepare("SELECT * FROM ".$this->tName);
      $stm->execute();

      foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
        $rec = new Inventario;

        $rec->__SET('ID', $r->ID);
        $rec->__SET('Nombre', $r->Nombre);
        $rec->__SET('Descu', $r->Descu);
        $rec->__SET('Costo', $r->Costo);
        $rec->__SET('Precio', $r->Precio);
        $rec->__SET('Cantidad', $r->Cantidad);
        $rec->__SET('FechaIngreso', $r->FechaIngreso);

        $result[] = $rec;
      }
      return $result;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function obtener($id){
    try{
      // declaramos directamente el statement y lo ejecutamos
      $stm = $this->db->prepare("SELECT * FROM ".$this->tName." WHERE ID=?");
      $stm->execute(array($id));
      // la variable $r almacena el objeto de retorno
      $r = $stm->fetch(PDO::FETCH_OBJ);
      // instanciamos la entidad en una variable que almacenara la informacion
      $inv = new Inventario();
      $inv->__SET('ID', $r->ID);
      $inv->__SET('Nombre', $r->Nombre);
      $inv->__SET('Descu', $r->Descu);
      $inv->__SET('Costo', $r->Costo);
      $inv->__SET('Precio', $r->Precio);
      $inv->__SET('Cantidad', $r->Cantidad);
      $inv->__SET('FechaIngreso', $r->FechaIngreso);
      //retornamos la variable
      return $inv;
    }catch (Exception $e){
      die($e->getMessage());
    }
  }

}
 ?>
