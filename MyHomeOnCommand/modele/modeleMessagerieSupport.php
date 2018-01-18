<?php
class messagerieSupport extends Connection
{
	
    public function recupNewQuestions() /* Obtient les question auquel le support n'a pas encore répondu */
    {

         $db=$this->dbConnect();
         $req = $db->query("SELECT contenu_q, prenom, nom, info_utilisateur.id_utilisateur FROM qr JOIN relation_utilisateur_qr ON qr.id_qr = relation_utilisateur_qr.id_qr JOIN info_utilisateur ON relation_utilisateur_qr.id_utilisateur = info_utilisateur.id_utilisateur WHERE contenu_r = ' - - Un membre du support va vous répondre dans les plus bref délais - - '"); 
         /* On récupère id_utilisateur en l'appelant de cette façon car sinon c'est ambigu, il ne sait pas de quelle table le récupérer */
         return $req;
    }

    public function getMessagesClient($idClient) /* Obtient la discussion déjà établie avec un client en particulier */
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT contenu_q, contenu_r, id_qr, id_utilisateur FROM qr NATURAL JOIN relation_utilisateur_qr WHERE id_utilisateur = :id AND id_type_qr = :type ORDER BY date_q');
        $req->execute(array(
            'id' => $idClient,
            'type' => 2
        ));
        return $req;
    }

    public function postReponse($reponse, $idQR)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('UPDATE qr SET contenu_r = :cRNew WHERE contenu_r = " - - Un membre du support va vous répondre dans les plus bref délais - - " AND id_qr = :id');
        $req->execute(array(
            'cRNew' =>$reponse,
            'id' => $idQR
        ));

    }

    public function recupIdQr($idClient)
    {
        $db=$this->dbConnect();
        $req = $db->prepare('SELECT id_qr FROM relation_utilisateur_qr NATURAL JOIN qr WHERE contenu_r = " - - Un membre du support va vous répondre dans les plus bref délais - - " AND id_utilisateur = :id');
        $req->execute(array(
            'id' =>$idClient
        ));
        return $req;
    }


    
}
?>
