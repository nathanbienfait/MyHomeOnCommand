<?php
class admin extends Connection
{
    public function getDonneeClient()//récupère toutes les infos de chaque utilisateur en rejoignant deux table: utilisateur et info_utilisateur
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT * FROM info_utilisateur NATURAL JOIN utilisateur');
        return $req;
    }

    public function modifDonneeClient($prenom,$nom,$email,$telephone,$statut, $id)//modifie les informations d'un client
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

    public function modifCompteClient($login,$id)//modifie l'identifiant d'un utilisateur
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
    public function Obtenir_tous_id_type_equipement() /* crée un tableau contenant l'ensemble des id de type d'équipement */
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT id_type_equipement FROM type_equipement');
        $idtypesequipement = array();
        while($donnees = $req->fetch())
        {
            $idtypesequipement[] = $donnees['id_type_equipement'];
        }
        $req->closeCursor();
        return $idtypesequipement;
    }

    public function ObtenirTypeEquipementDepuisId($id_type_equipement) /* obtient le nom du type d'équipement à partir de l'id */
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT nom_type_equipement FROM type_equipement WHERE id_type_equipement=?');
        $req->execute(array($id_type_equipement));
        while($donnees = $req->fetch())
        {
        $info = $donnees['nom_type_equipement'];
        }
        $req->closeCursor();
        return $info;
    }

    public function ObtenirTypeDonnees($id_type_equipement) /* cherche si un type d'équipement a des valeurs binaires ou non */
    {
        $db =$this->dbConnect();
        $req = $db->prepare('SELECT id_type_donnees FROM type_equipement WHERE id_type_equipement=:id_type_equipement');
        $req->execute(array('id_type_equipement' => $id_type_equipement));
        while($donnees = $req->fetch())
        {
            $id=$donnees['id_type_donnees'];
        }
        $req->closeCursor();
        return $id;
    }

    public function modifTypeEquipement($idTypeCapteur, $caracEquipement, $nouvelleCarac) /* modifie les caractéristiques d'un type d'équipement dans la bdd */
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE type_equipement SET ' . htmlspecialchars($caracEquipement) . '=:nouvelleCarac WHERE id_type_equipement=:idTypeCapteur');
        $req->execute(array('nouvelleCarac' => $nouvelleCarac, 'idTypeCapteur' => $idTypeCapteur));
        $req->closeCursor();
    }

    public function suppTypeEquipement($idTypeEquipement) /* supprime un type d'équipement de la bdd */
    {
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM type_equipement WHERE id_type_equipement=:idTypeEquipement');
        $req->execute(array('idTypeEquipement' => $idTypeEquipement));
        $req->closeCursor();
    }

    public function ajoutEquipement($equipement, $unite, $type_donnees, $adresseLogo, $adresseImageFond, $messageEtatHaut, $messageEtatBas) /* ajoute un nouveau type d'équipement dans la bdd */
    {
        $db=$this->dbConnect();
        $req=$db->prepare ('INSERT INTO type_equipement(nom_type_equipement, unite, id_type_donnees, logo, image_fond, message_etat_haut, message_etat_bas) VALUES (:equipement, :unite, :type_donnees, :logo, :image_fond, :message_etat_haut, :message_etat_bas)');
        $req->execute(array('equipement' => $equipement, 'unite' => $unite, 'type_donnees' => $type_donnees, 'logo' => $adresseLogo, 'image_fond' => $adresseImageFond, 'message_etat_haut' => $messageEtatHaut, 'message_etat_bas' => $messageEtatBas));
        return $req;
    }
}
