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
    $arr = [["jour", "température"]]; //On crée le tableau qui va contenir les données
    $info=$admin->getconsommationtemperatureadmin();
    while($donnees = $info -> fetch())
            {
              $dateentime = strtotime($donnees['date_utilisation']);
              if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                  if (date("Y", $dateentime) == $annee) //Puis celles de l'année actuelle
                  {
                    $arr[] = [$donnees['date_utilisation'], intval($donnees['valeur'])]; //On ajoute les données dans le tableau
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
    if(count($arr) >= 2) //On renvoie le tableau uniquement s'il y a des données
    {
       return $arr; 
    };
}

function adminGrapheConsommationhumidite()
{
    $admin=new admin;
    $today = getdate(); //On obtient la date actuelle
    $mois = $today['mon']; 
    $annee = $today['year'];
    $arr = [["jour", "humidité"]]; //On crée le tableau qui va contenir les données
    $info=$admin->getconsommationhumiditeadmin();
    while($donnees = $info -> fetch())
            {
              $dateentime = strtotime($donnees['date_utilisation']);
              if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                  if (date("Y", $dateentime) == $annee) //Puis de l'année actuelle
                  {
                    $arr[] = [$donnees['date_utilisation'], intval($donnees['valeur'])]; //On ajoute les données dans le tableau
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
    if(count($arr) >= 2) //On retourne le tableau uniquement s'il y a des données
    {
       return $arr; 
    }
}


function adminGrapheConsommationlumiere()
{
    $admin=new admin;
    set_time_limit(1800);
    $today = getdate(); //On obtient la date actuelle
    $mois = $today['mon']; 
    $annee = $today['year'];
    $arr = [["jour", "nombre d'heures"]]; //On crée le tableau qui va contenir les données
    $arrid = ['identifiant']; //On crée un tableau qui va contenir les identifiants des utilisateurs à qui appartiennent les données
    $info=$admin->getconsommationlumiereadmin();
    while($donnees = $info -> fetch())
            {
              $dateentime = strtotime($donnees['date_utilisation']);
              if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                  if (date("Y", $dateentime) == $annee) //Puis de l'année actuelle
                  {
                    $arrid[] = $donnees['id_utilisateur']; //On ajoute les identifiants des utilisateurs dans ce tableau
                    $arr[] = [$donnees['date_utilisation'], intval(date('h.i',strtotime($donnees['temps'])))]; //On ajoute les données dans ce tableau en convertissant le temps en heures et en int
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
                else 
                {
                    $arr[$x][1]=($arr[$x][1]+$arr[$x+1][1])/2; //Sinon, on fait leur moyenne
                }
            array_splice($arr,$x+1,1);
            }
        $x++;
        }
    }
    if(count($arr) >= 2) //On retourne le tableau de données uniquement s'il y a des données
    {
       return $arr; 
    }
}

