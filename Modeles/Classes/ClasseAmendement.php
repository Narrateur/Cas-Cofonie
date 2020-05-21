<?php
//commentage
class Amendement{
  private $code_seq_amendement;
  private $lib_amendement;
  private $texte_amendement;
  private $date_amendement;
  private $code_article_ref;
  private $code_texte_ref;

  //CONSTRUCTEUR
  public function __construct($unCode, $unLib, $unTexte, $uneDate, $unArticleRef, $unTexteRef){
    $this->code_seq_amendement = $unCode;
    $this->lib_amendement = $unLib;
    $this->texte_amendement = $unTexte;
    $this->date_amendement = $uneDate;
    $this->code_article_ref = $unArticleRef;
    $this->code_texte_ref = $unTexteRef;
  }

  //GETTER
  public function getCodeSeqAmendement(){
    return $this->code_seq_amendement;
  }
  public function getLibAmendement(){
    return $this->lib_amendement;
  }
  public function getTexteAmendement(){
    return $this->texte_amendement;
  }
  public function getDateAmendement(){
    return $this->date_amendement;
  }
  public function getCodeArticleRef(){
    return $this->code_article_ref;
  }
  public function getCodeTexteRef(){
    return $this->code_texte_ref;
  }



}

?>
