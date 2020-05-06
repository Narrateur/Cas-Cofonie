<?php
//les Includes
include 'AccesBD.php';

//La Classe
class Gestion{
  //Les Variables
  private $maBD;


  public function __construct(){
    $this->maBD = new AccesBD();
  }
}

 ?>
