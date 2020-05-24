<?php
//commentage
class Utilisateur{
  private $code_user;
  private $nom_user;
  private $prenom_user;
  private $login_user;
  private $password_user;
  private $code_organe;
  private $role_user;

  //CONSTUCTEUR
  public function __construct($unCodeUser, $unNomUser, $unPrenomUser, $unLoginUser, $unPasswordUser, $unCodeOrgane, $unrole){
    $this->code_user = str_replace(' ','',$unCodeUser) ;
    $this->nom_user = str_replace(' ','',$unNomUser);
    $this->prenom_user = str_replace(' ','',$unPrenomUser);
    $this->login_user = str_replace(' ','',$unLoginUser);
    $this->password_user = str_replace(' ','',$unPasswordUser);
    $this->code_organe = str_replace(' ','',$unCodeOrgane);
    $this->role_user = $unrole;
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
  public function getRoleUser(){
    return $this->role_user;
  }
}

 ?>
