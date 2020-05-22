<?php
//commentage
class Utilisateur{
  private $code_user;
  private $nom_user;
  private $prenom_user;
  private $login_user;
  private $password_user;
  private $code_organe;

  //CONSTUCTEUR
  public function __construct($unCodeUser, $unNomUser, $unPrenomUser, $unLoginUser, $unPasswordUser, $unCodeOrgane){
    $this->code_user = $unCodeUser;
    $this->nom_user = $unNomUser;
    $this->prenom_user = $unPrenomUser;
    $this->login_user = $unLoginUser;
    $this->password_user = $unPasswordUser;
    $this->code_organe = $unCodeOrgane;
  }

  //GETTER
  public function getCodeUser(){
    return $this->code_user;
  }
  public function getNomUser(){
    return $this->nom_user;
  }
  public function getPrenomUser(){
    return $this->prenom_user;
  }
  public function getLoginUser(){
    return $this->login_user;
  }
  public function getPasswordUser(){
    return $this->password_user;
  }
  public function getCodeOrgane(){
    return $this->code_organe;
  }
}

 ?>
