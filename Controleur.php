<?php
//LES INCLUDES--------------------------------------------------------------
include 'Modeles/Gestion.php';

class Controleur{
  private $maGestion;

  public function __construct(){
    $this->maGestion = new Gestion();
  }

  public function afficherMenu(){
    require 'Vues/Menu.php';
  }

  public function afficherPage($action,$vue){
    switch($vue){
      case "vueConnexion":
        $this->vueConnexion($action);
      break;
      case 'vueTexte':
        $this->vueTexte($action);
      break;
    }
  }

  public function vueConnexion($action){
    switch($action){
      case "connexion":
        require 'Vues/Connexion.php';
      break;

      case "inscription":
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
        $login = $_POST['login'];
				$mdp = $_POST['mdp'];
				$mdp2 = $_POST['mdp2'];
      break;

      case "identification":
        $loginConnexion=$_POST['loginConnexion'];
        $passwordConnexion=$_POST['mdpConnexion'];
        
        if($this->monCGA->verifMDP($email, $mdp) == false)
				{
					echo 'Identifiant ou mot de passe incorrect';
				}else{
          echo 'connecte';
          require 'Vues/vueTest.php';
        }

      break;
    }
  }

  public function vueTexte($action){}
}

?>
