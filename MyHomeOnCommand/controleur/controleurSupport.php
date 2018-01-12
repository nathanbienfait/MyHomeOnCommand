<?php
function tableauqr()
{
    $clientqr=new QuestionReponse; /* Permet d'ouvrir l'objet contenant les fonctions correspondant au service question/réponse */
    $qr=$clientqr->recupereqr()->fetchAll();
    $tableauqr = $qr;
    return $tableauqr;
}

function supprimerqr($id)
{

    $clientqr=new QuestionReponse;
    $supprimer=$clientqr->supprimer($id); 
}
function modifqr($idqr,$contenur,$contenuq)
{
    $qr = new QuestionReponse;
    $qr->modifier($idqr,$contenur,$contenuq);
}
function ajouterqr($texteQ,$texteR,$dateQ,$dateR)
{
    $aj = new QuestionReponse;
    $aj->ajouter($texteQ,$texteR,$dateQ,$dateR);
}
