<?php
//LES INCLUDES
include 'Conteneurs/ConteneurAmendement.php';
include 'Conteneurs/ConteneurArticle.php';
//include 'Conteneurs/ConteneurComprendre.php';
//include 'Conteneurs/ConteneurDate.php';
//include 'Conteneurs/ConteneurFaireReference.php';
include 'Conteneurs/ConteneurInstitution.php';
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
  private $lesTextes;
  private $lesArticles;
  private $lesAmendements;
  private $lesUtilisatateurs;
  private $lesInstitutions;
  private $CasCofonieBDD;


  public function __construct(){
    $this->lesTextes = new ConteneurTexte();
    $this->lesArticles = new ConteneurArticle();
    $this->lesAmendements = new ConteneurAmendement();
    $this->lesUtilisatateurs = new ConteneurUtilisateur();
    $this->lesInstitutions = new ConteneurInstitution();
    $this->CasCofonieBDD = new AccesBD();

    $this->chargeTexte();
    $this->chargeArticle();
    $this->chargeAmendement();
    $this->chargeUtilisateur();
  }


  public function verifIdentifiant($email)
	{
		return $this->lesUtilisatateurs->verifIdentifiant($email);
	}
	public function identification($loginConnexion, $passwordConnexion)
	{
		return $this->lesUtilisatateurs->identification($loginConnexion, $passwordConnexion);
	}




  //---------------------------------------------------------------------------------------------------------------------------------------------
  //-----------METHODES DE CHARGEMENT DE LA BASE DE DONNEES--------------------------------------------------------------------------------------
  //---------------------------------------------------------------------------------------------------------------------------------------------
  public function chargeAmendement(){
    $resultat = $this->CasCofonieBDD->loadTable('Amendement');
    $nb=0;
    while($nb<sizeof($resultat)){
      $this->lesAmendements->ajouterAmendement($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2], $resultat[$nb] [3], $resultat[$nb] [4], $resultat[$nb] [5]);
      $nb++;
    }
  }
  public function chargeArticle(){
    $resultat = $this->CasCofonieBDD->loadTable('Article');
    $nb=0;
    while($nb<sizeof($resultat)){
      $this->lesArticles->ajouterArticle($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2], $resultat[$nb] [3]);
      $nb++;
    }
  }
  public function chargeInstitution(){
    $resultat = $this->CasCofonieBDD->loadTable('Institution');
    $nb=0;
    while($nb<sizeof($resultat)){
      $this->lesInstitutions->ajouterInstitution($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2]);
      $nb++;
    }
  }
  public function chargeTexte(){
    $resultat = $this->CasCofonieBDD->loadTable('Texte');
    $nb=0;
    while($nb<sizeof($resultat)){
      $this->lesTextes->ajouterTexte($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2], $resultat[$nb] [3], $resultat[$nb] [4]);
      $nb++;
    }
  }
  public function chargeUtilisateur(){
    $resultat = $this->CasCofonieBDD->loadTable('Utilisateur');
    $nb=0;
    while($nb<sizeof($resultat)){
      $this->lesUtilisatateurs->ajouterUtilisateur($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2], $resultat[$nb] [3], $resultat[$nb] [4], $resultat[$nb] [5]);
      $nb++;
    }
  }


  //---------------------------------------------------------------------------------------------------------------------------------------------
  //-----------METHODES D'AJOUT DANS LA BASE DE DONNEES------------------------------------------------------------------------------------------
  //---------------------------------------------------------------------------------------------------------------------------------------------

  public function ajouterUtilisateur($nomUser, $prenomUser, $loginUser, $passwordUser, $codeInstitution){
    $sonID = $this->CasCofonieBDD->insertUtilisateur($nomUser, $prenomUser, $loginUser, $passwordUser, $codeInstitution);
    $this->lesUtilisatateurs->ajouterUtilisateur($sonID, $nomUser, $prenomUser, $loginUser, $passwordUser, $codeInstitution);
  }





}?>
