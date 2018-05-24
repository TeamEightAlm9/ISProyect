<?php
  /**
   * Servicio para la conexion con la base de datos para la tabla Usuario
   */
  class ServicioUsuario{
    private $db;
    private $tName = 'Usuario';

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
    * Se crea un metodo para el registro de usuarios en la tabla Usuario
    */
    public function registrar(Usuario $data){
      try {
        $sql= "INSERT INTO ".$this->tName."(ID,Nombre,Apellidos,Pass,Cargo, Login) VALUES(?,?,?,?,?,?)";
        $this->db->prepare($sql)->execute(
          array(
          $data->__GET('ID'),
          $data->__GET('Nombre'),
          $data->__GET('Apellidos'),
          $data->__GET('Pass'),
          $data->__GET('Cargo'),
          $data->__GET('Login')
        )
      );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }
    /**
    * Se crea un metodo llamado eliminar para eliminar usuarios de la tabla Usuario
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
    * Se crea un metodo llamado actualizar para actualizar los usuarios de la tabla Usuario
    */
    public function actualizar(Usuario $data){
      try {
        $sql = "UPDATE ".$this->tName." SET Nombre=?,Apellidos=?,Pass=?,Cargo=? WHERE ID=?";
        $this->db->prepare($sql)
        ->execute(
          array(
            $data->__GET('Nombre'),
            $data->__GET('Apellidos'),
            $data->__GET('Pass'),
            $data->__GET('Cargo'),
            $data->__GET('ID')
          )
        );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }
    /**
    * Se crea un metodo llamado listar que se encarga de insertar la infromacion
    * de los usuarios en una tabla.
    */
    public function listar(){
      try {
        $result = array();
        $stm = $this->db->prepare("SELECT * FROM ".$this->tName);
        $stm->execute();
        foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
          $rec = new Usuario;
          $rec->__SET('ID',$r->ID);
          $rec->__SET('Nombre',$r->Nombre);
          $rec->__SET('Apellidos',$r->Apellidos);
          $rec->__SET('Pass',$r->Pass);
          $rec->__SET('Cargo',$r->Cargo);
          $rec->__SET('Login', $r->Login);
          $result[]=$rec;
        }
        return $result;
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    public function obtenerName($data){
      try{
        // declaramos directamente el statement y lo ejecutamos
        $stm = $this->db->prepare("SELECT * FROM ".$this->tName." WHERE Nombre=?");
        $stm->execute(array($data));
        // la variable $r almacena el objeto de retorno
        $r = $stm->fetch(PDO::FETCH_OBJ);
        // instanciamos la entidad en una variable que almacenara la informacion
        if (null != $r) {
          $user = new Usuario();
          $user->__SET('ID', $r->ID);
          $user->__SET('Nombre', $r->Nombre);
          $user->__SET('Apellidos', $r->Apellidos);
          $user->__SET('Pass', $r->Pass);
          $user->__SET('Cargo', $r->Cargo);
          $user->__SET('Login', $r->Login);
          return $user;
        }
        //retornamos la variable
      }catch (Exception $e){
        die($e->getMessage());
      }
    }

    public function login($ID, $login){
      try {
        $sql = "UPDATE ".$this->tName." SET Login=? WHERE ID=?";
        $this->db->prepare($sql)->execute(array($login,$ID));
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    public function islogin($login){
      try{
        // declaramos directamente el statement y lo ejecutamos
        $stm = $this->db->prepare("SELECT * FROM ".$this->tName." WHERE Login=?");
        $stm->execute(array($login));
        // la variable $r almacena el objeto de retorno
        $r = $stm->fetch(PDO::FETCH_OBJ);
        // instanciamos la entidad en una variable que almacenara la informacion
        if (null != $r) {
          $user = new Usuario();
          $user->__SET('ID', $r->ID);
          $user->__SET('Nombre', $r->Nombre);
          $user->__SET('Apellidos', $r->Apellidos);
          $user->__SET('Pass', $r->Pass);
          $user->__SET('Cargo', $r->Cargo);
          $user->__SET('Login', $r->Login);
          return $user;
        }
        //retornamos la variable
      }catch (Exception $e){
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
        $user = new Usuario();
        $user->__SET('ID', $r->ID);
        $user->__SET('Nombre', $r->Nombre);
        $user->__SET('Apellidos', $r->Apellidos);
        $user->__SET('Pass', $r->Pass);
        $user->__SET('Cargo', $r->Cargo);
        $user->__SET('Login', $r->Login);
        //retornamos la variable
        return $user;
      }catch (Exception $e){
        die($e->getMessage());
      }
    }
  }


 ?>
