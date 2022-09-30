<?php

  class Conexion{
    private $host = "localhost";
    private $user = "u351136177_Grupo301";
    private $password = "Grup0#301";
    private $db = "u351136177_ventas";
    private $conect;

    public function __construct(){
      $connectionString = "mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";

      try {
        $this->conect = new PDO($connectionString,$this->user,$this->password);
        $this->conect->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
      } catch (Exception $e) {
        $this->conect = "Error de conexion";
        echo "ERROR: ".$e->getMessage();
      }

    }
    public function getConectionMysql(){
      return mysqli_connect($this->host,$this->user,$this->password,$this->db);
    }

    public function connect(){
      return $this->conect;
    }

    

  }



  $conexion = new Conexion();
  $conexion = $conexion->connect();

?>