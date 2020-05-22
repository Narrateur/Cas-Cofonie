<?php
//--------------------------------------------------------------------------------
//------LES INCLUDES--------------------------------------------------------------
//--------------------------------------------------------------------------------
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

      case "enregistrer":
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
        $login = $_POST['login'];
				$mdp = $_POST['mdp'];
        $mdp2 = $_POST['mdp2'];
        
        if($mdp != $mdp2){
					$message = "Les mots de passe doivent être identique";
					$lien = 'index.php?vue=vueConnexion&action=connexion';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          if($this->monCGA->verifIdentifiant($email) == true)
					{
						$message = "Cette adresse mail est déjà utilisé";
						$lien = 'index.php?vue=identification&action=inscription';
						$_SESSION['message'] = $message;
						$_SESSION['lien'] = $lien;
						require 'Vues/PageErreur.php';
					}
					else
					{
						//$subject = 'Validation'; // email';
						//$message = 'Bonjour '; //.$prenom.' '.$nom.' Ce mail a pour but de finaliser votre inscription. Cliquer sur ce lien vous renvera sur la page d\'accueil de notre site' ;
						
						//mail ($email, $subject, $message);
						
						$this->maGestion->ajouterUtilisateur($nom,$prenom,$mdp,$email,$adresse,$ville,$codePostal,$telephone,$com);
						require 'Vues/enregistrer.php';
						$this->vueTexte('visualiser');
					}
        }
        
      break;

      case "identification":
        $loginConnexion=$_POST['loginConnexion'];
        $passwordConnexion=$_POST['mdpConnexion'];
        
        if($this->maGestion->identification($loginConnexion, $passwordConnexion) == false)
				{
					echo 'Identifiant ou mot de passe incorrect';
				}else{
          require 'Vues/vueTest.php';
          $_SESSION['IdentifiantUtilisateur'] = $loginConnexion;
        }

      break;
    }
  }

  public function vueTexte($action){}
}

?>
