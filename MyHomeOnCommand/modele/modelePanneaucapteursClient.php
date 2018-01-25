<?php
class panneauControle extends Connection
{
	public function Obtenir_type_equipement($id_equipement) /* obtient le nom d'un type d'équipement en fonction de son id */
	{
		$bdd=$this->dbConnect();
		$type_equipement = $bdd->prepare('SELECT * FROM type_equipement INNER JOIN equipement WHERE type_equipement.id_type_equipement = equipement.id_type_equipement AND equipement.id_equipement = ?');
		$type_equipement->execute(array($id_equipement));
		while($donnee=$type_equipement->fetch())
		{
			$info=$donnee['nom_type_equipement'];
		}
		$type_equipement->closeCursor();
		return $info;
	}


	public function Obtenir_derniere_donnee_equipement($id_equipement) /* obtient la dernière donnée reçue par un équipement */
	{
		$bdd=$this->dbConnect();
		$donnees_equipement = $bdd->prepare('SELECT * FROM donnees_equipement WHERE id_equipement =? ORDER BY id_donnees_equipement DESC LIMIT 0,1');
		$donnees_equipement->execute(array($id_equipement));
		$info=null;
		$donnee=$donnees_equipement->fetch();
    	$info=$donnee['valeur'];
		$donnees_equipement->closeCursor();
		return $info;
	}


	public function Obtenir_id_logements($id_utilisateur) /* crée un tableau contenant tous les id des logements d'un utilisateur */
	{
		$bdd=$this->dbConnect();
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

	public function Obtenir_nom_logement($id_logement) /* obtient le nom d'un logement en fonction de son id */
	{
		$bdd=$this->dbConnect();
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

	public function Obtenir_id_pieces($id_logement) /* crée un tableau contenant tous les id des pièces d'un logement */
	{
		$bdd=$this->dbConnect();
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

	public function Obtenir_nom_piece($id_piece) /* obtient le nom d'une pièce en fonction de son id */
	{
		$bdd=$this->dbConnect();
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

	public function Obtenir_id_equipements($id_piece) /* crée un tableau contenant tous les id des équipements d'une pièce */
	{
		$bdd=$this->dbConnect();
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

	public function Obtenir_tous_id_type_equipement() /* crée un tableau contenant tous les id de types d'équipement */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->query('SELECT id_type_equipement FROM type_equipement');

		$idtypesequipement = array();
		while($donnees = $req->fetch())
		{
			$idtypesequipement[] = $donnees['id_type_equipement'];
		}
		$req->closeCursor();
		return $idtypesequipement;
	}

	public function ObtenirTypeEquipementDepuisId($id_type_equipement) /* obtient le nom d'un type d'équipement en fonction de son id */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('SELECT nom_type_equipement FROM type_equipement WHERE id_type_equipement=?');
		$req->execute(array($id_type_equipement));
		while($donnees = $req->fetch())
		{
			$info = $donnees['nom_type_equipement'];
		}
		$req->closeCursor();
		return $info;
	}

	public function ObtenirIdTypeEquipementDepuisNom($nom_type_equipement) /* obtient l'id d'un type d'équipement en fonction de son nom */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('SELECT id_type_equipement FROM type_equipement WHERE nom_type_equipement=:nom_type_equipement');
		$req->execute(array('nom_type_equipement' => $nom_type_equipement));
		while($donnees = $req->fetch())
		{
			$id=$donnees['id_type_equipement'];
		}
		$req->closeCursor();
		return $id;
	}

	public function ObtenirEquipementsDunTypeEtLogement($id_type_equipement,$id_logement,$id_utilisateur) /* crée un tableau contenant tous les id des équipements d'un type en fonction du logement */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('
			SELECT * FROM equipement 
				INNER JOIN cemac
					ON equipement.id_cemac = cemac.id_cemac 
				INNER JOIN relation_piece_cemac
					ON cemac.id_cemac = relation_piece_cemac.id_cemac
				INNER JOIN piece
					ON piece.id_piece = relation_piece_cemac.id_piece
				INNER JOIN logement
					ON logement.id_logement = piece.id_logement
				INNER JOIN relation_logement_utilisateur
					ON logement.id_logement = relation_logement_utilisateur.id_logement
				WHERE logement.id_logement =:id_logement AND equipement.id_type_equipement =:id_type_equipement AND relation_logement_utilisateur.id_utilisateur =:id_utilisateur');
		$req->execute(array('id_type_equipement' => $id_type_equipement, 'id_logement' => $id_logement, 'id_utilisateur' => $id_utilisateur));

		$equipements = array();
		while($donnees = $req->fetch())
		{
			$equipements[]=$donnees['id_equipement'];
		}
		$req->closeCursor();
		return $equipements;
	}

	public function ObtenirLogementsAvecType($id_type_equipement, $id_utilisateur) /* on met dans un tableau tous les logements de l'utilisateur comportant le type d'équipement donné */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('
			SELECT * FROM relation_logement_utilisateur
				INNER JOIN logement
					ON logement.id_logement = relation_logement_utilisateur.id_logement
				INNER JOIN piece
					ON piece.id_logement = logement.id_logement
				INNER JOIN relation_piece_cemac
					ON piece.id_piece = relation_piece_cemac.id_piece
				INNER JOIN cemac
					ON cemac.id_cemac = relation_piece_cemac.id_cemac
				INNER JOIN equipement
					ON equipement.id_cemac = cemac.id_cemac
				INNER JOIN type_equipement
					ON type_equipement.id_type_equipement = equipement.id_type_equipement
				WHERE relation_logement_utilisateur.id_utilisateur =:id_utilisateur AND type_equipement.id_type_equipement =:id_type_equipement');
		$req->execute(array('id_utilisateur' => $id_utilisateur, 'id_type_equipement' => $id_type_equipement));

		$logements = array();
		while($donnees = $req->fetch())
		{
			if($donnees['id_logement'] != end($logements))
			{
				$logements[] = $donnees['id_logement'];
			}
		}
		$req->closeCursor();
		return $logements;
	}

	public function ObtenirPieceDeLequipement($id_equipement) /* obtient le nom de la pièce contenant l'équipement donné */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('
			SELECT * FROM piece
				INNER JOIN relation_piece_cemac
					ON piece.id_piece = relation_piece_cemac.id_piece
				INNER JOIN cemac
					ON cemac.id_cemac = relation_piece_cemac.id_cemac
				INNER JOIN equipement
					ON cemac.id_cemac = equipement.id_cemac
				WHERE equipement.id_equipement =:id_equipement');
		$req->execute(array('id_equipement' => $id_equipement));
		while($donnees = $req->fetch())
		{
			$info=$donnees['nom_piece'];
		}
		$req->closeCursor();
		return $info;
	}

	public function ObtenirEtatEquipement($id_equipement) /* détermine si un équipement fonctionne normalement ou non */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('SELECT etat FROM equipement WHERE id_equipement = :id_equipement');
		$req->execute(array('id_equipement' => $id_equipement));
		while($donnees = $req->fetch())
		{
			$etat=$donnees['etat'];
		}
		$req->closeCursor();
		return $etat;
	}

	public function MajValeurCible($id_equipement, $nouvelle_valeur_cible) /* met à jour la valeur cible d'un équipement */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('UPDATE equipement SET valeur_cible=:valeur_cible WHERE id_equipement=:id_equipement');
		$req->execute(array('valeur_cible' => $nouvelle_valeur_cible, 'id_equipement' => $id_equipement));
	}

	public function ObtenirImageTypeEquipement($id_type_equipement) /* obtient l'adresse de l'image de fond du type d'équipement */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('SELECT image_fond FROM type_equipement WHERE id_type_equipement=:id_type_equipement');
		$req->execute(array('id_type_equipement' => $id_type_equipement));
		while($donnees = $req->fetch())
		{
			$image=$donnees['image_fond'];
		}
		$req->closeCursor();
		return $image;
	}

	public function ObtenirLogoTypeEquipement($id_type_equipement) /* obtient l'adresse du logo du type d'équipement */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('SELECT logo FROM type_equipement WHERE id_type_equipement=:id_type_equipement');
		$req->execute(array('id_type_equipement' => $id_type_equipement));
		while($donnees = $req->fetch())
		{
			$logo=$donnees['logo'];
		}
		$req->closeCursor();
		return $logo;
	}

	public function ObtenirUniteTypeEquipement($id_type_equipement) /* obtient l'unité du type d'équipement */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('SELECT unite FROM type_equipement WHERE id_type_equipement=:id_type_equipement');
		$req->execute(array('id_type_equipement' => $id_type_equipement));
		while($donnees = $req->fetch())
		{
			$unite=$donnees['unite'];
		}
		$req->closeCursor();
		return $unite;
	}

	public function ObtenirTypeDonnees($id_type_equipement) /* obtient le type de données du type d'équipement */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('SELECT id_type_donnees FROM type_equipement WHERE id_type_equipement=:id_type_equipement');
		$req->execute(array('id_type_equipement' => $id_type_equipement));
		while($donnees = $req->fetch())
		{
			$id=$donnees['id_type_donnees'];
		}
		$req->closeCursor();
		return $id;
	}

	public function ObtenirMessageBas($id_type_equipement) /* obtient le message à afficher quand un type de capteurs aux données binaires est à l'état bas */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('SELECT message_etat_bas FROM type_equipement WHERE id_type_equipement=:id_type_equipement');
		$req->execute(array('id_type_equipement' => $id_type_equipement));
		while($donnees = $req->fetch())
		{
			$mess=$donnees['message_etat_bas'];
		}
		$req->closeCursor();
		return $mess;
	}

	public function ObtenirMessageHaut($id_type_equipement) /* obtient le message à afficher quand un type de capteurs aux données binaires est à l'état haut */
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('SELECT message_etat_haut FROM type_equipement WHERE id_type_equipement=:id_type_equipement');
		$req->execute(array('id_type_equipement' => $id_type_equipement));
		while($donnees = $req->fetch())
		{
			$mess=$donnees['message_etat_haut'];
		}
		$req->closeCursor();
		return $mess;
	}
	
	public function ObtenirNomEquipement($id_equipement)
	{
		$bdd=$this->dbConnect();
		$req = $bdd->prepare('SELECT nom_equipement FROM equipement WHERE id_equipement=:id_equipement');
		$req->execute(array('id_equipement' => $id_equipement));
		while($donnees = $req->fetch())
		{
			$nomEquipement=$donnees['nom_equipement'];
		}
		$req->closeCursor();
		return $nomEquipement;
	}
}
