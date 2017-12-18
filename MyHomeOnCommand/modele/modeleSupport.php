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
}
