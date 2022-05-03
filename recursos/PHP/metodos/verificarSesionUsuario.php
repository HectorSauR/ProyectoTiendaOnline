<?php
  if(!isset($_SESSION['usuario'])){
    header('Location: '.$pathHost);
    exit();
  }
 ?>
