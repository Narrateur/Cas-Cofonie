<?php
//commentage
include 'Modeles/Classes/ClasseAmendement.php';

class ConteneurAmendement{
  private $lesAmendements;

  //CONSTRUCTEUR
  public function __construct(){
    $this->lesAmendements = new ArrayObject();
  }

  public function ajouterAmendement($unCode, $unLib, $unTexte, $uneDate, $unArticleRef, $unTexteRef){
    $unAmendement = new Amendement($unCode, $unLib, $unTexte, $uneDate, $unArticleRef, $unTexteRef);
    $this->lesAmendements->append($unAmendement);
  }

  public function returnCodeAmendementSuivant($codeArticle,$codeTexte){
    $vretour=1;
    foreach($this->lesAmendements as $unAmendement){
      if($unAmendement->getCodeArticleRef() == $codeArticle && $unAmendement->getCodeTexteRef() == $codeTexte){
        if($vretour == $unAmendement->getCodeSeqAmendement()){
          $vretour++;
        }
      }
    }
    return $vretour;
  }

  public function getInfo($codeAmendement, $codeArticle, $codeTexte, $info){
    foreach($this->lesAmendements as $unAmendement){
      if($unAmendement->getCodeSeqAmendement()==$codeAmendement && $unAmendement->getCodeArticleRef() == $codeArticle && $unAmendement->getCodeTexteRef() == $codeTexte){
        switch($info){
          case 'code_seq_amendement':
            return $unAmendement->getCodeSeqAmendement();
          break;
          case 'lib_amendement':
            return $unAmendement->getLibAmendement();
          break;
          case 'texte_amendement':
            return $unAmendement->getTexteAmendement();
          break;
          case 'date_amendement':
            return $unAmendement->getDateAmendement();
          break;
          case 'code_article_ref':
            return $unAmendement->getCodeArticleRef();
          break;
          case 'code_texte_ref':
            return $unAmendement->getCodeTexteRef();
          break;
        }
      }
    }
  }



  public function returnPlusGrandIDAmendementArticle($codeArticle,$codeTexte){
    $vretour = 0;
    foreach($this->lesAmendements as $unAmendement){
      if($unAmendement->getCodeArticleRef() == $codeArticle && $unAmendement->getCodeTexteRef() == $codeTexte){
        if($unAmendement->getCodeSeqAmendement() > $vretour){
          $vretour = $unAmendement->getCodeSeqAmendement();
        }
      }
    }
    return $vretour;
  }






}


?>
