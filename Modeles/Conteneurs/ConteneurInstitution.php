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
}

?>