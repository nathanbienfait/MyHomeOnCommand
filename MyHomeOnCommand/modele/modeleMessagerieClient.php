<?php
class messagerieClient
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

/*
    public function getNombreQR($idUtil)
    {
    	$db=$this->dbConnect();
    	$req =$db->prepare('SELECT COUNT(*) FROM qr NATURAL JOIN relation_utilisateur_qr WHERE id_utilisateur = :id AND id_type_qr = :type');
    	$req->execute(array('id' => $idUtil, 'type' => 2));
        return $req;
    }
*/

    public function getMessages($idUtil)
    {
    	$db=$this->dbConnect();
		$req = $db->prepare('SELECT contenu_q, contenu_r FROM qr NATURAL JOIN relation_utilisateur_qr WHERE id_utilisateur = :id AND id_type_qr = :type ORDER BY date_q LIMIT 0, 20');
		$req->execute(array('id' => $idUtil, 'type' => 2));
        return $req;
    }


    public function postQuestion($question)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO qr(contenu_q, contenu_r, date_q, date_r, id_type_qr) VALUES(:cQ, :cR, NOW(), NOW(), 2)');
        $req->execute(array(
            'cQ' => $question,
            'cR' => ' - - Un membre du support va vous répondre dans les plus bref délais - - '
        ));
        return $req;
    }

    public function insertIdRelation($idClient)
    {
        $db=$this->dbConnect();
        $req = $db->query('SELECT id_qr FROM qr ORDER BY id_qr DESC LIMIT 1');
        
        $req=$req->fetch();
        $req2 = $db->prepare('INSERT INTO relation_utilisateur_qr SET id_qr = :idQ, id_utilisateur = :idUtil');
        $req2->execute(array(
            'idQ' => $req['id_qr'],
            'idUtil' => $idClient
        ));
        return $req2;
    }

}

?>