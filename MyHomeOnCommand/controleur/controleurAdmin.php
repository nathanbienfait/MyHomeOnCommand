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
function supprimerClient($id)
{
    $admin=new ajout;
    $admin->supprClient($id);
    $admin->supprInfoClient($id);
    $relQR=$admin->getIdRelQRClient($id)->fetchAll();
    foreach($relQR as $rel)
    {
        $admin->supprimerQR($rel['id_qr']);
    }
    $admin->supprRelQRClient($id);
    $relLog=$admin->getIdRelLogClient($id);
    foreach($relLog as $relL)
    {
        supprimerLogement($relL['id_logement']);
    }
    $admin->supprRelLogClient($id);
}

//Partie consommation
function adminGrapheConsommationtemperature()
{
    $admin=new admin;
    $today = getdate(); //On obtient la date actuelle
    $mois = $today['mon'];
    $annee = $today['year'];
    $arr = [["jour", "température"]];
    $info=$admin->getconsommationtemperatureadmin();
    while($donnees = $info -> fetch())
            {
              $dateentime = strtotime($donnees['date_utilisation']);
              if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                  if (date("Y", $dateentime) == $annee) //Puis celles de l'année actuelle
                  {
                    $arr[] = [$donnees['date_utilisation'], intval($donnees['valeur'])];
                  }
                }  
            }
    //Si deux données ont la même date, on fait la moyenne des deux            
            $x=1;
    while($x<sizeof($arr))
    {
        if($x<sizeof($arr)-1)
        {
            if($arr[$x][0]==$arr[$x+1][0])
            {
                $arr[$x][1]=($arr[$x][1]+$arr[$x+1][1])/2;
                 array_splice($arr,$x+1,1);
            }
        }
        $x++;
    }
    return $arr;
}

function adminGrapheConsommationhumidite()
{
    $admin=new admin;
    $today = getdate(); //On obtient la date actuelle
    $mois = $today['mon'];
    $annee = $today['year'];
    $arr = [["jour", "humidité"]];
    $info=$admin->getconsommationhumiditeadmin();
    while($donnees = $info -> fetch())
            {
              $dateentime = strtotime($donnees['date_utilisation']);
              if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                  if (date("Y", $dateentime) == $annee) //Puis de l'année actuelle
                  {
                    $arr[] = [$donnees['date_utilisation'], intval($donnees['valeur'])];
                  }
                }  
            }
//Si deux données ont la même date, on fait la moyenne des deux            
            $x=1;
    while($x<sizeof($arr))
    {
        if($x<sizeof($arr)-1)
        {
            if($arr[$x][0]==$arr[$x+1][0])
            {
                $arr[$x][1]=($arr[$x][1]+$arr[$x+1][1])/2;
                 array_splice($arr,$x+1,1);
            }
        }
        $x++;
    }
    return $arr;
}


function adminGrapheConsommationlumiere()
{
    $admin=new admin;
    $today = getdate(); //On obtient la date actuelle
    $mois = $today['mon']; 
    $annee = $today['year'];
    $arr = [["jour", "nombre d'heures"]];
    $arrid = ['identifiant'];
    $info=$admin->getconsommationlumiereadmin();
    while($donnees = $info -> fetch())
            {
              $dateentime = strtotime($donnees['date_utilisation']);
              if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                  if (date("Y", $dateentime) == $annee) //Puis de l'année actuelle
                  {
                    $arrid[] = $donnees['id_utilisateur'];
                    $arr[] = [$donnees['date_utilisation'], intval(date('h.i',strtotime($donnees['temps'])))];
                  }
                }  
            }
//On regarde si des données ont la même date            
            $x=1;
    while($x<sizeof($arr))
    {
        if($x<sizeof($arr)-1)
        {
            if($arr[$x][0]==$arr[$x+1][0])
            {
                if($arrid[$x]==$arrid[$x+1]) //Si les données sont du même utilisateur on fait leur somme
                {
                    $arr[$x][1]=($arr[$x][1]+$arr[$x+1][1]);
                }
                $arr[$x][1]=($arr[$x][1]+$arr[$x+1][1])/2; //Sinon, on fait leur moyenne
            }
            array_splice($arr,$x+1,1);
        }
        $x++;
    }
    return $arr;
}

