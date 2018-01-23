<?php
class gestionProfilClient extends Connection
{

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
		$req = $db->prepare('UPDATE utilisateur SET login =:login WHERE id_utilisateur = :id');
        $req->execute(array(
            'login' => $login,
            'id' => $idUtil
        ));
	}

    public function getMdpUtilisateur($idUtil)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT password FROM utilisateur WHERE id_utilisateur = :id');
        $req->execute(array('id' => $idUtil));
        return $req;
    }

    public function modifMdp($criptedMdp, $idUtil)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('UPDATE utilisateur SET password = :mdp WHERE id_utilisateur = :id');
        $req->execute(array(
            'mdp' => $criptedMdp,
            'id' => $idUtil
        ));
    }
	
}

?>

