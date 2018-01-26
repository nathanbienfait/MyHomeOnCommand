<?php

class ajout extends Connection
{
    public function ajoutLogement($nom,$rue,$ville,$cp,$pays)//ajoute un logement
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO logement(nom_logement, rue, ville, code_postal, pays) VALUES(:nom, :rue, :ville, :cp, :pays)');
        $req->execute(array(
            'nom' => $nom,
            'rue' => $rue,
            'ville' => $ville,
            'cp' => $cp,
            'pays' => $pays
	));
    }

    public function getIdNewLogement()//récupère l'id du dernier logement créé
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT MAX(id_logement) FROM logement');
        return $req;
    }

    public function ajoutRelLogementClient($idClient,$idLogement)//crée un relation entre un logement et un utilisateur
    {

        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO relation_logement_utilisateur(id_logement, id_utilisateur) VALUES(:idLog, :idUtil)');
        $req->execute(array(
            'idLog' => $idLogement,
            'idUtil' => $idClient
	));
    }


    public function getNomLogements($idClient)//récupère tous les logements d'un utilisateur
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT id_logement,nom_logement FROM logement NATURAL JOIN relation_logement_utilisateur WHERE id_utilisateur = :id');
        $req->execute(array(
            'id' => $idClient
        ));
        return $req;
    }

    public function getNomPiece($idClient)//récupère toutes les pièces d'un utilisateur
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT piece.*, logement.*, relation_logement_utilisateur.* FROM piece JOIN logement ON piece.id_logement = logement.id_logement JOIN relation_logement_utilisateur ON relation_logement_utilisateur.id_logement = logement.id_logement WHERE relation_logement_utilisateur.id_utilisateur= :id');
        $req->execute(array(
            'id' => $idClient
        ));
        return $req;

    }

    public function ajoutPiece($idLogement,$nomPiece)//permet d'ajouter une pièce à un logement 
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO piece(nom_piece, id_logement) VALUES(:nomPiece, :idLog)');
        $req->execute(array(
            'nomPiece' => $nomPiece,
            'idLog' => $idLogement
	   ));
    }

    public function ajoutCemac($nomCemac)//permet d'ajouter un cemac à une pièce
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO cemac(nom_cemac) VALUES(:nomCemac)');
        $req->execute(array(
            'nomCemac' => $nomCemac
        ));
    }

    public function getIdNewCemac()//récupère l'id du dernier cemac créé
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT MAX(id_cemac) FROM cemac');
        return $req;
    }

    public function ajoutRelPieceCemac($idPiece,$idCemac)//ajoute une relation entre un cemac et une piece
    {

        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO relation_piece_cemac(id_piece, id_cemac) VALUES(:idPiece, :idCemac)');
        $req->execute(array(
            'idPiece' => $idPiece,
            'idCemac' => $idCemac
	));
    }

    public function getNomCemac($idClient)//récupère tous les cemacs d'un utilisateur
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT cemac.*, relation_piece_cemac.*, piece.*, logement.*, relation_logement_utilisateur.* FROM cemac JOIN relation_piece_cemac ON cemac.id_cemac = relation_piece_cemac.id_cemac JOIN piece ON relation_piece_cemac.id_piece = piece.id_piece JOIN logement ON piece.id_logement = logement.id_logement JOIN relation_logement_utilisateur ON relation_logement_utilisateur.id_logement = logement.id_logement WHERE relation_logement_utilisateur.id_utilisateur= :id');
        $req->execute(array(
            'id' => $idClient
        ));
        return $req;

    }

    public function getNomType()//récupère les types d'équipements disponibles
    {
        $db=$this->dbConnect();
        $req= $db->query('SELECT * FROM type_equipement');
        return $req;
    }
    
    public function getNomEquipement($idClient)//récupère tous les équipements d'un utilisateur
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT equipement.*, cemac.*, relation_piece_cemac.*, piece.*, logement.*, relation_logement_utilisateur.* FROM equipement JOIN cemac ON equipement.id_cemac=cemac.id_cemac JOIN relation_piece_cemac ON cemac.id_cemac = relation_piece_cemac.id_cemac JOIN piece ON relation_piece_cemac.id_piece = piece.id_piece JOIN logement ON piece.id_logement = logement.id_logement JOIN relation_logement_utilisateur ON relation_logement_utilisateur.id_logement = logement.id_logement WHERE relation_logement_utilisateur.id_utilisateur= :id');
        $req->execute(array(
            'id' => $idClient
        ));
        return $req;
    }

    public function ajoutEquipement($idCemac,$idType,$nomEquipement)//Ajoute un équipement à un cemac
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO equipement(id_cemac, id_type_equipement, nom_equipement) VALUES(:idCemac, :idType, :nom)');
        $req->execute(array(
            'idCemac' => $idCemac,
            'idType' => $idType,
            'nom' => $nomEquipement
	   ));
    }
    
    public function modifNomLogement($id,$nom)//permet de modifier le nom d'un logement
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE logement SET nom_logement = :nom WHERE id_logement = :id');
        $req->execute(array(
            'nom' => $nom,
            'id' => $id
        ));
    }
    
    public function modifNomPiece($id,$nom)//permet de modifier le nom d'une pièce
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE piece SET nom_piece = :nom WHERE id_piece = :id');
        $req->execute(array(
            'nom' => $nom,
            'id' => $id
        ));
    }
    
    public function modifNomCemac($id,$nom)//permet de modifier le nom d'un cemac
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE cemac SET nom_cemac = :nom WHERE id_cemac = :id');
        $req->execute(array(
            'nom' => $nom,
            'id' => $id
        ));   
    }
    
    public function modifNomEquipement($id,$nom)//permet de modifier le nom d'un équipement
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE equipement SET nom_equipement = :nom WHERE id_equipement = :id');
        $req->execute(array(
            'nom' => $nom,
            'id' => $id
        )); 
    }
	public function supprEquip($id)//supprime un équipement
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM equipement WHERE id_equipement = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    public function supprDonneeEquip($id)//supprime les données d'un équipement
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM donnees_equipement WHERE id_equipement = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    public function getIdEquipDeCemac($id)//récupère l'id de tous les équipements d'un cemac
    {
        $db=$this->dbConnect();
        $req=$db->prepare('SELECT id_equipement FROM equipement WHERE id_cemac = :id');
        $req->execute(array(
            'id'=>$id
            ));
        return $req;
    }
    
    public function supprCemac($id)//supprime un cemac
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM cemac WHERE id_cemac = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    public function supprRelCemacPiece($id)//supprime la relation entre un cemac et une pièce
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM relation_piece_cemac WHERE id_cemac = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    
    public function getIdCemacDePiece($id)//récupère l'id de tous les cemacs d'une pièce
    {
        $db=$this->dbConnect();
        $req=$db->prepare('SELECT id_cemac FROM relation_piece_cemac WHERE id_piece = :id');
        $req->execute(array(
            'id'=>$id
            ));
        return $req;
    }
    
    public function supprPiece($id)//supprime une pièce
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM piece WHERE id_piece = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    
    public function getIdPieceDeLogement($id)//récupère l'id de toutes les pièces d'un logement
    {
        $db=$this->dbConnect();
        $req=$db->prepare('SELECT id_piece FROM piece WHERE id_logement = :id');
        $req->execute(array(
            'id'=>$id
            ));
        return $req;
    }
    public function supprLogement($id)//supprime un logement
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM logement WHERE id_logement = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    
    public function supprRelLogementUtil($id)//supprime la relation entre un logement et un utilisateur
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM relation_logement_utilisateur WHERE id_logement = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
	public function supprClient($id)//suppirme un utilisateur
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM utilisateur WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    public function supprInfoClient($id)//supprime les infos d'un utilisateur
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM info_utilisateur WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    public function getIdRelQRClient($id)//récupère l'id de chaque question d'un client
    {
        $db=$this->dbConnect();
        $req=$db->prepare('SELECT id_qr FROM relation_utilisateur_qr WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
            ));
        return $req;
    }
    public function supprimerQR($id)//supprime une question
    {
       $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM qr WHERE id_qr = :id');
        $req->execute(array(
            'id'=>$id
        )); 
    }
    public function supprRelQRClient($id)//supprime une relation entre une question et un utilisateur
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM relation_utilisateur_qr WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
        )); 
    }
    public function getIdRelLogClient($id)//recupere l'id des logements d'un client
    {
        $db=$this->dbConnect();
        $req=$db->prepare('SELECT id_logement FROM relation_logement_utilisateur WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
            ));
        return $req;
    }
    public function supprRelLogClient($id)//supprime la relation entre un logement et un client
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM relation_logement_utilisateur WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
        )); 
    }
   
}

class clientconsommation extends Connection
{
        //Partie consommation

    public function getconsommationtemperatureclient()
    {
        $db=$this->dbConnect();
        $reponse = $db-> query('SELECT donnees_equipement.id_equipement, donnees_equipement.temps, donnees_equipement.date_utilisation, equipement.id_equipement, donnees_equipement.valeur, relation_logement_utilisateur.id_utilisateur, utilisateur.login  
            FROM donnees_equipement 
                INNER JOIN equipement ON equipement.id_equipement = donnees_equipement.id_equipement
                INNER JOIN relation_piece_cemac ON relation_piece_cemac.id_cemac = equipement.id_cemac 
                INNER JOIN piece ON piece.id_piece = relation_piece_cemac.id_piece 
                INNER JOIN logement ON logement.id_logement = piece.id_logement 
                INNER JOIN relation_logement_utilisateur ON relation_logement_utilisateur.id_logement = logement.id_logement 
                INNER JOIN utilisateur ON utilisateur.id_utilisateur = relation_logement_utilisateur.id_utilisateur  
            WHERE equipement.id_type_equipement=1');
        return $reponse;        
    }

    public function getconsommationhumiditeclient()
    {
        $db=$this->dbConnect();
        $reponse = $db-> query('SELECT donnees_equipement.id_equipement, donnees_equipement.date_utilisation, equipement.id_equipement, donnees_equipement.valeur, relation_logement_utilisateur.id_utilisateur, utilisateur.login 
            FROM donnees_equipement
                INNER JOIN equipement ON equipement.id_equipement = donnees_equipement.id_equipement 
                INNER JOIN relation_piece_cemac ON relation_piece_cemac.id_cemac = equipement.id_cemac 
                INNER JOIN piece ON piece.id_piece = relation_piece_cemac.id_piece 
                INNER JOIN logement ON logement.id_logement = piece.id_logement 
                INNER JOIN relation_logement_utilisateur ON relation_logement_utilisateur.id_logement = logement.id_logement 
                INNER JOIN utilisateur ON utilisateur.id_utilisateur = relation_logement_utilisateur.id_utilisateur 
            WHERE equipement.id_type_equipement=2');
        return $reponse;       
    }


    public function getconsommationlumiereclient()
    {
        $db=$this->dbConnect();
        $reponse = $db-> query('SELECT donnees_equipement.id_equipement, donnees_equipement.temps, donnees_equipement.date_utilisation, equipement.id_equipement, relation_logement_utilisateur.id_utilisateur, utilisateur.login
            FROM donnees_equipement 
                INNER JOIN equipement ON equipement.id_equipement = donnees_equipement.id_equipement 
                INNER JOIN relation_piece_cemac ON relation_piece_cemac.id_cemac = equipement.id_cemac 
                INNER JOIN piece ON piece.id_piece = relation_piece_cemac.id_piece 
                INNER JOIN logement ON logement.id_logement = piece.id_logement 
                INNER JOIN relation_logement_utilisateur ON relation_logement_utilisateur.id_logement = logement.id_logement 
                INNER JOIN utilisateur ON utilisateur.id_utilisateur = relation_logement_utilisateur.id_utilisateur 
            WHERE donnees_equipement.valeur=1 and equipement.id_type_equipement=4');
        return $reponse;      
    }
}
