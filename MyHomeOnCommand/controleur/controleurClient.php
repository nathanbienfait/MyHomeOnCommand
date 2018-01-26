<?php

function ajouterLogement($idClient,$nomLogement,$rueLogement,$villeLogement,$cpLogement,$paysLogement)
{//focntion qui permet d'ajouter un logement pour l'utilisateur
    $ajout=new ajout;
    $ajout->ajoutLogement($nomLogement,$rueLogement,$villeLogement,$cpLogement,$paysLogement);//enregistre le nouveau logment dans la BDD via la fonction du modèle
    $ajoutLogement=$ajout->getIdNewLogement();
    $idlogement=$ajoutLogement->fetch();
    $ajout->ajoutRelLogementClient($idClient,$idlogement[0]);// crée la relation entre le logement et l'utilisateur
    echo "<script>alert(\"Ajout du logement réalisé\")</script>";
    
}

function nomLogement($idClient)// focntion qui crée un tableau avec l'ensemble des logements de l'utilisateur
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

function ajouterPiece($idLogement,$nomPiece)//permet à l'utilisateur d'enregistrer une nouvelle pièce associée à un logement
{
    $ajout=new ajout;
    $ajout->ajoutPiece($idLogement,$nomPiece);
    echo "<script>alert(\"Ajout de la pièce réalisé\")</script>";
}

function nomPiece($idClient)// récupère l'ensemble des pièces d'un utilisateur
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

function ajouterCemac($idPiece,$nomCemac)// permet d'ajouter un cemac associé à une pièce
{
    $ajout=new ajout;
    $ajout->ajoutCemac($nomCemac);
    $newidCemac=$ajout->getIdNewCemac();
    $idCemac=$newidCemac->fetch();
    $ajout->ajoutRelPieceCemac($idPiece,$idCemac[0]);
    echo "<script>alert(\"Ajout du cemac réalisé\")</script>";
}

function nomCemac($idClient)// récupère l'ensemble des cemacs d'un utilisateur
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

function nomTypeEquipement()// récupère l'ensemble des types d'équipement disponibles
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

function nomEquipement($idClient)// récupère l'ensemble des équipements d'un utilisateur
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
function ajouterEquipement($idCemac,$idType,$nomEquipement)// permet d'ajouter un équipement associé à un cemac
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

function verifInfoClient()//vérifie si l'ensemble des infos du client ont été renseigné
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

function modifierNomLogement($nom,$id)//permet de modifier le nom d'un logement
{
    $nouveauNom=new ajout; 
    $nouveauNom->modifNomLogement($id,$nom);
    echo "<script>alert(\"Modifications réalisées\")</script>";
    
}

function modifierNomPiece($nom,$id)//permet de modifier le nom d'une pièce
{
    $nouveauNom=new ajout; 
    $nouveauNom->modifNomPiece($id,$nom);
    echo "<script>alert(\"Modifications réalisées\")</script>";
    
}

function modifierNomCemac($nom,$id)//permet de modifier le nom d'un cemac
{
    $nouveauNom=new ajout; 
    $nouveauNom->modifNomCemac($id,$nom);
    echo "<script>alert(\"Modifications réalisées\")</script>";
}

function modifierNomEquipement($nom,$id)//permet de modifier le nom d'un équipement
{
    $nouveauNom=new ajout; 
    $nouveauNom->modifNomEquipement($id,$nom);
    echo "<script>alert(\"Modifications réalisées\")</script>";
}

function supprimerEquipement($id)//permet de supprimer un équipement et les données qui lui sont associés
{
    $supprimer=new ajout;
    $supprimer->supprDonneeEquip($id);
    $supprimer->supprEquip($id);
    
}

function supprimerCemac($id)//permet de supprimer un cemac
{
    $supprimer= new ajout;
    $idEquip=$supprimer->getIdEquipDeCemac($id)->fetchAll();
    foreach($idEquip as $idE)
    {
        supprimerEquipement($idE['id_equipement']);//supprime aussi l'ensemble des équipements associés à ce cemac
    }
    $supprimer->supprCemac($id);// supprime le cemac
    $supprimer->supprRelCemacPiece($id);// supprime les relation entre une piece et ce cemac
}

function supprimerPiece($id)//permet de supprimer une pièce
{
    $supprimer= new ajout;
    $idCemac=$supprimer->getIdCemacDePiece($id)->fetchAll();
    foreach($idCemac as $idC)
    {
        supprimerCemac($idC['id_cemac']);// ainsi que tous les cemacs associés à cette pièce
    }
    $supprimer->supprPiece($id);// supprime la pièce
}

function supprimerLogement($id)// permet de supprimer un logement
{
    $supprimer= new ajout;
    $idPiece=$supprimer->getIdPieceDeLogement($id)->fetchAll();
    foreach($idPiece as $idP)
    {
        supprimerPiece($idP['id_piece']);// supprime toutes les pièce associés à ce logement
    }
    $supprimer->supprLogement($id);//supprime le logement
    $supprimer-> supprRelLogementUtil($id);//supprime les relations entre le logement et l'utilisateur
}

//Partie consommation
function clientGrapheConsommationtemperature()
{
    $clientconsommation=new clientconsommation;
    $today = getdate(); //On obtient la date actuelle
    $mois = $today['mon'];
    $annee = $today['year'];
    $login = $_SESSION['prenom']; //On obtient l'identifiant du client connecté
    $arr = [["jour", "température"]]; //On crée le tableau qui va contenir les données
    $info=$clientconsommation->getconsommationtemperatureclient();
    while($donnees = $info -> fetch())
            {
              $dateentime = strtotime($donnees['date_utilisation']);
              if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                  if (date("Y", $dateentime) == $annee) //Puis de l'année actuelle
                  {
                    if( $donnees['login'] == $login) //On garde les données appartenant au client connecté
                    {
                        $arr[] = [$donnees['date_utilisation'], intval($donnees['valeur'])]; //On ajoute les données dans le tableau
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
    if(count($arr) >= 2) //On retourne le tableau uniquement s'il y a des données
    {
       return $arr; 
    } 
}

function clientGrapheConsommationhumidite()
{
    $clientconsommation=new clientconsommation;
    $today = getdate(); //On obtient la date actuelle
    $mois = $today['mon'];
    $annee = $today['year'];
    $login = $_SESSION['prenom']; //On obtient l'identifiant du client connecté
    $arr = [["jour", "humidité"]]; //On crée le tableau qui va contenir les données
    $info=$clientconsommation->getconsommationhumiditeclient();
    while($donnees = $info -> fetch())
            {
              $dateentime = strtotime($donnees['date_utilisation']);
              if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                  if (date("Y", $dateentime) == $annee) //Puis de l'année actuelle
                  {
                    if( $donnees['login'] == $login) //On garde les données appartenant au client connecté
                    {
                        $arr[] = [$donnees['date_utilisation'], intval($donnees['valeur'])]; //On ajoute les données dans le tableau
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
    if(count($arr) >= 2) //On retourne le tableau de données uniquement s'il y a des données
    {
       return $arr; 
    }
}
                    


function clientGrapheConsommationlumiere()
{
    $clientconsommation=new clientconsommation;
    $today = getdate(); //On obtient la date actuelle
    $mois = $today['mon']; 
    $annee = $today['year'];
    $login = $_SESSION['prenom']; //On obtient l'identifiant du client connecté
    $arr = [["jour", "nombre d'heures"]]; //On crée le tableau qui va contenir les données
    $info=$clientconsommation->getconsommationlumiereclient();
    while($donnees = $info -> fetch())
            {
                $dateentime = strtotime($donnees['date_utilisation']);
                if (date("n", $dateentime) == $mois) //On garde les données du mois actuel
                {
                    if (date("Y", $dateentime) == $annee) //Puis de l'année actuelle
                    {
                        if( $donnees['login'] == $login) //On garde les données du client
                        {
                            $arr[] = [$donnees['date_utilisation'], intval(date('h.i',strtotime($donnees['temps'])))]; //On ajoute les données dans le tableau en convertissant le temps en heures et en int
                        }
                     }  
                 }
            }
    $x=1; //Si des données ont la même date ont fait la somme de leurs temps d'utilisation
    while($x<sizeof($arr))
        {
            if($x<sizeof($arr)-1)
            {
                if($arr[$x][0]==$arr[$x+1][0])
                    {
                        $arr[$x][1]=($arr[$x][1]+$arr[$x+1][1]);
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
