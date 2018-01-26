<?php
class Connection //class dont toutes les autres héritent pour éviter la redondance de la fonction qu'elle contient
{
    protected function dbConnect()// fonction qui permet de ce connecter à la BDD
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
    
    public function getAuthentification()//récupère les infos de tout les utilisateur(id,login,mdp,type)
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT id_utilisateur, login, password, id_type_utilisateur FROM utilisateur');
        return $req;
    }
    
    public function getInfoUtilisateur($idUtil)//récupère les infos d'un seul utilisateur(prenom,nom,email,telephone,statut,id)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT prenom, nom, email, telephone, statut_utilisateur, id_utilisateur FROM info_utilisateur WHERE id_utilisateur = :id');
        $req->execute(array('id' => $idUtil));
        return $req;
    }
    public function verifMail() //Permet de récupérer tous les mails de la BDD pour les comparer avec celui rentré par le client pour une réinitialisation de MDP
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT email FROM info_utilisateur');
        return $req;
    }
    public function getClef($mail) //Récupère le token du client en fonction du mail qu'il a rentré
    {
        $db =$this->dbConnect();
        $reqToken =$db->prepare('SELECT token FROM info_utilisateur WHERE email = :mail');
        $reqToken->execute(array('mail' => $mail));
        return $reqToken;
    }
    
    
    
}

class InscriptionUtilisateur extends Connection
{
    
    public function setUtilisateur($pseudo,$mp)//crée un nouvel utilisateur
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO utilisateur(login, password, id_type_utilisateur) VALUES(:log, :mdp, :id_type)');
        $req->execute(array(
            'log' => $pseudo,
            'mdp' => $mp,
            'id_type' => 3
	));

    }

    public function setInfoUtilisateur($prenom,$nom,$email,$telephone,$statut,$id,$clef)//crée de nouvel infos pour un utilisateur
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
    
    public function getLoginUtilisateurs()//récupère tous les identifiants des utilisateurs
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT login FROM utilisateur');
        return $req;
    }
    
    public function getIdUtilisateur($log)//récupère l'id d'un utilisateur en fonction de son login
    {
       
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT id_utilisateur FROM utilisateur WHERE login = :log');
        $req->execute(array('log' => $log));
       
        return $req;
    }
     public function getSlogan() // permet de récupérer le slogan de la bdd
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT contenu_slogan FROM slogan');
        return $req; 
     }	
	
	public function getPres() // permet de récupérer le texte de présentation de Domisep
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT contenu_presentation FROM presentation');
        return $req; 
     }
	
      public function getCond() // permet de récupérer le contenu des conditions d'utilisation
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT contenu_conditions_utilisation FROM conditions_utilisation');
        return $req; 
     }
	 // les trois fonctions suivantes permettent de récupérer les informations relatives au coordonnées de Domisep
	public function getTel()  
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT telephone_contact FROM contact');
        return $req; 
     }

        public function getMail()
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT email_contact FROM contact');
        return $req; 
     }

        public function getAdresse()
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT adresse_contact FROM contact');
        return $req; 
     }
	

	
    public function modifSlogan($slog) // permet de modifier le slogan dans la bdd
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE slogan SET contenu_slogan = :Modifier_le_slogan WHERE id_slogan = 1');
        $req->execute(array('Modifier_le_slogan' => $slog ));
        return $req;
    }

    public function ajoutAdmin($id,$mdp) // ajoute un admin dans le bdd
    {
        $db=$this->dbConnect();
        $req = $db -> prepare ('INSERT INTO utilisateur(login,password,id_type_utilisateur) VALUES (:login_admin,:password_admin,1)');
        $req -> execute(array(
            'login_admin' => $id,
            'password_admin' => $mdp));
        return $req;
    }

    public function ajoutOp($id,$mdp) // ajoute un opérateur dans la bdd
    {
        $db=$this->dbConnect();
        $req = $db -> prepare ('INSERT INTO utilisateur(login,password,id_type_utilisateur) VALUES (:login_op,:password_op,2)');
        $req -> execute(array(
            'login_op' => $id,
            'password_op' => $mdp));
        return $req;
    }

	public function ajoutPres($texte_pres) // modifie le contenu de la présentation de l'entreprise dans la bdd
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE presentation SET contenu_presentation = :texte_pres WHERE id_presentation = 1');
        $req->execute(array('texte_pres' => $texte_pres));
        return $req;
    }
	
    public function ajoutCond($texte_cond) // modifie le contenu des conditions d'utilisations dans la bdd
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE conditions_utilisation SET contenu_conditions_utilisation = :texte_cond WHERE id_conditions_utilisation= 1');
        $req->execute(array('texte_cond' => $texte_cond));
        return $req;
    }
	
    public function ajoutContact($telephone,$mail,$adresse) // modifie le contenu des cooredonnées de Domisep dans la bdd
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE contact 
            SET telephone_contact = :telephone_contact, 
                email_contact = :mail_contact, 
                adresse_contact = :adresse_contact 
            WHERE id_contact= 1');
        $req->execute(array(
            'telephone_contact' => $telephone,
            'mail_contact' => $mail,
            'adresse_contact' => $adresse 
        ));
        return $req;
    }
	
	public function getIdToken($token) //Permet de récupérer l'id du client en fonction du token présent dans l'URL reçu par mail
    {
        $db=$this->dbConnect();
        $req =$db->prepare('SELECT id_utilisateur FROM info_utilisateur WHERE token =:token');
        $req->execute(array('token' =>$token));
        return $req;
    }	
	
    public function setNewMdp($mdp,$id) //Permet de changer le mot de passe
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE utilisateur SET password=:mdp WHERE id_utilisateur=:id');
        $req->execute(array(
            'mdp' => $mdp,
            'id' =>$id
        ));
    }
}

