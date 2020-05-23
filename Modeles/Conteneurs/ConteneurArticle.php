<?php
//commentage
include 'Modeles/Classes/ClasseArticle.php';

class ConteneurArticle{
  private $lesArticles;

  //CONSTRUCTEUR
  public function __construct(){
    $this->lesArticles = new ArrayObject();
  }

  public function ajouterArticle($unCode, $unTitre, $unTexte, $unCodeTexte){
    $unArticle = new Article($unCode, $unTitre, $unTexte, $unCodeTexte);
    $this->lesArticles->append($unArticle);
  }

  public function getInfo($codeArticle, $info){
    foreach($this->lesArticles as $unArticle){
      if($unArticle->getCodeArticle() == $codeArticle){
        switch($info){
          case 'code_article':
            return $unArticle->getCodeArticle();
          break;
          case 'titre_article':
            return $unArticle->getTitreArticle();
          break;
          case 'texte_article':
            return $unArticle->getTexteArticle();
          break;
          case 'code_texte':
            return $unArticle->getCodeTexte();
          break;
        }
      }
    }
  }


  public function returnPlusGrandIDArticleTexte($codeTexte){
    $vretour = 0;
    foreach($this->lesArticles as $unArticle){
      if($unArticle->getCodeTexte() == $codeTexte){
        if($unArticle->getCodeArticle()>$vretour){
          $vretour = $unArticle->getCodeArticle();
        }
      }
    }
    return $vretour;
  }


}
?>
