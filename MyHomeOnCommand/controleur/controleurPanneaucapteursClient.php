<?php


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
		$vue='panneaucontroleClient';
		$title='Vos capteurs';
		$entete= 'Les capteurs de votre domicile' . '' . $_SESSION['prenom'];
		$id_logements=Obtenir_id_logements($_SESSION['id']);
		break;

	case 'tri' :
		if (isset($_POST['tri']) || $_POST['tri']=='capteurs')
		{

		}
}

include('vue/' . $vue . '.php');
