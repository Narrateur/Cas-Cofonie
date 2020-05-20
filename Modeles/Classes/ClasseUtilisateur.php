<?php
class Utilisateur{
  private $code_user;
  private $nom_user;
  private $premon_user;
  private $login_user;
  private $password_user;
  private $code_institution;

  //CONSTUCTEUR
  public function __construct($unCodeUser, $unNomUser, $unPrenomUser, $unLoginUser, $unPasswordUser, $unCodeInstitution){
    $this->code_user = $unCodeUser;
    $this->nom_user = $unNomUser;
    $this->prenom_user = $unPrenomUser;
    $this->login_user = $unLoginUser;
    $this->password_user = $unPasswordUser;
    $this->code_institution = $unCodeInstitution;
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
  public function getCodeInstitution(){
    return $this->code_institution;
  }
}

 ?>
