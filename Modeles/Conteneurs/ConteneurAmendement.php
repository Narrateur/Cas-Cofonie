<?php
include 'Modeles/Classes/ClasseAmendement.php';

class conteneurAmendement{
  private $lesAmendements;

  //CONSTRUCTEUR
  public function __construct(){
    $this->lesAmendements = new ArrayObject();
  }

  public function ajouterAmendement($unCode, $unLib, $unTexte, $uneDate, $unArticleRef, $unTexteRef){
    $unAmendement = new Amendement($unCode, $unLib, $unTexte, $uneDate, $unArticleRef, $unTexteRef);
    $this->lesAmendements->append($unAmendement);
  }

}


?>
