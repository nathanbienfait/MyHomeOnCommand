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


    public function getMessages($idUtil)    /* Obtient la discussion déjà établie ave le support */
    {
    	$db=$this->dbConnect();
		$req = $db->prepare('SELECT contenu_q, contenu_r FROM qr NATURAL JOIN relation_utilisateur_qr WHERE id_utilisateur = :id AND id_type_qr = :type ORDER BY date_q');
		$req->execute(array('id' => $idUtil, 'type' => 2));
        return $req;
    }


    public function postQuestion($question)     /* Poste une question dans la table qr */
    {
        $db=$this->dbConnect();
        $req = $db->prepare('INSERT INTO qr(contenu_q, contenu_r, date_q, date_r, id_type_qr) VALUES(:cQ, :cR, NOW(), NOW(), 2)');
        $req->execute(array(
            'cQ' => $question,
            'cR' => ' - - Un membre du support va vous répondre dans les plus bref délais - - '
        ));
        return $req;
    }

    public function insertIdRelation($idClient) /* Relie l'idée de la question postée avec l'id de l'utilisateur dans la table relation_utilisateur_qr */
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

    public function verifAttenteSupportDoublon($idClient) //Récupère toutes les réponses automatiques pour pouvoir les compter après le fetch
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT id_qr FROM qr NATURAL JOIN relation_utilisateur_qr WHERE id_utilisateur = :id AND contenu_r = " - - Un membre du support va vous répondre dans les plus bref délais - - "');
        $req->execute(array('id' => $idClient));
        return $req;
    }

    public function supprAttenteSupportDoublon($id_qr) //Supprime toutes les réponses automatiques
    {
        $db=$this->dbConnect();
        $req = $db->prepare('UPDATE qr SET contenu_r = :cR WHERE id_qr = :id AND contenu_r = " - - Un membre du support va vous répondre dans les plus bref délais - - "');
        $req->execute(array(
            'id' => $id_qr,
            'cR' => NULL
        ));
    }

     public function reecrireDerniereReponse() // Ré-écrit la deriere réponse automatique (je n'ai pas réussi a tout supprimer sauf la dernière)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('UPDATE qr SET contenu_r = :cRNew ORDER BY id_qr DESC LIMIT 1');
        $req->execute(array(
            'cRNew' => " - - Un membre du support va vous répondre dans les plus bref délais - - "
        ));

    }

}

?>
