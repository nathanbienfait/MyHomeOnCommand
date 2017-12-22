<?php
class QuestionReponse
{
    private function dbconnect()
    {
        try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=myhomeoncommand;charset=utf8', 'root', '');
            }
            catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }
        return $bdd;
    }

    public function recupereqr()
    {
        $db=$this->dbConnect();
        $donneQR = $db->query('SELECT contenu_q, contenu_r, id_qr FROM qr');
        return $donneQR;
    }

    public function supprimer($id)
    {
        $bdd=$this->dbconnect();
        $supprime = $bdd->prepare('DELETE FROM qr WHERE id_qr=:id');
        $supprime->execute(array('id'=>$_POST['supprimer']));
    }
    public function modifier($idqr,$contenur,$contenuq)
    {
        $bdd=$this->dbconnect($contenuq,$contenur,$idqr);
        $req = $bdd->prepare('UPDATE qr SET contenu_q = :contenuq, contenu_r = :contenur WHERE id_qr = :idqr');
        $req->execute(array(
            'contenuq' => $contenuq,
            'contenur' => $contenur,
            'idqr' => $idqr
        ));
    }
}
