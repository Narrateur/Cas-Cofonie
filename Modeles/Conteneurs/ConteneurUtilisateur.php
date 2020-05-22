<?php
//commentage
include 'Modeles/Classes/ClasseUtilisateur.php';

class ConteneurUtilisateur{
  private $lesUtilisateurs;

  //CONSTRUCTEUR
  public function __construct(){
    $this->lesUtilisateurs = new ArrayObject();
  }

  public function ajouterUtilisateur($unCodeUser, $unNomUser, $unPrenomUser, $unLoginUser, $unPasswordUser, $unCodeInstitution){
    $unUtilisateur = new Utilisateur($unCodeUser, $unNomUser, $unPrenomUser, $unLoginUser, $unPasswordUser, $unCodeInstitution);
    $this->lesUtilisateurs->append($unUtilisateur);
  }

  public function verifIdentifiant($idInscription) // Verifie si l'identifiant rentré pour l'inscription existe deja ou non
	{
		$result = false;
		foreach($this->lesUtilisateurs as $unUtilisateur)
		{
			$login = $unUtilisateur->getPasswordUser();
			$idInscription = strtolower($idInscription);
			$email = strtolower($login);
			if(strcmp($email, $idInscription) == 0)
			{
				$result = true;
				break;
			}
			else
			{
				$result = false;
			}
		}
		return $result;  
	}
  
  

	public function identification($login, $mdp) //verifie si l'utilisateur a rentré le bon identifiant et le bon mot de passe
	{
		$result = false;
		foreach($this->lesUtilisateurs as $unUtilisateur)
		{
      $result = false;
			$unLogin = $unUtilisateur->getLoginUser();
      $unMotDePasse = $unUtilisateur->getPasswordUser();

      //--Supprime les eventuelles espace-----(sql server met des espace à la fin, donc fausse l'authentification)---------------------
      $unLogin = str_replace(' ','',$unLogin);    
      $unMotDePasse = str_replace(' ','',$unMotDePasse);
      //$login = str_replace(' ','',$login);      //On ne retire pas les espaces de ce que l'utilisateur entre
      //$mdp = str_replace(' ','',$mdp);      //----------------------------------------------------------
      //-------------------------------------------------------------------------------------------------------------------------------
      
			if(($mdp==$unMotDePasse)&&($login==$unLogin))
			{
				$result = true;
				break;
			}
			
		}
		return $result; 
	}








}?>
