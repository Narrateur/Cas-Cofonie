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
        if($_SESSION['IdentifiantUtilisateur'] == null){
          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $login = $_POST['login'];
          $mdp = $_POST['mdp'];
          $mdp2 = $_POST['mdp2'];
          $codeOrgane = $_POST['idOrgane'];
          $role = $_POST['libRole'];
          
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
              $this->maGestion->ajouterUtilisateur($nom, $prenom, $login, $mdp, $codeOrgane,$role);
              //require 'Vues/enregistrer.php';
              $_SESSION['IdentifiantUtilisateur'] = $login;
              $_SESSION['InfoUser'] = 'Bonjour '.$this->maGestion->getNomPrenom($login);
              header("Refresh:0");
              
            }
          }
        }
        $this->vueTexte('visualiser');
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
        if($this->maGestion->getRoleUser($_SESSION['IdentifiantUtilisateur']) !== 'citoyen'){
          $message = "Erreur : Vous ne pouvez saisir de vote";
					$lien = 'index.php?vue=vueTexte&action=visualiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          $_SESSION['lesArticlesAVoter'] = $this->maGestion->listeLesArticlesAVoter();
          //require "Vues/VoterArticle.php";
          require 'Vues/vueTest.php';
        }
      break;  //case "vueVoter"

      case "voter":
        if($this->maGestion->getRoleUser($_SESSION['IdentifiantUtilisateur']) !== 'greffier'){
          $message = "Erreur : Vous ne pouvez saisir de vote";
					$lien = 'index.php?vue=vueTexte&action=visualiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          require 'Vues/vueTest.php';
        }
      break;  //case "voter"

      case "proposerLoi":
        if($this->maGestion->getRoleUser($_SESSION['IdentifiantUtilisateur']) !== 'secretaire'){
          $message = "Erreur : Vous ne pouvez pas proposer de Loi";
					$lien = 'index.php?vue=vueTexte&action=visualiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          $_SESSION['nbArticle'] = 1;
          require 'Vues/ProposerLoi.php';
        }
      break;  //case "proposerTexte"

      case "choisirArticle":
        if($this->maGestion->getRoleUser($_SESSION['IdentifiantUtilisateur']) !== 'secretaire'){
          $message = "Erreur : Vous ne pouvez pas être ici";
					$lien = 'index.php?vue=vueTexte&action=visualiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          if(isset($_POST['idTexteAmendement'])){
            $_SESSION['idTexte']=$_POST['idTexteAmendement'];
          }else{
            $_SESSION['idTexte'] = '';
          }
          $_SESSION['listeDeroulanteTexte'] = $this->maGestion->listeDeroulanteTexte();
          $_SESSION['listeDeroulanteArticle'] = $this->maGestion->listeDeroulanteArticle($_SESSION['idTexte']);
          require 'Vues/ProposerAmendement.php';
        }
        
      break;  //"choisirArticle"

      case 'ajouterArticle':
        if($this->maGestion->getRoleUser($_SESSION['IdentifiantUtilisateur']) !== 'secretaire'){
          $message = "Erreur : Vous ne pouvez pas être ici";
					$lien = 'index.php?vue=vueTexte&action=visualiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          if($_SESSION['nbArticle']==null){
            $_SESSION['nbArticle'] = 1;
            $_SESSION['titre_texte']='';
          }else{
            $_SESSION['nbArticle'] = $_SESSION['nbArticle']+1;
          }
          require 'Vues/ProposerLoi.php';
        }
      break;  //case 'ajouterArticle'

      case 'retirerArticle':
        if($this->maGestion->getRoleUser($_SESSION['IdentifiantUtilisateur']) !== 'secretaire'){
          $message = "Erreur : Vous ne pouvez pas être ici";
					$lien = 'index.php?vue=vueTexte&action=visualiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          if($_SESSION['nbArticle'] > 0){
            $_SESSION['nbArticle'] = $_SESSION['nbArticle']-1;
          }        
          //$_SESSION['nbArticle'] = 0;
          require 'Vues/ProposerLoi.php';
        }
      break;  //case 'retirerArticle'

      case 'enregistrerLoi':
        if($this->maGestion->getRoleUser($_SESSION['IdentifiantUtilisateur']) !== 'secretaire'){
          $message = "Erreur : Vous ne pouvez pas être ici";
					$lien = 'index.php?vue=vueTexte&action=visualiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          $titre_texte = $_POST['lib_text'];
          $idTexte = $this->maGestion->ajouterTexte($titre_texte);
          for($i=1;$i<=$_SESSION['nbArticle'];$i++){
            $titre_article = $_POST['titre_article'.$i];
            $texte_article = $_POST['texte_article'.$i];
            $this->maGestion->ajouterArticle($i,$titre_article,$texte_article,$idTexte);
          }
          $_SESSION['nbArticle'] = null;
          $this->vueTexte('visualiser');
        }
      break; //case 'enregistrerLoi'

      case 'proposerAmendement':
        if($this->maGestion->getRoleUser($_SESSION['IdentifiantUtilisateur']) !== 'secretaire'){
          $message = "Erreur : Vous ne pouvez pas être ici";
					$lien = 'index.php?vue=vueTexte&action=visualiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          $_SESSION['idArticle'] = $_POST['idArticleAmendement'];
          $_SESSION['listeDeroulanteArticle'] = $this->maGestion->listeDeroulanteArticle($_SESSION['idTexte']);

          $_SESSION['texteArticleAmendement'] = "<textarea id='texte_article' name='texte_article' rows='5' cols='33' readonly>".$this->maGestion->getInfoArticle($_SESSION['idArticle'], $_SESSION['idTexte'], 'texte_article')."</textarea>";

          $code_amendement = $this->maGestion->returnCodeAmendementSuivant($_SESSION['idArticle'],$_SESSION['idTexte']);
          $_SESSION['lib_amendement'] = 'Amendement '.$code_amendement.' - Article '.$_SESSION['idArticle'].' - '.$this->maGestion->getInfoTexte($_SESSION['idTexte'],'titre_texte');
          $_SESSION['choixTexteArticle']=1;
          require 'Vues/ProposerAmendement.php';
        }
        
      break;  //case 'proposerAmendement'

      case 'enregistrerAmendement':
        if($this->maGestion->getRoleUser($_SESSION['IdentifiantUtilisateur']) !== 'secretaire'){
          $message = "Erreur : Vous ne pouvez pas être ici";
					$lien = 'index.php?vue=vueTexte&action=visualiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          $code_amendement = $this->maGestion->returnCodeAmendementSuivant($_SESSION['idArticle'],$_SESSION['idTexte']);
          $lib_amendement = $_POST['lib_amendement'];
          $texte_amendement = $_POST['texte_amendement'];

          $this->maGestion->ajouterAmendement($code_amendement, $lib_amendement, $texte_amendement, $_SESSION['idArticle'], $_SESSION['idTexte']);
          $_SESSION['idArticle']=null;
          $_SESSION['idTexte']=null;
          $_SESSION['choixTexteArticle']=null;
          $_SESSION['lib_amendement']=null;
          $_SESSION['listeDeroulanteArticle']=null;
          $_SESSION['listeDeroulanteTexte']=null;
          $_SESSION['texteArticleAmendement']=null;
          $this->vueTexte('visualiser');
        }
        
      break;  //case 'enregistrerAmendement'

      case 'ajouterArticleTexte':
        //$ $this->maGestion->listeDeroulanteTexte();
        if($this->maGestion->getRoleUser($_SESSION['IdentifiantUtilisateur']) !== 'secretaire'){
          $message = "Erreur : Vous ne pouvez pas être ici";
					$lien = 'index.php?vue=vueTexte&action=visualiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          $_SESSION['listeTexteAjoutArticle'] = $this->maGestion->listeDeroulanteTexte();
          
          if(isset($_POST['idTexteAmendement'])){
            $_SESSION['idTexte'] = $_POST['idTexteAmendement'];
            $_SESSION['libArticle'] = 'Article '.$this->maGestion->returnCodeArticleSuivant($_SESSION['idTexte'])." - ".$this->maGestion->getInfoTexte($_SESSION['idTexte'],'titre_texte');
          }
          $_SESSION['ArticlesDuTexte'] = $this->maGestion->listeLesTextesAvecID($_SESSION['idTexte']);
          require 'Vues/AjouterArticle.php';
        }
      break;

      case 'enregistrerArticleAjout':
        if($this->maGestion->getRoleUser($_SESSION['IdentifiantUtilisateur']) !== 'secretaire'){
          $message = "Erreur : Vous ne pouvez pas être ici";
					$lien = 'index.php?vue=vueTexte&action=visualiser';
					$_SESSION['message'] = $message;
					$_SESSION['lien'] = $lien;
					require 'Vues/PageErreur.php';
        }else{
          $code_article = $this->maGestion->returnCodeArticleSuivant($_SESSION['idTexte']);
          $titre_article = $_POST['titre_article'];
          $texte_article = $_POST['texte_article'];
          $this->maGestion->ajouterArticle($code_article,$titre_article,$texte_article,$_SESSION['idTexte']);

          $_SESSION['listeTexteAjoutArticle'] = null;
          $_SESSION['ArticlesDuTexte'] = null;
          $_SESSION['idTexte'] = null;
          $_SESSION['libArticle'] = null;
          $this->vueTexte('visualiser');
        }
      break;
    }
  }
}

?>
