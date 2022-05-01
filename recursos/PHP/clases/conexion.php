<?php

  class Conexion{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "tienda_online";
    private $conect;

    public function __construct(){
      $connectionString = "mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";

      try {
        $this->conect = new PDO($connectionString,$this->user,$this->password);
        $this->conect->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
        echo "Conexion exitosa";
      } catch (Exception $e) {
        $this->conect = "Error de conexion";
        echo "ERROR: ".$e->getMessage();
      }

    }

  }

  $conect = new Conexion();

 ?>
