<?php
function afficheAccueil()
{
    if(isset($_SESSION['prenom']))//Si une session existe, elle est détruit, cela permet de déconnecter un utilisateur
    {
        session_unset();
        session_destroy();
    }
    if(isset($_POST['email'])) //Permet de vérifier si le client à rentré une adresse Mail pour modifier son mot de passe
                {
                      
                    $verifMail=NULL; //Variable qui va indiquer si le Mail correspond à un client
                    $verifMail=htmlspecialchars(verifierMail($_POST['email'])); //Renvoie vers la fonction qui verifie le mail
                    if ($verifMail == NULL ) {
                        echo "<script>alert('Votre Mail ne correspond pas');</script>";
                    }
                    elseif ($verifMail == 1) {
                    $to=htmlspecialchars($_POST['email']); //destinataire du mail (le mail du client)
                    $subject = "Reinitalisation mot de passe MyHomeOnCommand"; //Objet du mail
                    $token = gettoken(htmlspecialchars($_POST['email']))->fetch(); //crée un token, personnalisé permettant de changer le mot de passe de manière sécurisée
                    $message = "Bonjour, vous avez demandé une réinitialisation de votre mot de passe,
Vous pouvez reinitialiser votre mot de passe via ce lien : http://localhost/myhomeoncommand/index.php?page=reinitialisation&clef=".$token['token'];
                    mail($to,$subject,$message);
                        echo "<script>alert('Mail envoyé');</script>";

                    }
                }
    require_once('vue/accueil.php');//affiche la vue de la page d'accueil
    
}

function affichePanneau()//Fonction qui gère les types de connexions et qui redirige vers la bonne page en fonction du type de connection
{
    if(isset($_POST['login'],$_POST['mdp']))
        {
        $log=htmlspecialchars($_POST['login']);
        $mp=htmlspecialchars($_POST['mdp']); 
        login($log,$mp);//appelle la fonction qui permet de connecter un utilisateur
        }
        if(isset($_SESSION['type']))//En fonction du type de session, 1 pour admin, 2 pour support, 3 pour client, on affiche la bonne vue
        {
            if($_SESSION['type']==3)
            {
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
            Header('refresh:0;url=index.php?page=accueil');// au cas où une erreur ce produit lors de la connexion, on redirige vers la apge d'accueil
        }
}

function afficheInscription()// fonction qui gere les inscriptions
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
        $verif=inscription($nom,$prenom,$tel,$email,$pseudo,$mdp,$mdpconf);// on appelle la fonction du controleur qui se charge de l'inscription
        }
        if($verif==1)// si la focntion retourne 1, l'inscription a réussi et on affiche la vue qui en informe l'utilisateur
        {
            require_once('vue/inscriptionReussie.php');
        }
        else// sinon on redirige vers la page d'accueil
        {
            Header('refresh:0;url=index.php?page=accueil');
        }
}

function afficheAdminPanneauClient()// fonction qui se charge de l'affichage du panneau client de l'admin
{
    if(isset($_SESSION['type']))// on vérifie qu'une session existe
        {
            if($_SESSION['type']==1)// on vérifie que la session appartient bien à un admin
            {
                
                if(isset($_POST['bouton_modifier']))//si un bouton modifier est utilisé on appelle la fonction du controleur qui permet de modifier les informations d'un client
                {
                   adminModifInfoClient(htmlspecialchars($_POST['prenom']),htmlspecialchars($_POST['nom']),htmlspecialchars($_POST['email']),htmlspecialchars($_POST['telephone']),htmlspecialchars($_POST['type']),htmlspecialchars($_POST['pseudo']),htmlspecialchars($_POST['idClient']));
                
                }
                if(isset($_POST['bouton_supprimer']))//si un bouton supprimer est utilisé on appelle la focntion qui permet de supprimer un utilisateur
                {
                    supprimerClient($_POST['idClient']);
                }
            
                $info=adminInfoClient();//appelle la fonction du controleur qui renvoit les informations de tous les clients
                require_once('vue/adminDonneeClient.php');
            }
        }
}

function afficheGestionHabitationClient()
{
    if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==3)// on vérifie que la session est bien celle d'un client
            {
                if(isset($_POST['bouton_modifier_logement']))
                {
                    $nom=htmlspecialchars($_POST['nom']);
                    modifierNomLogement($nom,$_POST['id']);//appelle de la fonction qui modifie le nom d'un logement 
                }
                if(isset($_POST['bouton_modifier_piece']))
                {
                    $nom=htmlspecialchars($_POST['nom']);
                    modifierNomPiece($nom,$_POST['id']);//appelle de la fonction qui modifie le nom d'une pièce
                }
                if(isset($_POST['bouton_modifier_cemac']))
                {
                    $nom=htmlspecialchars($_POST['nom']);
                    modifierNomCemac($nom,$_POST['id']);//appelle de la fonction qui modifie le nom d'un cemac
                }
                if(isset($_POST['bouton_modifier_equipement']))
                {
                    $nom=htmlspecialchars($_POST['nom']);
                    modifierNomEquipement($nom,$_POST['id']);//appelle de la fonction qui modifie le nom d'un équipement
                }
                if(isset($_POST['bouton_supprimer_equip']))
                {
                    supprimerEquipement($_POST['id']);//appelle de la fonction qui supprime un équipement
                }
                if(isset($_POST['bouton_supprimer_cemac']))
                {
                    supprimerCemac($_POST['id']);//appelle de la fonction qui supprime un cemac
                }
                if(isset($_POST['bouton_supprimer_piece']))
                {
                    supprimerPiece($_POST['id']);//appelle de la fonction qui supprime une pièce
                }
                if(isset($_POST['bouton_supprimer_logement']))
                {
                    supprimerLogement($_POST['id']);//appelle de la fonction qui supprime un logement
                }
                $logements=nomLogement($_SESSION['id']);//liste de tous les logements de l'utilisateur
                $pieces=nomPiece($_SESSION['id']);//liste de toutes les pièces de l'utilisateur
                $cemacs=nomCemac($_SESSION['id']);//liste de tous les cemacs de l'utilisateur
                $equipements=nomEquipement($_SESSION['id']);//liste de tous les équipements de l'utilisateur
                require_once('vue/gestionHabitation.php');//afiche la vue 
            }
        }
}

function afficheAjouterHabitation()
{
    if(isset($_SESSION['type']))
        {
            if($_SESSION['type']==3)// on vérifie que la session est bien celle d'un client
            {
                if(isset($_POST['bouton_ajouter_logement']))//if qui permet l'ajout d'un logement
                {
                  
                    $nomLogement=htmlspecialchars($_POST['nomLogement']);
                    $rueLogement=htmlspecialchars($_POST['rue']);
                    $villeLogement=htmlspecialchars($_POST['ville']);
                    $cpLogement=htmlspecialchars($_POST['cp']);
                    $paysLogement=htmlspecialchars($_POST['pays']);
                    ajouterLogement($_SESSION['id'],$nomLogement,$rueLogement,$villeLogement,$cpLogement,$paysLogement);//appelle de la fonction du controleur qui ajoute un logement
                }
                
                if(isset($_POST['bouton_ajouter_piece']))//if qui permet l'ajout d'une pièce
                {
                    $idLogement=htmlspecialchars($_POST['nomLogementPiece']);
                    $nomPiece=htmlspecialchars($_POST['nomPiece']);
                    ajouterPiece($idLogement,$nomPiece);//appelle de la fonction du controleur qui ajoute une pièce
                }
                if(isset($_POST['bouton_ajouter_cemac']))//if qui permet l'ajout d'un cemac
                {
                    $nomCemac=htmlspecialchars($_POST['nomCemac']);
                    ajouterCemac($_POST['nomPieceCemac'],$nomCemac);//appelle de la fonction du controleur qui ajoute un cemac
                }
                
                if(isset($_POST['bouton_ajouter_equipement']))//if qui permet l'ajout d'un équipement
                {
                    $nomEquip=htmlspecialchars($_POST['nomEquipement']);
                    ajouterEquipement($_POST['nomCemacEquipement'],$_POST['typeEquipement'],$nomEquip);//appelle de la fonction du controleur qui ajoute un équipement
                }
                $tableauNomLogement=nomLogement($_SESSION['id']);//liste des logements de l'utilisateur pour remplir les listes des formulaires
                $tableauNomPiece=nomPiece($_SESSION['id']);//liste des pièces de l'utilisateur pour remplir les listes des formulaire
                $tableauNomCemac=nomCemac($_SESSION['id']);//liste des cemacs de l'utilisateur pour remplir les listes des formulaire
                $tableauNomType=nomTypeEquipement();//liste des types d'equipement disponibles pour remplir les listes des formulaire
                
                require_once('vue/ajouterHabitation.php');//affiche la vue
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
                
                if(isset($_POST['boutton_supprimer'])) //Test si l'administrateur veut supprimer une question/réponse
                {
                    supprimerqr($_POST['boutton_supprimer']); //permet d'effectuer la fonction effaçant les questions/réponses
                }
                 
                if(isset($_POST['edit2'])) //Test si l'administrateur veut modifier une question/réponse
                {
                    modifqr($_POST['edit2'],htmlspecialchars($_POST['modifr']),htmlspecialchars($_POST['modifq']));  //permet d'effectuer la fonction modifiant les questions/réponses
                }

                if(isset($_POST['envoitAjout'])) //Test si l'administrateur veut ajouter une question/réponse
                {
                    $dateQ= date("Y-n-j");
                    $dateR = date("Y-n-j");
                    ajouterqr(htmlspecialchars($_POST['ajoutQ']),htmlspecialchars($_POST['ajoutR']),$dateQ,$dateR); //permet d'effectuer la fonction ajoutant les questions/réponses
                    
                }
                $tableauqr=tableauqr(); //Fonction récupérant les questions/réponses de la Base de donnée
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

function afficheModificationMdpClient()
{
    if (isset($_SESSION['type']))
    {
        if($_SESSION['type']==3)
        {
            if(isset($_POST['clientValiModifMdp'])) 
            {
                clientModifMdp(htmlspecialchars($_POST['oldMdp']),htmlspecialchars($_POST['newMdp']),htmlspecialchars($_POST['confNewMdp'])); 
            }

            require_once('vue/modificationMdpClient.php');
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

function afficheModification() // on prépare les variables utiles pour toutes les actions de la page gestion du site 
{
    $extensions=array('.png', '.jpg', '.gif');
    
    if(isset($_POST['bouton_valider_slogan']))
        {
            $slog=htmlspecialchars($_POST['Modifier_le_slogan']);
            afficheModif($slog);
        }

        if(isset($_POST['bouton_valider_equipement'])) /* prépare les variables pour l'ajout d'un type d'équipement dans la bdd */
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

            if(!empty($_FILES['logo']['name']) AND in_array(strrchr($_FILES['logo']['name'], '.'), $extensions)) /* on crée une variable contenant la nouvelle adresse des images et on les y envoie */
            {
                $adresseLogo='images/' . $_FILES['logo']['name'];
                $verif=move_uploaded_file($_FILES['logo']['tmp_name'], $adresseLogo);
            }
            if(!empty($_FILES['image_fond']['name']) AND in_array(strrchr($_FILES['image_fond']['name'], '.'), $extensions)) /* de même */
            {
                $adresseImageFond='images/' . $_FILES['image_fond']['name'];
                $verif=move_uploaded_file($_FILES['image_fond']['tmp_name'], $adresseImageFond);
            }
            if(!in_array(strrchr($_FILES['logo']['name'], '.'), $extensions))
            {
                echo "<script>alert('Format du fichier pour le logo invalide. Veuillez mettre un fichier de type jpg, gif ou png.')</script>";
            }
            if(!in_array(strrchr($_FILES['image_fond']['name'], '.'), $extensions))
            {
                echo "<script>alert('Format du fichier pour l'image de fond invalide. Veuillez mettre un fichier de type jpg, gif ou png.')</script>";
            }

            adminAfficheEquipement($nom_equipement, $unite, $type_donnees, $adresseLogo, $adresseImageFond, $messageEtatHaut, $messageEtatBas); /* on appelle une fonction du controleurAdmin */
        }
    
        if(isset($_POST['bouton_valider_nouvelleCarac'])) /* prépare les variables pour modifier les caractéristiques d'un type d'équipement dans la bdd */
        {
            $idTypeCapteur=$_POST['idTypeCapteur'];
            $caracEquipement=$_POST['caracSelec'];
            $nouvelleCarac="";

            if(isset($_POST['nouvelleCarac']))
            {
                $nouvelleCarac=$_POST['nouvelleCarac'];
                adminModifTypeEquipement($idTypeCapteur, $caracEquipement, $nouvelleCarac);
            }
            elseif(in_array(strrchr($_FILES['nouvelleCarac']['name'], '.'), $extensions))
            {
                $nouvelleCarac='images/' . $_FILES['nouvelleCarac']['name'];
                $verif=move_uploaded_file($_FILES['nouvelleCarac']['tmp_name'], $nouvelleCarac);
                adminModifTypeEquipement($idTypeCapteur, $caracEquipement, $nouvelleCarac);
            }
            else
            {
                echo "<script>alert('Veuillez vérifier que les informations saisies sont correctes')</script>";
            }
        }
    
        if(isset($_POST['bouton_valider_selecTypeSupp'])) /* prépare les variables pour la suppression d'un type d'équipement dans la bdd */
        {
            $idTypeEquipement=$_POST['typeEquipementSupp'];
            adminSuppTypeEquipement($idTypeEquipement);
        }

        if(isset($_POST['bouton_valider_admin']))
        {
            $id=htmlspecialchars($_POST['login_admin']);
            $mdp=htmlspecialchars($_POST['password_admin']);
            $mdpVerif=htmlspecialchars($_POST['password_admin_verif']);
            afficheAdmin($id,$mdp,$mdpVerif);
        }

        if(isset($_POST['bouton_valider_op']))
        {
            $id=htmlspecialchars($_POST['login_op']);
            $mdp=htmlspecialchars($_POST['password_op']);
            $mdpVerif=htmlspecialchars($_POST['password_op_verif']);
            afficheOp($id,$mdp,$mdpVerif);
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
    
        if(isset($_POST['bouton_valider_contact']))
        {
            $telephone=htmlspecialchars($_POST['telephone_contact']);
            $mail=htmlspecialchars($_POST['mail_contact']);
            $adresse=htmlspecialchars($_POST['adresse_contact']);
            afficheContact($telephone,$mail,$adresse);
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
                if ($tab==NULL)
                {
                    $premierMessage = 1;
                }
                else
                {
                    $premierMessage =NULL;
                }
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
        $verif=modifMdpReinitialisation(htmlspecialchars($_POST['mdp']),htmlspecialchars($_POST['mdpverif']),$id['id_utilisateur']);
        require_once('vue/reinitialisation.php');
    }
    else
    {
        require_once('vue/reinitialisation.php');
    }   
    
}
