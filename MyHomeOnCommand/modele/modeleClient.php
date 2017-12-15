<?php

class ajout
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
    
    private function dbConnect()
    {
       try
        {
            $db = new PDO('mysql:host=localhost;dbname=myhomeoncommand;charset=utf8', 'root', '');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        return $db;
    }
}

