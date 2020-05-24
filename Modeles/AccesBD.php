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


  	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------INSERT------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function insertUtilisateur($nomUser, $prenomUser, $loginUser, $passwordUser, $codeOrgane){
		$requete = $this->connexion->prepare("INSERT INTO UTILISATEUR (nom_user,prenom_user,login_user,password_user,code_organe) VALUES(?,?,?,?,?)");
		$requete->bindValue(1,$nomUser);
		$requete->bindValue(2,$prenomUser);
		$requete->bindValue(3,$loginUser);
		$requete->bindValue(4,$passwordUser);
		$requete->bindValue(5,$codeOrgane);

		if(!$requete->execute()){
			die("Erreur dans insertUtilisateur : ".$requete->errorCode());
		}else{
			$sonId = $this->connexion->prepare("SELECT code_user FROM UTILISATEUR where nom_user=".$nomUser." AND prenom_user=".$prenomUser." AND login_user=".$loginUser." AND password_user=".$passwordUser);
			//if(!$sonId->execute())
			//{
				//die("Erreur dans returnUserId : ".$requete->errorCode());
			//}else{
				$data = $sonId->fetch(PDO::FETCH_ASSOC);
				//strcmp($data['code_user'], [string]);
				echo 'data '.$data;
				return $data;
				//return $sonId;
			//}
		}
	}

	public function insertTexte($titre_texte, $vote_final_texte, $promulgation_texte, $code_institution){
		$requete = $this->connexion->prepare("INSERT INTO TEXTE(titre_texte, vote_final_texte, promulgation_texte, code_institution) VALUES(?,?,?,?)");
		$requete->bindValue(1,$titre_texte);
		$requete->bindValue(2,$vote_final_texte);
		$requete->bindValue(3,$promulgation_texte);
		$requete->bindValue(4,$code_institution);

		if(!$requete->execute()){
			die("Erreur dans insertTexte : ".$requete->errorCode());
		}
	}

	public function insertArticle($code_article,$titre_article, $texte_article, $code_texte){
		$requete = $this->connexion->prepare("INSERT INTO ARTICLE(code_article, titre_article, texte_article, code_texte) VALUES(?,?,?,?)");
		$requete->bindValue(1,$code_article);
		$requete->bindValue(2,$titre_article);
		$requete->bindValue(3,$texte_article);
		$requete->bindValue(4,$code_texte);

		if(!$requete->execute()){
			die("Erreur dans insertArticle : ".$requete->errorCode());
		}
	}

	public function insertAmendement($code_amendement, $lib_amendement, $texte_amendement, $date_amendement, $code_article_ref, $code_texte_ref){
		$requete = $this->connexion->prepare("INSERT INTO AMENDEMENT(code_seq_amendement, lib_amendement, texte_amendement, date_amendement, code_article_ref, code_texte_ref) VALUES(?,?,?,?,?,?)");
		$requete->bindValue(1,$code_amendement);
		$requete->bindValue(2,$lib_amendement);
		$requete->bindValue(3,$texte_amendement);
		$requete->bindValue(4,$date_amendement);
		$requete->bindValue(5,$code_article_ref);
		$requete->bindValue(6,$code_texte_ref);

		if(!$requete->execute()){
			die("Erreur dans insertAmendement : ".$requete->errorCode());
		}
	}
  	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//------------------CHARGEMENT DES TABLES------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


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
			case 'VOTER':
				$stringQuery.='VOTER';
				break;
			default:
				die('Pas une table valide -> '.$uneTable);
				break;
		}
		return $stringQuery.";";
	}







}?>
