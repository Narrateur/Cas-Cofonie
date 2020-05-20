<?php
include 'Modeles/Classes/ClasseArticle.php';

class conteneurArticle{
  private $lesArticles;

  //CONSTRUCTEUR
  public function __construct(){
    $this->lesArticles = new ArrayObject();
  }

  public function ajouterArticle($unCode, $unTitre, $unTexte, $unCodeTexte){
    $unArticle = new Article($unCode, $unTitre, $unTexte, $unCodeTexte);
    $this->lesArticles->append($unArticle);
  }
}
?>
