<?php

function ajouterLogement($idClient,$nomLogement,$rueLogement,$villeLogement,$cpLogement,$paysLogement)
{
    $ajout=new ajout;
    $ajout->ajoutLogement($nomLogement,$rueLogement,$villeLogement,$cpLogement,$paysLogement);
    $ajoutLogement=$ajout->getIdNewLogement();
    $idlogement=$ajoutLogement->fetch();
    $ajout->ajoutRelLogementClient($idClient,$idlogement[0]);
    echo "<script>alert(\"Ajout du logement réalisé\")</script>";
    
}

function nomLogement($idClient)
{
    $nom=new ajout;
    $nomLogement=$nom->getNomLogements($idClient);
    $x=0;
    $tabNomLogement=[];
    while($nom=$nomLogement->fetch())
    {
        $tabNomLogement[$x]=$nom['id_logement'];
        $tabNomLogement[$x+1]=$nom['nom_logement'];
        $x=$x+2;
    }
    return $tabNomLogement;
}

function ajouterPiece($idLogement,$nomPiece)
{
    $ajout=new ajout;
    $ajout->ajoutPiece($idLogement,$nomPiece);
    echo "<script>alert(\"Ajout de la pièce réalisé\")</script>";
}

function nomPiece($idClient)
{
    $nom=new ajout;
    $pieces=$nom->getNomPiece($idClient);
    $x=0;
    $tablepiece=[];
    while($piece=$pieces->fetch())
    {
        $tablepiece[$x]=$piece['id_piece'];
        $tablepiece[$x+1]=$piece['nom_piece'];
        $tablepiece[$x+2]=$piece['id_logement'];
        $x=$x+3;
        
    }
    return $tablepiece;
}

function ajouterCemac($idPiece,$nomCemac)
{
    $ajout=new ajout;
    $ajout->ajoutCemac($nomCemac);
    $newidCemac=$ajout->getIdNewCemac();
    $idCemac=$newidCemac->fetch();
    $ajout->ajoutRelPieceCemac($idPiece,$idCemac[0]);
    echo "<script>alert(\"Ajout du cemac réalisé\")</script>";
}

function nomCemac($idClient)
{
    $nom=new ajout;
    $cemacs=$nom->getNomCemac($idClient);
    $x=0;
    $tableCemac=[];
    while($cemac=$cemacs->fetch())
    {
        $tableCemac[$x]=$cemac['id_cemac'];
        $tableCemac[$x+1]=$cemac['nom_cemac'];
        $tableCemac[$x+2]=$cemac['id_piece'];
        $x=$x+3;
    }
    return $tableCemac;
}

function nomTypeEquipement()
{
    $nom=new ajout;
    $types=$nom->getNomType();
    $x=0;
    $tableType=[];
    while($type=$types->fetch())
    {
        $tableType[$x]=$type['id_type_equipement'];
        $tableType[$x+1]=$type['nom_type_equipement'];
        $x=$x+2;
    }
    return $tableType;
}

function nomEquipement($idClient)
{
    $nom=new ajout;
    $equipements=$nom->getNomEquipement($idClient);
    $x=0;
    $tableEquipement=[];
    while($equipement=$equipements->fetch())
    {
        $tableEquipement[$x]=$equipement['id_equipement'];
        $tableEquipement[$x+1]=$equipement['nom_equipement'];
        $tableEquipement[$x+2]=$equipement['id_cemac'];
        $x=$x+3;
    }
    return $tableEquipement;
}
function ajouterEquipement($idCemac,$idType,$nomEquipement)
{
    $equip=new ajout;
    $equip->ajoutEquipement($idCemac,$idType,$nomEquipement);
    echo "<script>alert(\"Ajout de l'équipement réalisé\")</script>";
    
}

function afficherHabitation($idClient)
{
    $infos=new ajout;
    $habitation=$infos->getNomCemac($idClient);
    return $habitation;
}

function verifInfoClient()
{
    if(!isset($_SESSION['id']))
    {
        return 0;
    }
    $idClient=$_SESSION['id'];
   
    $utilisateur=new gestionProfilClient;

    $info=$utilisateur->getUtilisateur($idClient);
    $tab=[];

    while ($donnees = $info->fetch())
    {
        $tab[0]=htmlentities($donnees["login"], ENT_QUOTES);
        $tab[1]=htmlentities($donnees["password"], ENT_QUOTES);
        $tab[2]=htmlentities($donnees["prenom"], ENT_QUOTES);
        $tab[3]=htmlentities($donnees["nom"], ENT_QUOTES);
        $tab[4]=htmlentities($donnees["email"], ENT_QUOTES);
        $tab[5]=htmlentities($donnees["telephone"], ENT_QUOTES);
    }
    
    if($tab[4]==null||$tab[5]==null)
    {
        return 1;
    }
    else 
    {return 0;}
}

function modifierNomLogement($nom,$id)
{
    $nouveauNom=new ajout; 
    $nouveauNom->modifNomLogement($id,$nom);
    echo "<script>alert(\"Modifications réalisées\")</script>";
    
}

function modifierNomPiece($nom,$id)
{
    $nouveauNom=new ajout; 
    $nouveauNom->modifNomPiece($id,$nom);
    echo "<script>alert(\"Modifications réalisées\")</script>";
    
}

function modifierNomCemac($nom,$id)
{
    $nouveauNom=new ajout; 
    $nouveauNom->modifNomCemac($id,$nom);
    echo "<script>alert(\"Modifications réalisées\")</script>";
}

function modifierNomEquipement($nom,$id)
{
    $nouveauNom=new ajout; 
    $nouveauNom->modifNomEquipement($id,$nom);
    echo "<script>alert(\"Modifications réalisées\")</script>";
}

function supprimerEquipement($id)
{
    $supprimer=new ajout;
    $supprimer->supprDonneeEquip($id);
    $supprimer->supprEquip($id);
    
}

function supprimerCemac($id)
{
    $supprimer= new ajout;
    $idEquip=$supprimer->getIdEquipDeCemac($id)->fetchAll();
    foreach($idEquip as $idE)
    {
        supprimerEquipement($idE['id_equipement']);
    }
    $supprimer->supprCemac($id);
    $supprimer->supprRelCemacPiece($id);
}

function supprimerPiece($id)
{
    $supprimer= new ajout;
    $idCemac=$supprimer->getIdCemacDePiece($id)->fetchAll();
    foreach($idCemac as $idC)
    {
        supprimerCemac($idC['id_cemac']);
    }
    $supprimer->supprPiece($id);
}

function supprimerLogement($id)
{
    $supprimer= new ajout;
    $idPiece=$supprimer->getIdPieceDeLogement($id)->fetchAll();
    foreach($idPiece as $idP)
    {
        supprimerPiece($idP['id_piece']);
    }
    $supprimer->supprLogement($id);
    $supprimer-> supprRelLogementUtil($id);
}

//Partie consommation
function clientGrapheConsommationtemperature()
{
    $clientconsommation=new clientconsommation;
    $today = getdate(); //On obtient la date actuelle
    $mois = $today['mon'];
    $annee = $today['year'];
    $login = $_SESSION['prenom'];
    $arr = [["jour", "température"]];
    $info=$clientconsommation->getconsommationhumiditeclient();
    while($donnees = $info -> fetch())
            {
              $dateentime = strtotime($donnees['date_utilisation']);
              if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                  if (date("Y", $dateentime) == $annee) //Puis de l'année actuelle
                  {
                    if( $donnees['login'] == $login)
                    {
                        $arr[] = [$donnees['date_utilisation'], intval($donnees['valeur'])];
                          }
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

function clientGrapheConsommationhumidite()
{
    $clientconsommation=new clientconsommation;
    $today = getdate(); //On obtient la date actuelle
    $mois = $today['mon'];
    $annee = $today['year'];
    $login = $_SESSION['prenom'];
    $arr = [["jour", "humidité"]];
    $info=$clientconsommation->getconsommationhumiditeclient();
    while($donnees = $info -> fetch())
            {
              $dateentime = strtotime($donnees['date_utilisation']);
              if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                  if (date("Y", $dateentime) == $annee) //Puis de l'année actuelle
                  {
                    if( $donnees['login'] == $login)
                    {
                        $arr[] = [$donnees['date_utilisation'], intval($donnees['valeur'])];
                          }
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
                    


function clientGrapheConsommationlumiere()
{
    $clientconsommation=new clientconsommation;
    $today = getdate(); //On obtient la date actuelle
    $mois = $today['mon']; 
    $annee = $today['year'];
    $arrid = ['identifiant'];
    $login = $_SESSION['prenom'];
    $arr = [["jour", "nombre d'heures"]];
    $info=$clientconsommation->getconsommationlumiereclient();
    while($donnees = $info -> fetch())
            {
                $dateentime = strtotime($donnees['date_utilisation']);
                if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                    if (date("Y", $dateentime) == $annee) //Puis de l'année actuelle
                    {
                        if( $donnees['login'] == $login)
                        {
                            $arrid[] = $donnees['id_utilisateur'];
                            $arr[] = [$donnees['date_utilisation'], intval(date('h.i',strtotime($donnees['temps'])))];
                        }
                     }  
                 }
            }
    $x=1; //On regarde si des données ont la même date
    while($x<sizeof($arr))
        {
            if($x<sizeof($arr)-1)
            {
                if($arr[$x][0]==$arr[$x+1][0])
                    {
                        $arr[$x][1]=($arr[$x][1]+$arr[$x+1][1]);
                    }
                    array_splice($arr,$x+1,1);
            }
            $x++;      
        }
return $arr;           
}
