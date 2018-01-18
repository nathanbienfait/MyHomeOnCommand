<?php
class QuestionReponse extends Connection
{
    
    public function recupereqr()
    {
        $db=$this->dbConnect();
        $donneQR = $db->query('SELECT contenu_q, contenu_r, id_qr FROM qr WHERE id_type_qr = 1');
        return $donneQR;
    }

    public function supprimer($id)
    {
        $bdd=$this->dbconnect();
        $supprime = $bdd->prepare('DELETE FROM qr WHERE id_qr=:id');
        $supprime->execute(array('id'=>$_POST['boutton_supprimer']));
    }
    public function modifier($idqr,$contenur,$contenuq)
    {
        $bdd=$this->dbconnect();
        $req = $bdd->prepare('UPDATE qr SET contenu_q = :contenuq, contenu_r = :contenur WHERE id_qr = :idqr');
        $req->execute(array(
            'contenuq' => $contenuq,
            'contenur' => $contenur,
            'idqr' => $idqr
        ));
    }
     public function ajouter($texteQ,$texteR,$dateQ,$dateR)
    {
        $bdd=$this->dbconnect();
        $requette = $bdd->prepare('INSERT INTO qr(contenu_q,contenu_r,date_q,date_r,id_type_qr) VALUES(:texteQ, :texteR, :dateQ, :dateR, :type)');
        $requette->execute(array(
            'texteQ' => $texteQ,
            'texteR' => $texteR,
            'dateQ' => $dateQ,
            'dateR' => $dateR,
            'type' => 1
        ));
    } 
}
