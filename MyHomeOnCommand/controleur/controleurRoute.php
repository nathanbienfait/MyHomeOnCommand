<?php
function afficheAccueil()
{
    if(isset($_SESSION['prenom']))
    {
        session_unset();
        session_destroy();
    }
    if(isset($_POST['email']))
                {
                      
                    $verifMail=NULL;
                    $verifMail=htmlspecialchars(verifierMail($_POST['email']));
                    if ($verifMail == NULL ) {
                        echo "<script>alert('Votre Mail ne correspond pas');</script>";
                    }
                    elseif ($verifMail == 1) {
                    $to=htmlspecialchars($_POST['email']);
                    $subject = "Reinitalisation mot de passe MyHomeOnCommand";
                    $token = gettoken(htmlspecialchars($_POST['email']))->fetch();
                    $message = "Bonjour, vous avez demandé une réinitialisation de votre mot de passe,
Vous pouvez reinitialiser votre mot de passe via ce lien : http://localhost/MyHomeOnCommandters/index.php?page=reinitialisation&clef=".$token['token'];
                    mail($to,$subject,$message);
                        echo "<script>alert('Mail envoyé');</script>";

                    }
                }
    require_once('vue/accueil.php');
    
}

function affichePanneau()
{
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
            if($_SESSION['type']==2)
            {
                Header('refresh:0;url=index.php?page=messagerieSupport');
            }
        }
        else
        {
            Header('refresh:0;url=index.php?page=accueil');
        }
}

function afficheInscription()
{
    $verif=null; if(isset($_POST['nom_inscription'],$_POST['prenom_inscription'],$_POST['pseudo_inscription'],$_POST['mdp_inscription'],$_POST['mdpconf_inscription']))
        {
        $nom=htmlspecialchars($_POST['nom_inscription']);
        $prenom=htmlspecialchars($_POST['prenom_inscription']);
        $tel=null;
        $email=null;
        $pseudo=htmlspecialchars($_POST['pseudo_inscription']);
        $mdp=htmlspecialchars($_POST['mdp_inscription']);
        $mdpconf=htmlspecialchars($_POST['mdpconf_inscription']);
        $verif=inscription($nom,$prenom,$tel,$email,$pseudo,$mdp,$mdpconf);
        }
        if($verif==1)
        {
            require_once('vue/inscriptionReussie.php');
        }
        else
        {
            Header('refresh:0;url=index.php?page=accueil');
        }
}

function afficheAdminPanneauClient()
{
    if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==1)
            {
                
                if(isset($_POST['bouton_modifier']))
                {
                   adminModifInfoClient($_POST['prenom'],$_POST['nom'],$_POST['email'],$_POST['telephone'],$_POST['type'],$_POST['pseudo'],$_POST['idClient']);
                
                }
                if(isset($_POST['bouton_supprimer']))
                {
                    supprimerClient($_POST['idClient']);
                }
            
                $info=adminInfoClient();
                require_once('vue/adminDonneeClient.php');
            }
        }
}

function afficheGestionHabitationClient()
{
    if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==3)
            {
                if(isset($_POST['bouton_modifier_logement']))
                {
                    $nom=htmlspecialchars($_POST['nom']);
                    modifierNomLogement($nom,$_POST['id']);
                }
                if(isset($_POST['bouton_modifier_piece']))
                {
                    $nom=htmlspecialchars($_POST['nom']);
                    modifierNomPiece($nom,$_POST['id']);
                }
                if(isset($_POST['bouton_modifier_cemac']))
                {
                    $nom=htmlspecialchars($_POST['nom']);
                    modifierNomCemac($nom,$_POST['id']);
                }
                if(isset($_POST['bouton_modifier_equipement']))
                {
                    $nom=htmlspecialchars($_POST['nom']);
                    modifierNomEquipement($nom,$_POST['id']);
                }
                if(isset($_POST['bouton_supprimer_equip']))
                {
                    supprimerEquipement($_POST['id']);
                }
                if(isset($_POST['bouton_supprimer_cemac']))
                {
                    supprimerCemac($_POST['id']);
                }
                if(isset($_POST['bouton_supprimer_piece']))
                {
                    supprimerPiece($_POST['id']);
                }
                if(isset($_POST['bouton_supprimer_logement']))
                {
                    supprimerLogement($_POST['id']);
                }
                $logements=nomLogement($_SESSION['id']);
                $pieces=nomPiece($_SESSION['id']);
                $cemacs=nomCemac($_SESSION['id']);
                $equipements=nomEquipement($_SESSION['id']);
                require_once('vue/gestionHabitation.php');
            }
        }
}

function afficheAjouterHabitation()
{
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
}

function afficheConsommationClient()
{
    if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==3)
            {
                require_once('vue/consommationClient.php');
            }
        }
}

function afficheConsommationAdmin()
{
    if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==1)
            {
                require_once('vue/consommationAdmin.php');
            }
        }
}

function afficheSupportClient()
{
    if (isset($_SESSION['type']))
        {
            if ($_SESSION['type']==3) 
            {
                $tableauqr=tableauqr();
                require_once('vue/supportClient.php');
            }
        }
}

function afficheSupportAdmin()
{
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
}

function afficheGestionProfilClient()
{
    if (isset($_SESSION['type']))
    	{
    		if($_SESSION['type']==3)
    		{
    			
    			if(isset($_POST['clientValiModifsInfo'])) 
                {
                    clientModifInfoClient($_POST['login'],$_POST['prenom'],$_POST['nom'],$_POST['email'],$_POST['telephone']); 
                }
    			
    			$tab=clientVisuProfilClient(); //Fonction pour préremplir les formulaires de gestionProfilClient
    			require_once('vue/gestionProfilClient.php');
    			
    		}
    	}
}

function afficheMentionsLegales()
{
    require_once('vue/mentionsLegales.php');
}

function afficheConditions()
{
    require_once('vue/conditionsUtilisation.php');
}

function afficheModification()
{
    if(isset($_POST['bouton_valider_slogan']))
        {
            $slog=htmlspecialchars($_POST['Modifier_le_slogan']);
            afficheModif($slog);
        }

        if(isset($_POST['bouton_valider_equipement']))
        {
            $nom_equipement=htmlspecialchars($_POST['Ajouter_un_equipement']);
            $type_donnees=htmlspecialchars($_POST['type_donnees']);
            $unite=htmlspecialchars($_POST['unite']);
            $adresseLogo="";
            $adresseImageFond="";
            $messageEtatHaut="";
            $messageEtatBas="";

            if(!empty($_POST["etat_haut"]))
            {
                $messageEtatHaut=htmlspecialchars($_POST['etat_haut']);
            }

            if(!empty($_POST["etat_bas"]))
            {
                $messageEtatBas=htmlspecialchars($_POST['etat_bas']);
            }

            if(!empty($_FILES['logo']['name']))
            {
                $adresseLogo='images/' . $_FILES['logo']['name'];
                $verif=move_uploaded_file($_FILES['logo']['tmp_name'], $adresseLogo);
            }
            if(!empty($_FILES['image_fond']['name']))
            {
                $adresseImageFond='images/' . $_FILES['image_fond']['name'];
                $verif=move_uploaded_file($_FILES['image_fond']['tmp_name'], $adresseImageFond);
            }

            afficheEquipement($nom_equipement, $unite, $type_donnees, $adresseLogo, $adresseImageFond, $messageEtatHaut, $messageEtatBas);
        }
    
        if(isset($_POST['bouton_valider_nouvelleCarac']))
        {
            $idTypeCapteur=$_POST['idTypeCapteur'];
            $caracEquipement=$_POST['caracSelec'];

            if(!empty($_POST['nouvelleCarac']))
            {
                $nouvelleCarac=$_POST['nouvelleCarac'];
            }
            else
            {
                $nouvelleCarac='images/' . $_FILES['nouvelleCarac']['name'];
                $verif=move_uploaded_file($_FILES['nouvelleCarac']['tmp_name'], $nouvelleCarac);
            }

            adminModifTypeEquipement($idTypeCapteur, $caracEquipement, $nouvelleCarac);
        }

        if(isset($_POST['bouton_valider_admin']))
        {
            $id=htmlspecialchars($_POST['login_admin']);
            $mdp=htmlspecialchars($_POST['password_admin']);
            afficheAdmin($id,$mdp);
        }

        if(isset($_POST['bouton_valider_op']))
        {
            $id=htmlspecialchars($_POST['login_op']);
            $mdp=htmlspecialchars($_POST['password_op']);
            afficheOp($id,$mdp);
        }
        
        if(isset($_POST['bouton_valider_pres']))
        {
        $texte_pres=htmlspecialchars($_POST['texte_pres']);
        affichePres($texte_pres);
        }
    
        if(isset($_POST['bouton_valider_cond']))
        {
        $texte_cond=htmlspecialchars($_POST['texte_cond']);
        afficheCond($texte_cond);
        }

        require_once('vue/modification.php');
}

function afficheMessagerieClient()
{
    if (isset($_SESSION['type']))
        {
            if($_SESSION['type']==3)
            {

                if(isset($_POST['Bouton_question']))
                {
                    postQuestionClient($_POST['textQ']);
                    eviteAttenteSupportDoublon();
                }

                $tab=visuMessagerieClient();
                require_once('vue/messagerieClient.php');
            }
        }
}

function afficheMessagerieSupport()
{
    if (isset($_SESSION['type']))
        {
            if($_SESSION['type']==2)
            {
                if(isset($_POST['bouton_lobby_repondre']))
                {

                    if(isset($_POST['bouton_repondre']))
                    {
                        postReponseSupport($_POST['textR'], $_POST['idCurrentClient']);
                        $_POST['id_name']=$_POST['idCurrentClient'];
                    }
                    
                    $tabou=visuMessagerieSupport($_POST['id_name']);
                    require_once('vue/messagerieSupport.php');

                }

                else
                {
                    $tab=visuLobbyMessagerieSupport();
                    require_once('vue/lobbyMessagerieSupport.php');
                }
            }
        }
}

function afficheSupportOperateur()
{
    if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==2)
            {
                $tableauqr=tableauqr();
                require_once('vue/supportOperateur.php');
            }
        }
}
function afficheReinitialisation()
{

    $clef=$_GET['clef'];
    if(isset($_POST['mdp'],$_POST['mdpverif']))
    {
        
        $verif=NULL;
        $id=getIdReinitialisation($clef);
        $verif=modifMdpReinitialisation($_POST['mdp'],$_POST['mdpverif'],$id['id_utilisateur']);
        require_once('vue/reinitialisation.php');
    }
    else
    {
        require_once('vue/reinitialisation.php');
    }   
    
}
