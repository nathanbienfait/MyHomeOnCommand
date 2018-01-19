<?php
class admin extends Connection
{
    public function getDonneeClient()
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT * FROM info_utilisateur NATURAL JOIN utilisateur');
        return $req;
    }

    public function modifDonneeClient($prenom,$nom,$email,$telephone,$statut, $id)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('UPDATE info_utilisateur SET prenom = :prenom, nom = :nom, email = :email, telephone = :telephone, statut_utilisateur = :statut WHERE id_utilisateur = :id');
        $req->execute(array(
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'telephone'=> $telephone,
            'statut' => $statut,
            'id' => $id
        ));

    }

    public function modifCompteClient($login,$id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE utilisateur SET login = :login WHERE id_utilisateur = :id');
        $req->execute(array(
            'login' => $login,
            'id' => $id
        ));

    }
    
 //Partie consommation
    public function getconsommationtemperatureadmin()
    {
        $db=$this->dbConnect();
        $reponse = $db-> query('SELECT donnees_equipement.id_equipement, donnees_equipement.temps, donnees_equipement.date_utilisation, equipement.id_equipement, donnees_equipement.valeur FROM donnees_equipement INNER JOIN equipement ON equipement.id_equipement = donnees_equipement.id_equipement WHERE equipement.id_type_equipement=1');
        return $reponse;        
    }

    public function getconsommationhumiditeadmin()
    {
        $db=$this->dbConnect();
        $reponse = $db-> query('SELECT donnees_equipement.id_equipement, donnees_equipement.date_utilisation, equipement.id_equipement, donnees_equipement.valeur FROM donnees_equipement INNER JOIN equipement ON equipement.id_equipement = donnees_equipement.id_equipement WHERE equipement.id_type_equipement=2');
        return $reponse;       
    }


    public function getconsommationlumiereadmin()
    {
        $db=$this->dbConnect();
        $reponse = $db-> query('SELECT donnees_equipement.id_equipement, donnees_equipement.temps, donnees_equipement.date_utilisation, equipement.id_equipement, relation_logement_utilisateur.id_utilisateur
            FROM donnees_equipement 
                INNER JOIN equipement ON equipement.id_equipement = donnees_equipement.id_equipement 
                INNER JOIN relation_piece_cemac ON relation_piece_cemac.id_cemac = equipement.id_cemac 
                INNER JOIN piece ON piece.id_piece = relation_piece_cemac.id_piece 
                INNER JOIN logement ON logement.id_logement = piece.id_logement 
                INNER JOIN relation_logement_utilisateur ON relation_logement_utilisateur.id_logement = logement.id_logement  
            WHERE donnees_equipement.valeur=1 and equipement.id_type_equipement=4');
        return $reponse;      
    }
}
