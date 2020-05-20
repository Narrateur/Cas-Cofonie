<?php
class Article{
  private $code_article;
  private $titre_article;
  private $texte_article;
  private $code_texte;

  public function __construct($unCode, $unTitre, $unTexte, $unCodeTexte){
    $this->code_article = $unCode;
    $this->titre_article = $unTitre;
    $this->texte_article = $unTexte;
    $this->code_texte = $unCodeTexte;
  }

  //GETTER
  public function getCodeArticle(){
    return $this->code_article;
  }
  public function getTitreArticle(){
    return $this->titre_article;
  }
  public function getTexteArticle(){
    return $this->texte_article;
  }
  public function getCodeTexte(){
    return $this->code_texte;
  }
}

?>
