<?php
function Ouvrir_BDD() 
{
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=myhomeoncommand;charset=utf8','root','');
		return $bdd;
	}
	catch (Exception $e)
	{
		die('Erreur : ' .$e->getmessage());
	}
}

function Obtenir_id_utilisateur($login, $password)
{
	$bdd=Ouvrir_BDD();
	$id_utilisateur = $bdd->prepare('SELECT id_utilisateur FROM utilisateur WHERE password = ? and login = ?');
	$id_utilisateur->execute(array($password, $login));
	return $id_utilisateur;
}

function Obtenir_utilisateur($login, $password)
{
	$bdd=Ouvrir_BDD();
	$utilisateur = $bdd->prepare('SELECT * FROM utilisateur WHERE password = ? and login = ?');
	$utilisateur->execute(array($password, $login));
	return $utilisateur->fetch();
}

function Obtenir_logement($id_utilisateur)
{	
	$bdd=Ouvrir_BDD();
	$logement = $bdd->prepare('SELECT * FROM relation_logement_utilisateur WHERE id_utilisateur= ?');
	$logement->execute(array($id_utilisateur));
	return $logement->fetch();
}

function Obtenir_piece($id_logement)
{	
	$bdd=Ouvrir_BDD();
	$piece = $bdd->prepare('SELECT * FROM relation_logement_utilisateur WHERE id_utilisateur= ?');
	$piece->execute(array($id_logement));
	return $piece->fetch();
}

function Obtenir_cemac($id_piece)
{	
	$bdd=Ouvrir_BDD();
	$cemac = $bdd->prepare('SELECT * FROM relation_piece_cemac WHERE id_piece =?');
	$cemac->execute(array($id_piece));
	return $cemac->fetch();
}

function Obtenir_equipement($id_cemac)
{
	$bdd=Ouvrir_BDD();
	$equipement = $bdd->prepare('SELECT * FROM equipement WHERE id_cemac =?');
	$equipement->execute(array($id_cemac));
	return $equipement->fetch();
}

function Obtenir_type_equipement($id_equipement)
{
	$bdd=Ouvrir_BDD();
	$type_equipement = $bdd->prepare('SELECT * FROM type_equipement INNER JOIN equipement WHERE type_equipement.id_type_equipement = equipement.id_type_equipement AND equipement.id_equipement = ?');
	$type_equipement->execute(array($id_equipement));
	return $type_equipement->fetch();
}

function Obtenir_donnees_equipement($id_equipement)
{
	$bdd=Ouvrir_BDD();
	$donnees_equipement = $bdd->prepare('SELECT * FROM donnees_equipement WHERE id_equipement =? ORDER BY temps DESC LIMIT 0,0');
	$donnees_equipement->execute(array($id_equipement));
	return $donnees_equipement->fetch();
}

function Trier_capteurs($tri, $table)
{
	$bdd=Ouvrir_BDD();
	$donnees_triees = $bdd->prepare('SELECT * FROM :table ORDER BY :tri');
	$donnees_triees->execute(array(
		'table' => $table,
		'tri' => $tri
		));
	return $donnees_triees;  //je sais pas ....
}