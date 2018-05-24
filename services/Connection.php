<?php
  /**
   *  Clase para acceder a la base de datos
   */
  class Connection{
    private static $dbName = "juego";
    private static $dbHost = "localhost";
    private static $dbUser = "root";
    private static $dbPass = "";

    private static $cnx = null;

    public function __construct(){
      die('Init function is not allowed');
    }

    public static function connect(){
      if(null == self::$cnx){
        try{
          self::$cnx = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName, self::$dbUser, self::$dbPass);
        }catch(PDOException $ex){
          die($ex->getMessage());
        }
      }
      return self::$cnx;
    }

    public static function close(){
      self::$cnx = null;
    }
  }
  ?>
