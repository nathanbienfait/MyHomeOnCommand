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
		$id_logements=Obtenir_id_logements($_SESSION['id']);
		break;

	case 'type_parametre' :
		$vue='panneaucontroleClientTrie';
		$title='Vos capteurs';
		$compteType=0;
		$compteLogement=0;
		$idtypesEquipement=Obtenir_tous_id_type_equipement();
		break;
}

include('vue/' . $vue . '.php');
