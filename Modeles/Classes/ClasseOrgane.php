<?php
class Organe{
    private $code_organe;
    private $lib_organe;
    private $nbr_pers_organe;

    public function __construct($unCodeOrgane, $unLibOrgane, $unNombrePersonne){
        $this->code_organe = $unCodeOrgane;
        $this->lib_organe = $unLibOrgane;
        $this->nbr_pers_organe = $unNombrePersonne;
    }

    public function getCodeOrgane(){
        return $this->code_organe;
    }
    public function getLibOrgane(){
        return $this->lib_organe;
    }
    public function getNbrPersonneOrgane(){
        return $this->nbr_pers_organe;
    }
}

?>