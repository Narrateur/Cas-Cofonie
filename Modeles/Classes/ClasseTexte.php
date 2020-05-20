<?php
class Texte{
  private $code_texte;
  private $titre_texte;
  private $vote_final_texte;
  private $promulgation_texte;
  private $code_institution;

  //CONSTRUCTEUR
  public function __construct($unCode, $unTitre, $unVote, $unePromulgation, $unCodeInstitution){
    $this->code_texte = $unCode;
    $this->titre_texte = $unTitre;
    $this->vote_final_texte = $unVote;
    $this->promulgation_texte = $unePromulgation;
    $this->code_institution = $unCodeInstitution;
  }

  //GETTER
  public function getCodeTexte(){
    return $this->code_texte;
  }
  public function getTitreTexte(){
    return $this->titre_texte;
  }
  public function getVoteFinalTexte(){
    return $this->vote_final_texte;
  }
  public function getPromulgationTexte(){
    return $this->promulgation_texte;
  }
  public function getCodeInstitution(){
    return $this->code_institution;
  }
}

?>
