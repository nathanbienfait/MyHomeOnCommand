<?php
function clientVisuProfilClient ()
{

$idClient=$_SESSION['id'];                                      //Récupère l'id de l'utilisateur
$utilisateur=new gestionProfilClient;                           

$info=$utilisateur->getUtilisateur($idClient);                  //Execute la requete SQL "getUtilisateur" du modèle "modeleGestionProfilClient.php"
$tab=[];

while ($donnees = $info->fetch())                               //Cette méthode de fetch n'est pas la plus optimisée (fetchAll() fut découvert par la suite)
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



function clientModifMdp($oldMdp, $newMdp, $confNewMdp)
{
    $idClient=$_SESSION['id'];
    $utilisateur=new gestionProfilClient;
    $verif=$utilisateur->getMdpUtilisateur($idClient)->fetch();


    if(password_verify($oldMdp,$verif['password']))
    {
        if($newMdp == $confNewMdp)
        {
            $criptedMdp=password_hash($newMdp,PASSWORD_DEFAULT);
            $utilisateur->modifMdp($criptedMdp, $idClient);

            echo"<script>alert('Le mot de passe a été modifié avec succès');</script>";
        }
        else
        {
            echo "<script>alert('Le nouveau mot de passe et sa confirmation ne sont pas les mêmes');</script>";
        }
    }
    else
    {
        echo "<script>alert('Ancien mot de passe non valide');</script>";
    }


}




?>
