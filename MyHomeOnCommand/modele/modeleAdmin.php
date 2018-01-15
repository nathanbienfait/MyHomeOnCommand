<?php
class admin
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
