<?php
//commentage
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

  public function getInfo($codeTexte, $info){
    foreach($this->lesTextes as $unTexte){
      if($unTexte->getCodeTexte()==$codeTexte){
        switch($info){
          case 'code_texte':
            return $unTexte->getCodeTexte();
          break;
          case 'titre_texte':
            return $unTexte->getTitreTexte();
          break;
          case 'vote_final_texte':
            return $unTexte->getVoteFinalTexte();
          break;
          case 'promulgation_texte':
            return $unTexte->getPromulgationTexte();
          break;
          case 'code_institution':
            return $unTexte->getCodeInstitution();
          break;
          default :
            echo 'Erreur, l\'information demandé n\'existe pas';
        }
      }
    }
  }

  public function returnPlusGrandID(){
    $vretour=0;
    foreach($this->lesTextes as $unTexte){
      if($unTexte->getCodeTexte() > $vretour){
        $vretour = $unTexte->getCodeTexte();
      }
    }
    return $vretour;
  }








}

?>
