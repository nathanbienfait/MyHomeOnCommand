<?php
function adminInfoClient()
{
    $admin=new admin;
    
    $tableInfoClient=$admin->getDonneeClient();
    $x=0;
    $tableinfo=null;
    while($table=$tableInfoClient->fetch())
    {
       
        $tableinfo[$x]=$table['prenom'];
        $tableinfo[$x+1]=$table['nom'];
        $tableinfo[$x+2]=$table['email'];
        $tableinfo[$x+3]=$table['telephone'];
        $tableinfo[$x+4]=$table['statut_utilisateur'];
        $tableinfo[$x+5]=$table['login'];
        $tableinfo[$x+6]=$table['password'];
        $tableinfo[$x+7]=$table['id_utilisateur'];
        $x=$x+8;
        
    }
    
    
    
    return $tableinfo;
}

function adminModifInfoClient($prenom,$nom,$email,$telephone,$type,$pseudo,$idClient)
{
    $admin=new admin;
    $admin->modifDonneeClient($prenom,$nom,$email,$telephone,$type,$idClient);
    $admin->modifCompteClient($pseudo,$idClient);
    echo "<script>alert(\"Modifications réalisées\")</script>";
    
}

