<?php 
include 'Modeles/Classes/ClasseInstitution.php';

class ConteneurInstitution{
    private $lesInstitutions;

    public function __construct()
    {
        $this->lesInstitutions = new ArrayObject();
    }

    public function ajouterInstitution($codeInstitution, $nomInstitution, $typeInstitution){
        $uneInstitution = new Institution($codeInstitution, $nomInstitution, $typeInstitution);
        $this->lesInstitutions->append($uneInstitution);
    }

    public function listeDeroulanteInstitution(){
        $vretour = "<SELECT name = 'idInstitution'>";
        foreach($this->lesInstitutions as $uneInstitution){
            $vretour = $vretour."<OPTION value='".$uneInstitution->getCodeInstitution()."'>".$uneInstitution->getNomInstitution()."</OPTION>";
        }
        $vretour = $vretour."</SELECT>";
        return $vretour;
    }
}

?>