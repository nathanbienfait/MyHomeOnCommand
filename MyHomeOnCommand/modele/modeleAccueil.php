<?php

class LoginUtilisateur
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

class InscriptionUtilisateur
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
    
    public function setInfoUtilisateur($prenom,$nom,$email,$telephone,$statut,$id)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO info_utilisateur(prenom, nom, email, telephone, statut_utilisateur, id_utilisateur) VALUES(:prenom, :nom, :email, :telephone, :statut, :idutil)');
        $req->execute(array(
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'telephone' => $telephone,
            'statut' => $statut,
            'idutil' => $id
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
        $req = $db->query('SELECT contenu FROM slogan');
        return $req; 
     }
	
    public function modifSlogan($slog)
    {
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE slogan SET contenu = :Modifier_le_slogan WHERE id_slogan = 1');
        $req->execute(array('Modifier_le_slogan' => $slog ));
        return $req;
    }

    public function ajoutCapteur($capteur)
    {
        $db=$this->dbConnect();
        $req = $db -> prepare ('INSERT INTO type_equipement(nom_type_equipement) VALUES (:Ajouter_un_capteur)');
        $req -> execute(array('Ajouter_un_capteur' => $capteur));
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

