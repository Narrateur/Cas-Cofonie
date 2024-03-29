<?php
//LES INCLUDES
include 'Conteneurs/ConteneurAmendement.php';
include 'Conteneurs/ConteneurArticle.php';
//include 'Conteneurs/ConteneurComprendre.php';
//include 'Conteneurs/ConteneurDate.php';
//include 'Conteneurs/ConteneurFaireReference.php';
include 'Conteneurs/ConteneurInstitution.php';
include 'Conteneurs/ConteneurOrgane.php';
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
    $this->lesOrganes = new ConteneurOrgane();
    $this->CasCofonieBDD = new AccesBD();

    $this->chargeTexte();
    $this->chargeArticle();
    $this->chargeAmendement();
    $this->chargeUtilisateur();
    $this->chargeInstitution();
    $this->chargeOrgane();
  }


  public function verifIdentifiant($login)
	{
		return $this->lesUtilisatateurs->verifIdentifiant($login);
	}
	public function identification($loginConnexion, $passwordConnexion)
	{
		return $this->lesUtilisatateurs->identification($loginConnexion, $passwordConnexion);
	}
  public function getNomPrenom($loginUser){
    return $this->lesUtilisatateurs->getNomPrenom($loginUser);
  }
  public function getRoleUser($loginUser){
    return $this->lesUtilisatateurs->getRoleUser($loginUser);
  }
  public function returnCodeAmendementSuivant($code_article, $code_texte){
    return $this->lesAmendements->returnCodeAmendementSuivant($code_article,$code_texte);
  }
  public function returnCodeArticleSuivant($codeTexte){
    return $this->lesArticles->returnCodeArticleSuivant($codeTexte);
  }

  public function getInfoArticle($code_article,$code_texte,$info){
    return $this->lesArticles->getInfo($code_article,$code_texte,$info);
  }
  public function getInfoTexte($code_texte,$info){
    return $this->lesTextes->getInfo($code_texte,$info);
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
  public function chargeOrgane(){
    $resultat = $this->CasCofonieBDD->loadTable('Organe');
    $nb=0;
    while($nb<sizeof($resultat)){
      $this->lesOrganes->ajouterOrgane($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2]);
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
      $this->lesUtilisatateurs->ajouterUtilisateur($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2], $resultat[$nb] [3], $resultat[$nb] [4], $resultat[$nb] [5], $resultat[$nb] [6]);
      $nb++;
    }
  }


  //---------------------------------------------------------------------------------------------------------------------------------------------
  //-----------METHODES D'AJOUT DANS LA BASE DE DONNEES------------------------------------------------------------------------------------------
  //---------------------------------------------------------------------------------------------------------------------------------------------

  public function ajouterUtilisateur($nomUser, $prenomUser, $loginUser, $passwordUser, $codeInstitution, $role){
    $this->CasCofonieBDD->insertUtilisateur($nomUser, $prenomUser, $loginUser, $passwordUser, $codeInstitution, $role);
    //echo 'son id '.$sonID;
    //$this->lesUtilisatateurs->ajouterUtilisateur($sonID, $nomUser, $prenomUser, $loginUser, $passwordUser, $codeInstitution);

    $resultat = $this->CasCofonieBDD->loadTable('Utilisateur');
    $nb=0;
    while($nb<sizeof($resultat)){
      $this->lesUtilisatateurs->ajouterUtilisateur($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2], $resultat[$nb] [3], $resultat[$nb] [4], $resultat[$nb] [5], $resultat[$nb] [6]);
      $nb++;
    }
  }

  public function ajouterTexte($titre_texte){
    $this->CasCofonieBDD->insertTexte($titre_texte, null, null, 3);

    $resultat = $this->CasCofonieBDD->loadTable('Texte'); // Ici on cherche à récupérer l'ID du texte que l'on vient de créer
    $nb=0;
    while($nb<sizeof($resultat)){
      if(str_replace(' ','',$titre_texte) == str_replace(' ','',$resultat[$nb] [1])){
        $this->lesTextes->ajouterTexte($resultat[$nb] [0], $resultat[$nb] [1], $resultat[$nb] [2], $resultat[$nb] [3], $resultat[$nb] [4]);
        return $resultat[$nb] [0];
      }
      $nb++;
    }
    
  }

  public function ajouterArticle($code_article,$titre_article, $texte_article, $code_texte){
    $this->CasCofonieBDD->insertArticle($code_article,$titre_article, $texte_article, $code_texte);
    $this->lesArticles->ajouterArticle($code_article,$titre_article, $texte_article, $code_texte);
  }

  public function ajouterAmendement($code_amendement, $lib_amendement, $texte_amendement, $code_article_ref, $code_texte_ref){
    $this->CasCofonieBDD->insertAmendement($code_amendement, $lib_amendement, $texte_amendement, date('Y-m-d'), $code_article_ref, $code_texte_ref);
    $this->lesAmendements->ajouterAmendement($code_amendement, $lib_amendement, $texte_amendement, date('Y-m-d'), $code_article_ref, $code_texte_ref);
  }

  //---------------------------------------------------------------------------------------------------------------------------------------------
  //-----------METHODES DE LISTAGE DES INFOS-----------------------------------------------------------------------------------------------------
  //---------------------------------------------------------------------------------------------------------------------------------------------
  public function listeDeroulanteInstitution(){
    return $this->lesInstitutions->listeDeroulanteInstitution();
  }

  public function listeDeroulanteOrgane(){
    return $this->lesOrganes->listeDeroulanteOrgane();
  }

  public function listeDeroulanteTexte(){
    return $this->lesTextes->listeDeroulanteTexte();
  }

  public function listeDeroulanteArticle($idTexte){
    return $this->lesArticles->listeDeroulanteArticle($idTexte);
  }

  public function listeLesTextes(){
    $vretour='';
    for($texte=1; $texte<=$this->lesTextes->returnPlusGrandID(); $texte++){
      if(!empty($this->lesTextes->getInfo($texte, 'titre_texte'))){
        $vretour = $vretour."<table border=2 margin-left:auto;margin-right:auto;>
                              <tr>
                                <td style='text-align:center'>
                                  <h3>".$this->lesTextes->getInfo($texte, 'titre_texte')."</h3>
                                </td>
                              </tr>";

        for($article=1; $article<=$this->lesArticles->returnPlusGrandIDArticleTexte($texte); $article++){
          if(!empty($this->lesArticles->getInfo($article, $texte, 'titre_article'))){
            $vretour = $vretour."<tr><td>".$this->lesArticles->getInfo($article, $texte, 'titre_article')."<br>".$this->lesArticles->getInfo($article, $texte, 'texte_article')."</td>";

            for($amendement=1; $amendement<=$this->lesAmendements->returnPlusGrandIDAmendementArticle($article,$texte);$amendement++){
              if(!empty($this->lesAmendements->getInfo($amendement,$article,$texte,'lib_amendement'))){
                $vretour = $vretour."<td>".$this->lesAmendements->getInfo($amendement,$article,$texte,'lib_amendement')." <br>du ".$this->lesAmendements->getInfo($amendement,$article,$texte,'date_amendement')."<br><br>".$this->lesAmendements->getInfo($amendement,$article,$texte,'texte_amendement')."</td>";
              }
            }
            $vretour = $vretour."</tr>";
          }
          
        }
        $vretour = $vretour.'</table>';             
      }
    }
    return $vretour;
  }

  public function listeLesTextesAvecID($idTexte){
    $vretour='';
    for($texte=1; $texte<=$this->lesTextes->returnPlusGrandID(); $texte++){
      if(!empty($this->lesTextes->getInfo($texte, 'titre_texte')) && $texte == $idTexte){
        $vretour = $vretour."<table border=2 margin-left:auto;margin-right:auto;>
                              <tr>
                                <td style='text-align:center'>
                                  <h3>".$this->lesTextes->getInfo($texte, 'titre_texte')."</h3>
                                </td>
                              </tr>";

        for($article=1; $article<=$this->lesArticles->returnPlusGrandIDArticleTexte($texte); $article++){
          if(!empty($this->lesArticles->getInfo($article, $texte, 'titre_article'))){
            $vretour = $vretour."<tr><td>".$this->lesArticles->getInfo($article, $texte, 'titre_article')."<br>".$this->lesArticles->getInfo($article, $texte, 'texte_article')."</td>";

            for($amendement=1; $amendement<=$this->lesAmendements->returnPlusGrandIDAmendementArticle($article,$texte);$amendement++){
              if(!empty($this->lesAmendements->getInfo($amendement,$article,$texte,'lib_amendement'))){
                $vretour = $vretour."<td>".$this->lesAmendements->getInfo($amendement,$article,$texte,'lib_amendement')." <br>du ".$this->lesAmendements->getInfo($amendement,$article,$texte,'date_amendement')."<br><br>".$this->lesAmendements->getInfo($amendement,$article,$texte,'texte_amendement')."</td>";
              }
            }
            $vretour = $vretour."</tr>";
          }
          
        }
        $vretour = $vretour.'</table>';             
      }
    }
    return $vretour;
  }

  public function listeLesArticlesAVoter(){
    //compliqué
  }


}?>
