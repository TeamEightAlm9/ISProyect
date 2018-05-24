<?php
  /**
   *  Servicio para conexion con la base de datos para la tabla Venta
   */

  class ServicioVenta{
    private $db;
    private $tName = 'Venta';

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
    * Metodo para registrar a la tabla de venta
    **/
    public function registrar(Venta $data){
      try {
        $sql = "INSERT INTO ".$this->tName."(ID, Total, Fecha) VALUES(?,?,?)";
        $this->db->prepare($sql)->execute(
          array(
            $data->__GET('ID'),
            $data->__GET('Total'),
            $data->__GET('Fecha')
          )
        );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    /**
    * Metodo para eliminar un registro de la tabla venta
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
    * Metodo para actualizar algun registro de la tabla venta
    **/
    public function actualizar(Venta $data){
      try {
        $sql = "UPDATE ".$this->tName." SET Total=?, Fecha=? WHERE ID=?";
        $this->db->prepare($sql)
          ->execute(
            array(
              $data->__GET('Total'),
              $data->__GET('Fecha'),
              $data->__GET('ID')
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    /**
    * Metodo para listar todo los registro de la tabla venta
    **/
    public function listar(){
      try {
        $result = array();
        $stm = $this->db->prepare("SELECT * FROM ".$this->tNname);
        $stm->execute();

        foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
          $rec = new Venta;

          $rec->__SET('ID', $r->ID);
          $rec->__SET('Total', $r->Total);
          $rec->__SET('Fecha', $r->Fecha);

          $result[] = $rec;
        }
        return $result;
      } catch (Exception $e) {
        die($e->getMessage());
      }

    }

  }

 ?>
