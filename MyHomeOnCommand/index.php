<?php
session_start();// démarre la session de l'utilisateur qui se connectera

//ajoute l'ensemble des controleurs et des modèles
require_once('controleur/controleurAccueil.php');
require_once('controleur/controleurAdmin.php');
require_once('controleur/controleurClient.php');
require_once('controleur/controleurSupport.php');
require_once('controleur/controleurRoute.php');
require_once('modele/modeleAccueil.php');
require_once('modele/modeleAdmin.php');
require_once('modele/modeleClient.php');
require_once('modele/modeleSupport.php');
require_once('modele/modelePanneaucapteursClient.php');
require_once('controleur/controleurGestionProfilClient.php');
require_once('modele/modeleGestionProfilClient.php');
require_once('modele/modeleMessagerieClient.php');
require_once('controleur/controleurMessagerieClient.php');
require_once('modele/modeleMessagerieSupport.php');
require_once('controleur/controleurMessagerieSupport.php');


//fonction qui articule les pages du site, chaque case correspond a une page, pour plus de lisibilité les fonctions appellées dans chaque case sont dans le controleurRoute.php
function route()
{

$page=$_GET['page'];
switch($page)
{
    case 'accueil':
        afficheAccueil();
        break;
    
    case 'panneau':
        affichePanneau();
        break;
    
    case 'inscription':
       
        afficheInscription();
        break;
        
    case 'adminPanneauClient':
        
        afficheAdminPanneauClient();
        break;
        
    case 'gestionHabitationClient':
        
        afficheGestionHabitationClient();
        break;
        
    case 'ajouterHabitation':
        
        afficheAjouterHabitation();
        break;
        
    case 'consommationClient':
        afficheConsommationClient();
        break;
        
    case 'consommationAdmin':
        afficheConsommationAdmin();
        break;
        
    case 'supportClient':

        afficheSupportClient();
        break;

    case 'supportAdmin':

        afficheSupportAdmin();
        break;
        
    case 'gestionProfilClient' :
    
    	afficheGestionProfilClient();
        break;
        
    case 'modificationMdpClient' :

        afficheModificationMdpClient();
        break;
        
    case 'mentionsLegales':
        afficheMentionsLegales();
        break;
        
    case 'conditions':
        afficheConditions();
        break;
        
   
    case 'modification':
        
        afficheModification();
        break;
        
    case 'messagerieClient' :

        afficheMessagerieClient();
        break;

    case 'messagerieSupport' :

        afficheMessagerieSupport();
        break;
        
     case 'supportOperateur' :

        afficheSupportOperateur();
        break;
        
     case 'reinitialisation':
        afficheReinitialisation();
        break;


 
}
    
}

//ici on appelle la fonction route si $_GET['page'] existe
if(isset($_GET['page']))
{
    route();
}
//Sinon on force l'appelle de route() dans le case accueil
else
{
   
    Header('Location: index.php?page=accueil');
}
