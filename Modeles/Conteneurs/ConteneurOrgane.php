<?php 
include 'Modeles/Classes/ClasseOrgane.php';

class ConteneurOrgane{
    private $lesOrganes;

    public function __construct()
    {
        $this->lesOrganes = new ArrayObject();
    }

    public function ajouterOrgane($unCodeOrgane, $unLibOrgane, $unNombrePersonne){
        $unOrgane = new Organe($unCodeOrgane, $unLibOrgane, $unNombrePersonne);
        $this->lesOrganes->append($unOrgane);
    }

    public function listeDeroulanteOrgane(){
        $vretour = "<SELECT name = 'idOrgane'>";
        foreach($this->lesOrganes as $unOrgane){
            $vretour = $vretour."<OPTION value='".$unOrgane->getCodeOrgane()."'>".$unOrgane->getLibOrgane()."</OPTION>";
        }
        $vretour = $vretour."</SELECT>";
        return $vretour;
    }
}

?>