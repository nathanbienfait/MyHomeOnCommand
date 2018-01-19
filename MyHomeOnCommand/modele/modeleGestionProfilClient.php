<?php
class gestionProfilClient
{
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

	public function getUtilisateur($idUtil)
	{
		$db=$this->dbConnect();
		$req = $db->prepare('SELECT * FROM utilisateur NATURAL JOIN info_utilisateur WHERE id_utilisateur = :id');
        $req->execute(array('id' => $idUtil));
        return $req;
	}

	public function clientModifInfo($prenom,$nom,$email,$telephone,$idUtil)
	{
		$db=$this->dbConnect();
		$req = $db->prepare('UPDATE info_utilisateur SET prenom = :prenom, nom = :nom, email = :email, telephone = :telephone WHERE id_utilisateur = :id');
        $req->execute(array(
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'telephone'=> $telephone,
            'id' => $idUtil
        ));
	}

	public function clientModifUtil($login,$idUtil)
	{
		$db=$this->dbConnect();
		$req = $db->prepare('UPDATE utilisateur SET login =:login, WHERE id_utilisateur = :id');
        $req->execute(array(
            'login' => $login,
            'id' => $idUtil
        ));
	}
	
}

?>

