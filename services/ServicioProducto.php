<?php
  /**
   * Servicio para la conexion con la base de datos para la tabla Producto.
   */
  class ServicioProducto{
    private $db;
    private $tName = 'Producto';

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
    * Se crea un metodo para el registro de productos en la tabla Producto
    */
    public function registrar(Producto $data){
      try {
        $sql= "INSERT INTO ".$this->tName."(ID,Nombre,Descu,Precio,Cantidad) VALUES(?,?,?,?,?)";
        $this->db->prepare($sql)->execute(
          array(
          $data->__GET('ID'),
          $data->__GET('Nombre'),
          $data->__GET('Descu'),
          $data->__GET('Precio'),
          $data->__GET('Cantidad')
        )
      );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }
    /**
    * Se crea un metodo llamado eliminar para eliminar productos de la tabla Producto
    */
    public function eliminar($ID){
      try {
        $stm = $this->db->prepare("DELETE FROM ".$this->tName." WHERE ID=?");
        $stm->execute(array($ID));
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }
    /**
    * Se crea un metodo llamado actualizar para actualizar los productos de la tabla Producto
    */
    public function actualizar(Producto $data){
      try {
        $sql = "UPDATE ".$this->tName." SET Nombre=?,Descu=?,Precio=?,Cantidad=? WHERE ID=?";
        $this->db->prepare($sql)
        ->execute(
          array(
            $data->__GET('Nombre'),
            $data->__GET('Descu'),
            $data->__GET('Precio'),
            $data->__GET('Cantidad'),
            $data->__GET('ID')
          )
        );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }
    /**
    * Se crea un metodo llamado listar que se encarga de insertar la infromacion
    * de los productos en una tabla.
    */
    public function listar(){
      try {
        $result = array();
        $stm = $this->db->prepare("SELECT * FROM ".$this->tName);
        $stm->execute();
        foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
          $rec = new Producto;
          $rec->__SET('ID',$r->ID);
          $rec->__SET('Nombre',$r->Nombre);
          $rec->__SET('Descu',$r->Descu);
          $rec->__SET('Precio',$r->Precio);
          $rec->__SET('Cantidad',$r->Cantidad);
          $result[]=$rec;

        }
        return $result;
      } catch (Exception $e) {
        die($e->getMessage());
      }

    }
  }


 ?>
