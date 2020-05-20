


<?php
class AccesBD{
  //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------ATTRIBUTS PRIVES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private $PARAM_hote='DESKTOP-9DS3P7N\SQLEXPRESS'; // le chemin vers le serveur
  private $PARAM_utilisateur='admin'; // nom d'utilisateur pour se connecter
  private $PARAM_mot_passe='admin'; // mot de passe de l'utilisateur pour se connecter
  private $PARAM_nom_bd='CasCofonie';
  private $connexion;

  //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------CONSTRUCTEUR------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	function __construct() {
    try {
      $this->connexion = new PDO('sqlsrv:Server='.$this->PARAM_hote.';Database='.$this->PARAM_nom_bd, $this->PARAM_utilisateur, $this->PARAM_mot_passe);
			//$this->connection = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$serverName;Database=$db;", 'user', 'pass');
			//$this->connection = sqlsrv_connect($dbhost, array("Database" => $dbname, "UID" => "", "PWD" => ""));
    }catch(Exeption $e){
      print 'Erreur : '+$e;
    }
  }

	public function loadTable($uneTable){
		$lesInfos=null;
		$nbTuples=0;
		$stringQuery="SELECT * FROM ";

		$stringQuery = $this->specialCase($stringQuery,$uneTable);
		$query = $this->conn->prepare($stringQuery);

		if($query->execute())
		{
			while($row = $query->fetch(PDO::FETCH_NUM))
			{
				$lesInfos[$nbTuples] = $row;
				$nbTuples++;
			}
		}
		else
		{
			die('Problème dans chargement : '.$query->errorCode());
		}

		return $lesInfos;
	}

}





?>
