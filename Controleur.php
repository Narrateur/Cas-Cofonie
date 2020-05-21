<?php
//LES INCLUDES---------------------------------------------------------------
include 'Modeles/Gestion.php';

class Controleur{
  private $maGestion;

  public function __construct(){
    $this->maGestion = new Gestion();
  }

  public function afficherMenu(){
    require 'Vues/Menu.php';
  }

}

?>
