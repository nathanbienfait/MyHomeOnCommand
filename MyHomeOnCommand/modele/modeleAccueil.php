<?php
class Connection
{
    protected function dbConnect()
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
class LoginUtilisateur extends Connection
{
    
    public function getAuthentification()
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT id_utilisateur, login, password, id_type_utilisateur FROM utilisateur');
        return $req;
    }
    
    public function getInfoUtilisateur($idUtil)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT prenom, nom, email, telephone, statut_utilisateur, id_utilisateur FROM info_utilisateur WHERE id_utilisateur = :id');
        $req->execute(array('id' => $idUtil));
        return $req;
    }
    public function verifMail()
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT email FROM info_utilisateur');
        return $req;
    }
    public function getClef($mail)
    {
        $db =$this->dbConnect();
        $reqToken =$db->prepare('SELECT token FROM info_utilisateur WHERE email = :mail');
        $reqToken->execute(array('mail' => $mail));
        return $reqToken;
    }
    
    
    
}

class InscriptionUtilisateur extends Connection
{
    
    public function setUtilisateur($pseudo,$mp)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO utilisateur(login, password, id_type_utilisateur) VALUES(:log, :mdp, :id_type)');
        $req->execute(array(
            'log' => $pseudo,
            'mdp' => $mp,
            'id_type' => 3
	));

    }

    public function setInfoUtilisateur($prenom,$nom,$email,$telephone,$statut,$id,$clef)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO info_utilisateur(prenom, nom, email, telephone, statut_utilisateur, id_utilisateur,token) VALUES(:prenom, :nom, :email, :telephone, :statut, :idutil, :token)');
        $req->execute(array(
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'telephone' => $telephone,
            'statut' => $statut,
            'idutil' => $id,
	    'token' => $clef
	));
    }
    
    public function getLoginUtilisateurs()
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT login FROM utilisateur');
        return $req;
    }
    
    public function getIdUtilisateur($log)
    {
       
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT id_utilisateur FROM utilisateur WHERE login = :log');
        $req->execute(array('log' => $log));
       
        return $req;
    }
     public function getSlogan()
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT contenu_slogan FROM slogan');
        return $req; 
     }	
	
	public function getPres()
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT contenu_presentation FROM presentation');
        return $req; 
     }
	
      public function getCond()
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT contenu_conditions_utilisation FROM conditions_utilisation');
        return $req; 
     }
	
    public function modifSlogan($slog)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE slogan SET contenu_slogan = :Modifier_le_slogan WHERE id_slogan = 1');
        $req->execute(array('Modifier_le_slogan' => $slog ));
        return $req;
    }

    public function ajoutEquipement($equipement, $unite, $type_donnees, $adresseLogo, $adresseImageFond)
    {
        $db=$this->dbConnect();
        $req=$db->prepare ('INSERT INTO type_equipement(nom_type_equipement, unite, id_type_donnees, logo, image_fond) VALUES (:equipement, :unite, :type_donnees, :logo, :image_fond)');
        $req->execute(array('equipement' => $equipement, 'unite' => $unite, 'type_donnees' => $type_donnees, 'logo' => $adresseLogo, 'image_fond' => $adresseImageFond));
        return $req;
    }

    public function ajoutAdmin($id,$mdp)
    {
        $db=$this->dbConnect();
        $req = $db -> prepare ('INSERT INTO utilisateur(login,password,id_type_utilisateur) VALUES (:login_admin,:password_admin,1)');
        $req -> execute(array(
            'login_admin' => $id,
            'password_admin' => $mdp));
        return $req;
    }

    public function ajoutOp($id,$mdp)
    {
        $db=$this->dbConnect();
        $req = $db -> prepare ('INSERT INTO utilisateur(login,password,id_type_utilisateur) VALUES (:login_op,:password_op,2)');
        $req -> execute(array(
            'login_op' => $id,
            'password_op' => $mdp));
        return $req;
    }

	public function ajoutPres($texte_pres)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE presentation SET contenu_presentation = :texte_pres WHERE id_presentation = 1');
        $req->execute(array('texte_pres' => $texte_pres));
        return $req;
    }
	
    public function ajoutCond($texte_cond)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE conditions_utilisation SET contenu_conditions_utilisation = :texte_cond WHERE id_conditions_utilisation= 1');
        $req->execute(array('texte_cond' => $texte_cond));
        return $req;
    }
	
	public function getIdToken($token)
    {
        $db=$this->dbConnect();
        $req =$db->prepare('SELECT id_utilisateur FROM info_utilisateur WHERE token =:token');
        $req->execute(array('token' =>$token));
        return $req;
    }	
	
    public function setNewMdp($mdp,$id)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE utilisateur SET password=:mdp WHERE id_utilisateur=:id');
        $req->execute(array(
            'mdp' => $mdp,
            'id' =>$id
        ));
    }
}

