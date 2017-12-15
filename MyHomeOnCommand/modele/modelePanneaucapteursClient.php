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

function Obtenir_type_equipement($id_equipement)
{
	$bdd=Ouvrir_BDD();
	$type_equipement = $bdd->prepare('SELECT * FROM type_equipement INNER JOIN equipement WHERE type_equipement.id_type_equipement = equipement.id_type_equipement AND equipement.id_equipement = ?');
	$type_equipement->execute(array($id_equipement));
	while($donnee=$type_equipement->fetch())
	{
		$info=$donnee['nom_type_equipement'];
	}
	$type_equipement->closeCursor();
	return $info;
}


function Obtenir_derniere_donnee_equipement($id_equipement)
{
	$bdd=Ouvrir_BDD();
	$donnees_equipement = $bdd->prepare('SELECT * FROM donnees_equipement WHERE id_equipement =? ORDER BY time DESC LIMIT 0,1');
	$donnees_equipement->execute(array($id_equipement));
	$info=null;
	$donnee=$donnees_equipement->fetch();
    $info=$donnee['valeur'];
	$donnees_equipement->closeCursor();
	
	return $info;
}

/*

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

*/

function Obtenir_id_logements($id_utilisateur)
{
	$bdd=Ouvrir_BDD();
	$req = $bdd->prepare(
		'SELECT * FROM logement
			INNER JOIN relation_logement_utilisateur
				ON logement.id_logement = relation_logement_utilisateur.id_logement
			WHERE relation_logement_utilisateur.id_utilisateur=:id_utilisateur'
		);
	$req->execute(array('id_utilisateur' => $id_utilisateur));

	$Logements_utilisateur = array();
	while($donnees = $req->fetch())
	{
		$Logements_utilisateur[] = $donnees['id_logement'];
	}
	$req->closeCursor();
	
	return $Logements_utilisateur;
}

function Obtenir_nom_logement($id_logement)
{
	$bdd=Ouvrir_BDD();
	$req = $bdd->prepare(
		'SELECT nom_logement FROM logement
			WHERE id_logement=:id_logement'
		);
	$req->execute(array('id_logement' => $id_logement));
	while($donnee=$req->fetch())
	{
		$info=$donnee['nom_logement'];
	}
	$req->closeCursor();
	return $info;
}

function Obtenir_id_pieces($id_logement)
{
	$bdd=Ouvrir_BDD();
	$req = $bdd->prepare(
		'SELECT * FROM piece WHERE id_logement=:id_logement'
		);
	$req->execute(array('id_logement' => $id_logement));

	$Pieces_logement = array();
	while($donnees = $req->fetch())
	{
		$Pieces_logement[] = $donnees['id_piece'];
	}
	$req->closeCursor();
	return $Pieces_logement;
}

function Obtenir_nom_piece($id_piece)
{
	$bdd=Ouvrir_BDD();
	$req = $bdd->prepare(
		'SELECT nom_piece FROM piece
			WHERE id_piece=:id_piece'
		);
	$req->execute(array('id_piece' => $id_piece));
	while($donnee=$req->fetch())
	{
		$info=$donnee['nom_piece'];
	}
	$req->closeCursor();
	return $info;
}

function Obtenir_id_equipements($id_piece)
{
	$bdd=Ouvrir_BDD();
	$req = $bdd->prepare(
		'SELECT * FROM equipement
			INNER JOIN cemac
				ON cemac.id_cemac = equipement.id_cemac
			INNER JOIN relation_piece_cemac
				ON relation_piece_cemac.id_cemac=cemac.id_cemac
			INNER JOIN piece
				ON piece.id_piece=relation_piece_cemac.id_piece
			WHERE piece.id_piece=:id_piece'
		);
	$req->execute(array('id_piece' => $id_piece));

	$equipements_piece = array();
	while($donnees = $req->fetch())
	{
		$equipements_piece[] = $donnees['id_equipement'];
        
	}
	$req->closeCursor();
	return $equipements_piece;
}