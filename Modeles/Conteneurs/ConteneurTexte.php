<?php
include 'Modeles/Classes/ClasseTexte.php';

class ConteneurTexte{
  private $lesTextes;

  //CONSTUCTEUR
  public function __construct(){
    $this->lesTextes = new ArrayObject();
  }

  public function ajouterTexte($unCode, $unTitre, $unVote, $unePromulgation, $unCodeInstitution){
    $unTexte = new Texte($unCode, $unTitre, $unVote, $unePromulgation, $unCodeInstitution);
    $this->lesTextes->append($unTexte);
  }
}

?>
