<?php

class ajout extends Connection
{
    public function ajoutLogement($nom,$rue,$ville,$cp,$pays)
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

    public function getIdNewLogement()
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT MAX(id_logement) FROM logement');
        return $req;
    }

    public function ajoutRelLogementClient($idClient,$idLogement)
    {

        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO relation_logement_utilisateur(id_logement, id_utilisateur) VALUES(:idLog, :idUtil)');
        $req->execute(array(
            'idLog' => $idLogement,
            'idUtil' => $idClient
	));
    }


    public function getNomLogements($idClient)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT id_logement,nom_logement FROM logement NATURAL JOIN relation_logement_utilisateur WHERE id_utilisateur = :id');
        $req->execute(array(
            'id' => $idClient
        ));
        return $req;
    }

    public function getNomPiece($idClient)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT piece.*, logement.*, relation_logement_utilisateur.* FROM piece JOIN logement ON piece.id_logement = logement.id_logement JOIN relation_logement_utilisateur ON relation_logement_utilisateur.id_logement = logement.id_logement WHERE relation_logement_utilisateur.id_utilisateur= :id');
        $req->execute(array(
            'id' => $idClient
        ));
        return $req;

    }

    public function ajoutPiece($idLogement,$nomPiece)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO piece(nom_piece, id_logement) VALUES(:nomPiece, :idLog)');
        $req->execute(array(
            'nomPiece' => $nomPiece,
            'idLog' => $idLogement
	   ));
    }

    public function ajoutCemac($nomCemac)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO cemac(nom_cemac) VALUES(:nomCemac)');
        $req->execute(array(
            'nomCemac' => $nomCemac
        ));
    }

    public function getIdNewCemac()
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT MAX(id_cemac) FROM cemac');
        return $req;
    }

    public function ajoutRelPieceCemac($idPiece,$idCemac)
    {

        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO relation_piece_cemac(id_piece, id_cemac) VALUES(:idPiece, :idCemac)');
        $req->execute(array(
            'idPiece' => $idPiece,
            'idCemac' => $idCemac
	));
    }

    public function getNomCemac($idClient)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT cemac.*, relation_piece_cemac.*, piece.*, logement.*, relation_logement_utilisateur.* FROM cemac JOIN relation_piece_cemac ON cemac.id_cemac = relation_piece_cemac.id_cemac JOIN piece ON relation_piece_cemac.id_piece = piece.id_piece JOIN logement ON piece.id_logement = logement.id_logement JOIN relation_logement_utilisateur ON relation_logement_utilisateur.id_logement = logement.id_logement WHERE relation_logement_utilisateur.id_utilisateur= :id');
        $req->execute(array(
            'id' => $idClient
        ));
        return $req;

    }

    public function getNomType()
    {
        $db=$this->dbConnect();
        $req= $db->query('SELECT * FROM type_equipement');
        return $req;
    }
    
    public function getNomEquipement($idClient)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT equipement.*, cemac.*, relation_piece_cemac.*, piece.*, logement.*, relation_logement_utilisateur.* FROM equipement JOIN cemac ON equipement.id_cemac=cemac.id_cemac JOIN relation_piece_cemac ON cemac.id_cemac = relation_piece_cemac.id_cemac JOIN piece ON relation_piece_cemac.id_piece = piece.id_piece JOIN logement ON piece.id_logement = logement.id_logement JOIN relation_logement_utilisateur ON relation_logement_utilisateur.id_logement = logement.id_logement WHERE relation_logement_utilisateur.id_utilisateur= :id');
        $req->execute(array(
            'id' => $idClient
        ));
        return $req;
    }

    public function ajoutEquipement($idCemac,$idType,$nomEquipement)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO equipement(id_cemac, id_type_equipement, nom_equipement) VALUES(:idCemac, :idType, :nom)');
        $req->execute(array(
            'idCemac' => $idCemac,
            'idType' => $idType,
            'nom' => $nomEquipement
	   ));
    }
    
    public function modifNomLogement($id,$nom)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE logement SET nom_logement = :nom WHERE id_logement = :id');
        $req->execute(array(
            'nom' => $nom,
            'id' => $id
        ));
    }
    
    public function modifNomPiece($id,$nom)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE piece SET nom_piece = :nom WHERE id_piece = :id');
        $req->execute(array(
            'nom' => $nom,
            'id' => $id
        ));
    }
    
    public function modifNomCemac($id,$nom)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE cemac SET nom_cemac = :nom WHERE id_cemac = :id');
        $req->execute(array(
            'nom' => $nom,
            'id' => $id
        ));   
    }
    
    public function modifNomEquipement($id,$nom)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE equipement SET nom_equipement = :nom WHERE id_equipement = :id');
        $req->execute(array(
            'nom' => $nom,
            'id' => $id
        )); 
    }
	public function supprEquip($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM equipement WHERE id_equipement = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    public function supprDonneeEquip($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM donnees_equipement WHERE id_equipement = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    public function getIdEquipDeCemac($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('SELECT id_equipement FROM equipement WHERE id_cemac = :id');
        $req->execute(array(
            'id'=>$id
            ));
        return $req;
    }
    
    public function supprCemac($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM cemac WHERE id_cemac = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    public function supprRelCemacPiece($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM relation_piece_cemac WHERE id_cemac = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    
    public function getIdCemacDePiece($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('SELECT id_cemac FROM relation_piece_cemac WHERE id_piece = :id');
        $req->execute(array(
            'id'=>$id
            ));
        return $req;
    }
    
    public function supprPiece($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM piece WHERE id_piece = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    
    public function getIdPieceDeLogement($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('SELECT id_piece FROM piece WHERE id_logement = :id');
        $req->execute(array(
            'id'=>$id
            ));
        return $req;
    }
    public function supprLogement($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM logement WHERE id_logement = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    
    public function supprRelLogementUtil($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM relation_logement_utilisateur WHERE id_logement = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
	public function supprClient($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM utilisateur WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    public function supprInfoClient($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM info_utilisateur WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
        ));
    }
    public function getIdRelQRClient($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('SELECT id_qr FROM relation_utilisateur_qr WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
            ));
        return $req;
    }
    public function supprimerQR($id)
    {
       $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM qr WHERE id_qr = :id');
        $req->execute(array(
            'id'=>$id
        )); 
    }
    public function supprRelQRClient($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM relation_utilisateur_qr WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
        )); 
    }
    public function getIdRelLogClient($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('SELECT id_logement FROM relation_logement_utilisateur WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
            ));
        return $req;
    }
    public function supprRelLogClient($id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM relation_logement_utilisateur WHERE id_utilisateur = :id');
        $req->execute(array(
            'id'=>$id
        )); 
    }

    
}
