<?php

session_start();
//include du fichier CONTROLEUR
include 'Controleur.php';
//SI le controleur n'existe pas dꫠ, on l'instancie
	if (!isset ($_SESSION['Controleur']))
	{
	$monControleur = new Controleur();
	//$_SESSION['Controleur'] = serialize($monControleur);
	}
	else
	{
	//$monControleur = unserialize($_SESSION['Controleur']);
	}

 ?>
