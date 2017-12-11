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

