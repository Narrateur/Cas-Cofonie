


<?php
class AccesBD{
  //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------ATTRIBUTS PRIVES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private $PARAM_hote='DESKTOP-9DS3P7N\SQLEXPRESS'; // le chemin vers le serveur
  private $PARAM_utilisateur='admin'; // nom d'utilisateur pour se connecter
  private $PARAM_mot_passe='admin'; // mot de passe de l'utilisateur pour se connecter
  private $PARAM_nom_bd='CasCofoniePasteTheo';
  private $connexion;

  //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------CONSTRUCTEUR------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	function __construct() {
    try {
      $this->connexion = new PDO('sqlsrv:Server='.$this->PARAM_hote.';Database='.$this->PARAM_nom_bd, $this->PARAM_utilisateur, $this->PARAM_mot_passe);
			//$this->connection = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$serverName;Database=$db;", 'user', 'pass');
			//$this->connection = sqlsrv_connect($dbhost, array("Database" => $dbname, "UID" => "", "PWD" => ""));
    }catch(Exception $e){
      print 'Erreur : '.$e;
    }
  }

	public function loadTable($uneTable){
		$lesInfos=null;
		$nbTuples=0;
		$stringQuery="SELECT * FROM ";

		$stringQuery = $this->specialCase($stringQuery,$uneTable);
		$query = $this->connexion->prepare($stringQuery);

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





	public function specialCase($stringQuery,$uneTable){
		$uneTable = strtoupper($uneTable);
		switch ($uneTable)
		{
			case 'AMENDEMENT':
				$stringQuery.='AMENDEMENT';
				break;
			case 'ARTICLE':
				$stringQuery.='ARTICLE';
				break;
			case 'COMPRENDRE':
				$stringQuery.='COMPRENDRE';
				break;
			case 'DATE':
				$stringQuery.='DATE';
				break;
			case 'FAIRE_REFERENCE':
				$stringQuery.='FAIRE_REFERENCE';
				break;
			case 'INSTITUTION':
				$stringQuery.='INSTITUTION';
				break;
			case 'ORGANE':
				$stringQuery.='ORGANE';
				break;
			case 'ROLE':
				$stringQuery.='ROLE';
				break;
			case 'TEXTE':
				$stringQuery.='TEXTE';
				break;
			case 'TYPE_INSTITUTION':
				$stringQuery.='TYPE_INSTITUTION';
				break;
			case 'UTILISATEUR':
				$stringQuery.='UTILISATEUR';
				break;
			default:
				die('Pas une table valide -> '.$uneTable);
				break;
		}
		return $stringQuery.";";
	}







}?>
