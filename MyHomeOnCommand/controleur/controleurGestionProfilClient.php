<?php
function clientVisuProfilClient ()
{

$idClient=$_SESSION['id'];
$utilisateur=new gestionProfilClient;

$info=$utilisateur->getUtilisateur($idClient);
$tab=[];

while ($donnees = $info->fetch())
{
	$tab[0]=htmlentities($donnees["login"], ENT_QUOTES);       //Chaque $tab correspond a un formulaire pré-remplit
    $tab[1]=htmlentities($donnees["password"], ENT_QUOTES);     
    $tab[2]=htmlentities($donnees["prenom"], ENT_QUOTES);       //htmlentities([..], ENT_QUOTES) converti les guillemets double en guillemens simple
    $tab[3]=htmlentities($donnees["nom"], ENT_QUOTES);
    
    $tab[4]=htmlentities($donnees["email"], ENT_QUOTES);
    $tab[5]=htmlentities($donnees["telephone"], ENT_QUOTES);
}
return $tab;
}



function clientModifInfoClient($login,$prenom,$nom,$email,$telephone)
{
	$idClient=$_SESSION['id'];
	$utilisateur=new gestionProfilClient;
	$utilisateur->clientModifInfo($prenom,$nom,$email,$telephone,$idClient);
    $utilisateur->clientModifUtil($login,$idClient);
    echo "<script>alert(\"Modifications réalisées\")</script>";
}
?>
