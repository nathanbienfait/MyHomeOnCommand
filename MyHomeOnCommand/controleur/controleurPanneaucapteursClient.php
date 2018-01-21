<?php


if (!isset($_POST['tri']) || empty($_POST['tri']))
{
	$fonction = 'piece';
}
else
{
	$fonction=$_POST['tri'];
}

if(isset($_POST['id_equipement']) AND isset($_POST['valeur_cible']))
{
	MajValeurCible(htmlspecialchars($_POST['id_equipement']), htmlspecialchars($_POST['valeur_cible']));
}

switch ($fonction)
{
	case 'piece' :

		$vue='panneaucontroleClient';
		$title='Vos capteurs';
		$id_logements=Obtenir_id_logements(htmlspecialchars($_SESSION['id']));
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
