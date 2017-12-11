<?php
require('modele/modelePanneauCapteursClient.php');

if (!isset($_GET['fonction']) || empty($_GET['fonction']))
{
	$fonction = 'capteurs';
}
else
{
	$fonction=$_GET['fonction'];
}

switch ($fonction)
{
	case 'capteurs' :
		$vue='clientPanneauControle';
		$title='Vos capteurs';
		$entete= 'Les capteurs de votre domicile' . $_SESSION['prenom'];
		$id_utilisateur= Obtenir_id_utilisateur($_SESSION['prenom'], $_SESSION['mdp']);
		
		$id=$id_utilisateur->fetch();
		
		$logement= Obtenir_logement($id['id_utilisateur']);
		$piece= Obtenir_piece($logement['id_logement']);
		$cemac= Obtenir_cemac($piece['id_piece']);
		$equipement= Obtenir_equipement($cemac['id_cemac']);
		$donnees_equipement= Obtenir_donnees_equipement($equipement['id_equipement']);
		$type_equipement= Obtenir_type_equipement($equipement['id_equipement']);
		break;

	case 'tri' :
		if (isset($_POST['tri']) || $_POST['tri']=='capteurs')
		{

		}
}


include('vue/header.php');
include('vue/' . $vue . '.php');
include('vue/menuClient.php');
include('vue/footer.php');
