<?php
//commentage
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

	if ((isset($_GET['vue'])) && (isset($_GET['action'])) ){$monControleur->affichePage($_GET['action'],$_GET['vue']);}

	//$monControleur->afficheEntete();
	$monControleur->afficherMenu();
 ?>
