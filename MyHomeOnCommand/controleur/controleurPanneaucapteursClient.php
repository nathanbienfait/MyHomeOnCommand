<?php


if (!isset($_POST['tri']) || empty($_POST['tri']))
{
	$fonction = 'piece';
}
else
{
	$fonction=$_POST['tri'];
}

switch ($fonction)
{
	case 'piece' :
		$vue='panneaucontroleClient';
		$title='Vos capteurs';
		$entete= 'Les capteurs de votre domicile' . '' . $_SESSION['prenom'];
		$id_logements=Obtenir_id_logements($_SESSION['id']);
		break;

	case 'type_parametre' :
		$vue='panneaucontroleClientTrie';
		$title='Vos capteurs';
		$entete='Les capteurs de votre domicile' . '' . $_SESSION['prenom'];
		$idtypesEquipement=Obtenir_tous_id_type_equipement();
		break;
}

include('vue/' . $vue . '.php');
