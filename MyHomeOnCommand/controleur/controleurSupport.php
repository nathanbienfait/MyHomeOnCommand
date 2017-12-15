<?php
function tableauqr()
{
    $clientqr=new QuestionReponse; /* Permet d'ouvrir l'objet contenant les fonctions correspondant au service question/réponse */
    $qr=$clientqr->recupereqr();
    $x=0;
    $tableauqr=array();
    while ($questionreponse=$qr->fetch()) {    
    $tableauqr[$x]=$questionreponse['contenu_q'];
    $tableauqr[$x+1]=$questionreponse['contenu_r'];
    $tableauqr[$x+2]=$questionreponse['id_qr'];
    $x=$x + 3;
    }
    return $tableauqr;
}
