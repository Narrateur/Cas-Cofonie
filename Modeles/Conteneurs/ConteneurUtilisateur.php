<?php
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
}
 ?>
