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