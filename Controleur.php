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
        $_SESSION['listeOrgane'] = $this->maGestion->listeDeroulanteOrgane();
        require 'Vues/Connexion.php';
      break; //case "connexion"

      case "enregistrer":
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
        $login = $_POST['login'];
				$mdp = $_POST['mdp'];
        $mdp2 = $_POST['mdp2'];
        $codeOrgane = $_POST['idOrgane'];
        
        if($mdp != $mdp2){
					$message = "Les mots de passe doivent être identique";
					$lien = 'index.php?vue=vueConnexion&action=connexion';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          if($this->maGestion->verifIdentifiant($login) == true)
					{
						$message = "Cet identifiant est déjà utilisé";
						$lien = 'index.php?vue=vueConnexion&action=connexion';
						$_SESSION['message'] = $message;
						$_SESSION['lien'] = $lien;
						require 'Vues/PageErreur.php';
					}else{
						$this->maGestion->ajouterUtilisateur($nom, $prenom, $login, $mdp, $codeOrgane);
						//require 'Vues/enregistrer.php';
						$this->vueTexte('visualiser');
					}
        }
        
      break; //case "enregistrer"

      case "identification":
        if($_SESSION['IdentifiantUtilisateur'] == null){
          $loginConnexion=$_POST['loginConnexion'];
          $passwordConnexion=$_POST['mdpConnexion'];
          
          if($this->maGestion->identification($loginConnexion, $passwordConnexion) == false){
            echo 'Identifiant ou mot de passe incorrect';
          }else{
            //require 'Vues/vueTest.php';
            $_SESSION['IdentifiantUtilisateur'] = $loginConnexion;
            $_SESSION['InfoUser'] = 'Bonjour '.$this->maGestion->getNomPrenom($loginConnexion);
            header("Refresh:0");
          }
        }
        $this->vueTexte('visualiser');
      break; //case "identification"
      
      case "deconnecter":
        if($_SESSION['IdentifiantUtilisateur'] !== null){
          $_SESSION['IdentifiantUtilisateur'] = null;
          $_SESSION['InfoUser'] = null;
          header("Refresh:0");
        }
        $this->vueTexte('visualiser');
      break;

    }
  }

  public function vueTexte($action){
    switch($action){
      case "visualiser":
        $_SESSION['ToutLesTextes']= $this->maGestion->listeLesTextes();
        require 'Vues/VueTexte.php';
      break; //case "visualiser"

      case "vueVoter":
        $_SESSION['lesArticlesAVoter'] = $this->maGestion->listeLesArticlesAVoter();
        //require "Vues/VoterArticle.php";
        require 'Vues/vueTest.php';
      break;  //case "vueVoter"

      case "voter":
        if(0 == 1){
          $message = "Erreur : Vous ne pouvez pas voter";
					$lien = 'index.php?vue=vueTexte&action=visialiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          require 'Vues/vueTest.php';
        }

      break;  //case "voter"

      case "proposerLoi":
        require 'Vues/ProposerLoi.php';
      break;  //case "proposerTexte"

      case "proposerAmendement":

      break;  //"proposerAmendement"
    }
  }
}

?>
