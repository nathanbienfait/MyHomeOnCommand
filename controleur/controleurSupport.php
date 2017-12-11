/* fonction créant un tableau contenant les cases questions/réponses */
function tableauqr()
{
    $clientqr=new QuestionReponse; /* Permet d'ouvrir l'objet contenant les fonctions correspondant au service question/réponse */
    $qr=$clientqr->recupereqr();
    $x=0;
    $tableauqr=array();
    while ($questionreponse=$qr->fetch()) {    
    $tableauqr[$x]=$questionreponse['contenu_q'];
    $tableauqr[$x+1]=$questionreponse['contenu_r'];
    $x=$x + 2;
    }
    return $tableauqr;
}
