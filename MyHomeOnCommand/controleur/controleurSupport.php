<?php
function tableauqr() //Fonction permettant d'afficher par la suite les questions/réponses
{
    $clientqr=new QuestionReponse; /* Permet d'ouvrir l'objet contenant les fonctions correspondant au service question/réponse */
    $qr=$clientqr->recupereqr()->fetchAll(); //fait appel à la fonction contenant le SQL pour récupérer les questions/réponses et leur id
    $tableauqr = $qr;
    return $tableauqr; //renvoie un fetch avec toutes les questions/réponses
}

function supprimerqr($id) //Fonction qui nous permet de supprimer une question/reponse en fonction de l'id
{

    $clientqr=new QuestionReponse; 
    $supprimer=$clientqr->supprimer($id);  //fait appel à la fonction SQL supprimant les questions/réponses en fonction de leur id
}
function modifqr($idqr,$contenur,$contenuq) //Fonction qui nous permet de modifier une question/reponse en fonction de l'id
{
    $qr = new QuestionReponse;
    $qr->modifier($idqr,$contenur,$contenuq); //fait appel à la fonction SQL modifiant les questions/réponses en fonction de leur id
}
function ajouterqr($texteQ,$texteR,$dateQ,$dateR) //Fonction qui nous permet d'ajouter une question/reponse
{
    $aj = new QuestionReponse;
    $aj->ajouter($texteQ,$texteR,$dateQ,$dateR); //fait appel à la fonction SQL ajoutant les questions/réponses en fonction de leur id
}
