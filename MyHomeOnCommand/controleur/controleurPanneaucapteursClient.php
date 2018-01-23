<?php




if (!isset($_POST['tri']) || empty($_POST['tri'])) /* lorsqu'on arrive pour la premiere fois sur la page : */
{
	$fonction = 'piece';
}
else /* lorsqu'on a choisi un type de tri grace au formulaire de la page panneaucontroleClient(Trie) */
{
	$fonction=$_POST['tri'];
}

$panneau=new panneauControle; /* permettra d'utiliser les fonctions de la classe "panneauControle" definie dans le modelePanneaucapteursClient */

if(isset($_POST['id_equipement']) AND isset($_POST['valeur_cible'])) /* si on a choisi une nouvelle valeur cible pour nos equipements, l'enregistre dans la bdd */
{
	$panneau->MajValeurCible(htmlspecialchars($_POST['id_equipement']), htmlspecialchars($_POST['valeur_cible']));
}

switch ($fonction) /* selon le type de tri choisi, appelle la page correspondante */
{
	case 'piece' :

		$vue='panneaucontroleClient';
		$title='Vos capteurs';
		$id_logements=$panneau->Obtenir_id_logements(htmlspecialchars($_SESSION['id']));
		break;

	case 'type_parametre' :
		$vue='panneaucontroleClientTrie';
		$title='Vos capteurs';
		$compteType=0;
		$compteLogement=0;
		$idtypesEquipement=$panneau->Obtenir_tous_id_type_equipement();
		break;
}

include('vue/' . $vue . '.php');
