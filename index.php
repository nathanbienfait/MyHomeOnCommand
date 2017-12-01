<?php
session_start();
include('controleur/controleur.php');
include('modele/modele.php');
function route($x)
{
if($x==null)
{
$page=$_GET['page'];
}
else
{
$page=$x;    
}
switch($page)
{
    case 'accueil':
        afficheAccueil();
        break;
    
    case 'panneau':
        if(isset($_POST['login'],$_POST['mdp']))
        {
        $log=htmlspecialchars($_POST['login']);
        $mp=htmlspecialchars($_POST['mdp']); 
        login($log,$mp);
        }
        if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==3)
            {
                require_once('vue/vue.php');
            }
            if($_SESSION['type']==1)
            {
                Header('refresh:0;url=index.php?page=adminPanneauClient');
            }
        }
        else
        {
            Header('refresh:0;url=index.php?page=accueil');
        }
        break;
    
    case 'inscription':
       
       $verif=null; if(isset($_POST['nom_inscription'],$_POST['prenom_inscription'],$_POST['telephone_inscription'],$_POST['email_inscription'],$_POST['pseudo_inscription'],$_POST['mdp_inscription'],$_POST['mdpconf_inscription']))
        {
        $nom=htmlspecialchars($_POST['nom_inscription']);
        $prenom=htmlspecialchars($_POST['prenom_inscription']);
        $tel=htmlspecialchars($_POST['telephone_inscription']);
        $email=htmlspecialchars($_POST['email_inscription']);
        $pseudo=htmlspecialchars($_POST['pseudo_inscription']);
        $mdp=htmlspecialchars($_POST['mdp_inscription']);
        $mdpconf=htmlspecialchars($_POST['mdpconf_inscription']);
        $verif=inscription($nom,$prenom,$tel,$email,$pseudo,$mdp,$mdpconf);
        }
        if($verif==1)
        {
            require_once('vue/Page_inscription_reussi.php');
        }
        else
        {
            Header('refresh:0;url=index.php?page=accueil');
        }
        break;
        
    case 'adminPanneauClient':
        
        if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==1)
            {
                $info=adminInfoClient();
                require_once('vue/panneauControleClient.php');
            }
        }
        break;
 
        
        
        
        
    }
    
}



if(isset($_GET['page']))
{
    route(null);
}

else
{
   
    Header('Location: index.php?page=accueil');
}
