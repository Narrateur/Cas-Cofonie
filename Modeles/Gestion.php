<?php
//les Includes
include 'Conteneurs/ConteneurAmendement.php';
/*include 'Conteneurs/ConteneurArticle.php';
include 'Conteneurs/ConteneurComprendre.php';
include 'Conteneurs/ConteneurDate.php';
include 'Conteneurs/ConteneurFaireReference.php';
include 'Conteneurs/ConteneurInstitution.php';
include 'Conteneurs/ConteneurOrganes.php';
include 'Conteneurs/ConteneurRole.php';
include 'Conteneurs/ConteneurTexte.php';
include 'Conteneurs/ConteneurTypeInstitution.php';
include 'Conteneurs/ConteneurUtilisateur.php';
include 'Conteneurs/ConteneurVoter.php';*/
include 'AccesBD.php';

//La Classe
class Gestion{
  //Les Variables
  private $maBD;


  public function __construct(){
    $this->maBD = new AccesBD();
  }
}

 ?>
