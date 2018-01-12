<?php
session_start();

require_once('controleur/controleurAccueil.php');
require_once('controleur/controleurAdmin.php');
require_once('controleur/controleurClient.php');
require_once('controleur/controleurSupport.php');
require_once('modele/modeleAccueil.php');
require_once('modele/modeleAdmin.php');
require_once('modele/modeleClient.php');
require_once('modele/modeleSupport.php');
require_once('modele/modelePanneaucapteursClient.php');
require_once('controleur/controleurGestionProfilClient.php');
require_once('modele/modeleGestionProfilClient.php');



function route()
{

$page=$_GET['page'];
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
                $vue='panneaucontroleClient';
                $title='Vos capteurs';
                $entete= 'Les capteurs de votre domicile' . '' . $_SESSION['prenom'];
                $id_logements=Obtenir_id_logements($_SESSION['id']);
                require_once('controleur/controleurPanneaucapteursClient.php');
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
            require_once('vue/inscriptionReussi.php');
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
                
                if(isset($_POST['bouton_modifier']))
                {
                   adminModifInfoClient($_POST['prenom'],$_POST['nom'],$_POST['email'],$_POST['telephone'],$_POST['type'],$_POST['pseudo'],$_POST['mdp'],$_POST['idClient']);
                
                }
                
                // Modifier le slogan
                if (!empty($_POST['Modifier_le_slogan']))
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=myhomeoncommand;charset=utf8', 'root', '');
                    $req=$bdd->prepare('UPDATE slogan SET contenu = ? WHERE id_slogan = 1');
                    $req->execute (array( $_POST["Modifier_le_slogan"] ));
                 }
            
                $info=adminInfoClient();
                require_once('vue/adminDonneeClient.php');
            }
        }
        break;
        
    case 'gestionHabitationClient':
        
        if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==3)
            {
                $id_logements=Obtenir_id_logements($_SESSION['id']);
                require_once('vue/gestionHabitation.php');
            }
        }
        break;
        
    case 'ajouterHabitation':
        
        if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==3)
            {
                if(isset($_POST['bouton_ajouter_logement']))
                {
                  
                    $nomLogement=htmlspecialchars($_POST['nomLogement']);
                    $rueLogement=htmlspecialchars($_POST['rue']);
                    $villeLogement=htmlspecialchars($_POST['ville']);
                    $cpLogement=htmlspecialchars($_POST['cp']);
                    $paysLogement=htmlspecialchars($_POST['pays']);
                    ajouterLogement($_SESSION['id'],$nomLogement,$rueLogement,$villeLogement,$cpLogement,$paysLogement);
                }
                
                if(isset($_POST['bouton_ajouter_piece']))
                {
                    $idLogement=htmlspecialchars($_POST['nomLogementPiece']);
                    $nomPiece=htmlspecialchars($_POST['nomPiece']);
                    ajouterPiece($idLogement,$nomPiece);
                }
                if(isset($_POST['bouton_ajouter_cemac']))
                {
                    $nomCemac=htmlspecialchars($_POST['nomCemac']);
                    ajouterCemac($_POST['nomPieceCemac'],$nomCemac);
                }
                
                if(isset($_POST['bouton_ajouter_equipement']))
                {
                    $nomEquip=htmlspecialchars($_POST['nomEquipement']);
                    ajouterEquipement($_POST['nomCemacEquipement'],$_POST['typeEquipement'],$nomEquip);
                }
                $tableauNomLogement=nomLogement($_SESSION['id']);
                $tableauNomPiece=nomPiece($_SESSION['id']);
                $tableauNomCemac=nomCemac($_SESSION['id']);
                $tableauNomType=nomTypeEquipement();
                
                require_once('vue/ajouterHabitation.php');
            }
        }
        break;
        
    case 'consommationClient':
        if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==3)
            {
                require_once('vue/consommationClient.php');
            }
        }
        break;
        
    case 'consommationAdmin':
         if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==1)
            {
                require_once('vue/consommationAdmin.php');
            }
        }
        break;
        
    case 'supportClient':

        if (isset($_SESSION['type']))
        {
            if ($_SESSION['type']==3) 
            {
                $tableauqr=tableauqr();
                require_once('vue/supportClient.php');
            }
        }
        break;

        case 'supportAdmin':

        if (isset($_SESSION['type']))
        {
            if ($_SESSION['type']==1) 
            {
                
                if(isset($_POST['boutton_supprimer']))
                {
                    supprimerqr($_POST['boutton_supprimer']);
                }
                 
                if(isset($_POST['edit2']))
                {
                    modifqr($_POST['edit2'],$_POST['modifr'],$_POST['modifq']); 
                }

                if(isset($_POST['envoitAjout']))
                {
                    ajouterqr($_POST['ajoutQ'],$_POST['ajoutR'],$_POST['dateQ'],$_POST['dateR']);
                }
                $tableauqr=tableauqr();
                require_once('vue/supportAdmin.php');
            }        
        
        }
        break;
    case 'gestionProfilClient' :
    
    	if (isset($_SESSION['type']))
    	{
    		if($_SESSION['type']==3)
    		{
    			
    			if(isset($_POST['clientValiModifsInfo'])) 
                {
                    clientModifInfoClient($_POST['login'],$_POST['password'],$_POST['prenom'],$_POST['nom'],$_POST['email'],$_POST['telephone']); 
                }
    			
    			$tab=clientVisuProfilClient(); //Fonction pour préremplir les formulaires de gestionProfilClient
    			require_once('vue/gestionProfilClient.php');
    			
    		}
    	}
        break;
        
    case 'mentionsLegales':
        require_once('vue/mentionsLegales.php');
        break;
        
    case 'conditions':
        require_once('vue/conditionsUtilisation.php');
        break;


 
}
    
}







if(isset($_GET['page']))
{
    route();
}

else
{
   
    Header('Location: index.php?page=accueil');
}
