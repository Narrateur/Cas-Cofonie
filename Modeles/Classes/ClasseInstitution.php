<?php
class Institution{
    private $code_institution;
    private $nom_institution;
    private $type_institution;

    public function __construct($codeInstitution, $nomInstitution, $typeInstitution){
        $this->nom_institution = $codeInstitution;
        $this->nom_institution = $nomInstitution;
        $this->type_institution = $typeInstitution;
    }

    public function getCodeInstitution(){
        return $this->code_institution;
    }
    public function getNomInstitution(){
        return $this->nom_institution;
    }
    public function getTypeInstitution(){
        return $this->type_institution;
    }
}
?>