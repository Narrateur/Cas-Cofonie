<?php
//LES INCLUDES
include 'Conteneurs/ConteneurAmendement.php';
include 'Conteneurs/ConteneurArticle.php';
//include 'Conteneurs/ConteneurComprendre.php';
//include 'Conteneurs/ConteneurDate.php';
//include 'Conteneurs/ConteneurFaireReference.php';
//include 'Conteneurs/ConteneurInstitution.php';
//include 'Conteneurs/ConteneurOrganes.php';
//include 'Conteneurs/ConteneurRole.php';
include 'Conteneurs/ConteneurTexte.php';
//include 'Conteneurs/ConteneurTypeInstitution.php';
include 'Conteneurs/ConteneurUtilisateur.php';
//include 'Conteneurs/ConteneurVoter.php';
include 'AccesBD.php';

//La Classe
class Gestion{
  //Les Variables
  private $toutLesTextes;
  private $toutLesArticles;
  private $toutLesAmendements;
  private $toutLesUtilisatateurs;
  private $CasCofonieBDD;


  public function __construct(){
    $this->toutLesTextes = new ConteneurTexte();
    $this->toutLesArticles = new ConteneurArticle();
    $this->toutLesAmendements = new ConteneurAmendement();
    $this->toutLesUtilisatateurs = new ConteneurUtilisateur();
    $this->CasCofonieBDD = new AccesBD();

    $this->chargeLesTextes();
    $this->chargeLesArticles();
    $this->chargeLesAmendements();
    $this->chargeLesUtilisateurs();
  }

  //METHODES DE CHARGEMENT DE LA BASE DE DONNEES
  public function chargeLesTextes(){
    $resultat = $this->CasCofonieBDD->loadTable('Texte');
    $nb=0;
    while($nb<sizeof($resultat)){
      $this->toutLesTextes->ajouterTexte($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2], $resultat[$nb] [3], $resultat[$nb] [4]);
      $nb++;
    }
  }
  public function chargeLesArticles(){
    $resultat = $this->CasCofonieBDD->loadTable('Article');
    $nb=0;
    while($nb<sizeof($resultat)){
      $this->toutLesArticles->ajouterArticle($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2], $resultat[$nb] [3]);
      $nb++;
    }
  }
  public function chargeLesAmendements(){
    $resultat = $this->CasCofonieBDD->loadTable('Amendement');
    $nb=0;
    while($nb<sizeof($resultat)){
      $this->toutLesAmendements->ajouterAmendement($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2], $resultat[$nb] [3], $resultat[$nb] [4], $resultat[$nb] [5]);
      $nb++;
    }
  }
  public function chargeLesUtilisateurs(){
    $resultat = $this->CasCofonieBDD->loadTable('Utilisateur');
    $nb=0;
    while($nb<sizeof($resultat)){
      $this->toutLesUtilisatateurs->ajouterUtilisateur($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2], $resultat[$nb] [3], $resultat[$nb] [4], $resultat[$nb] [5]);
      $nb++;
    }
  }










}?>
