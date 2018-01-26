<?php
function login($login,$mdp)//gère la connexion des utilisateurs
{
    $utilisateur=new LoginUtilisateur;// crée une classe pour pouvoir faire appelle aux fonctions du modèle associées à cette classe
    $verification=$utilisateur->getAuthentification();// appelle de la fonction du modèle qui renvoi la liste des utilisateurs et leur mdp
    while($verif=$verification->fetch())//pour chaque utilisateur
    {
        if($verif['login']==$login)//on vérifie si un login correspond à celui entrer par l'utilisateur
        {
            if(password_verify($mdp,$verif['password']))//on vérifie si le mdp correspond à celui entrer, on utilise la focntion password_verify car les mdp sont criptés dans la BDD
            {
                //on crée les variables de session si l'utilisateur s'est connecté avec succès
                $_SESSION['prenom'] = $verif['login'];
                $_SESSION['mdp'] = $verif['password'];
                $_SESSION['id'] = $verif['id_utilisateur'];
                $_SESSION['type'] = $verif['id_type_utilisateur'];
                
            }
            
        }
    }
    if(!isset($_SESSION['prenom'],$_SESSION['mdp'],$_SESSION['id'],$_SESSION['type']))//si la session n'est pas créé, la connexion a échoué
    {
        erreur("L'authentification a échoué");
    }  
}
function inscription($nom,$prenom,$tel,$email,$pseudo,$mdp,$mdpconf)//gère les inscriptions
{
    if($mdp==$mdpconf)//si les mdp entrés correspondent
    {
        $verif=0;
        $utilisateur=new InscriptionUtilisateur;// crée une classe pour pouvoir faire appelle aux fonctions du modèle associées à cette classe
        $listeLogin=$utilisateur->getLoginUtilisateurs();// on récupère tous les identifiants déjà créés
        while($liste=$listeLogin->fetch())//pour chaque identifiant
        {
            
            if($liste['login']==$pseudo)// on vérifie que l'identifiant n'a pas déjà été pris
            {
                
                $verif=1;
                
                
            }
        }
        
        if ($verif==0)
        {
            
            $criptedMdp=password_hash($mdp,PASSWORD_DEFAULT);//on cripte le mdp
            $utilisateur->setUtilisateur($pseudo,$criptedMdp);//on fait appelle a la focntion du modèle qui permet d'enregistrer un nouvel utilisateur
            $idUtil=$utilisateur->getIdUtilisateur($pseudo);// on récupère l'id de l'utilisateur pour enregistrer les infos de l'utilisateur dans une autre table
            $id=$idUtil->fetch();
            $clef = password_hash($nom,PASSWORD_DEFAULT); //génère le token permettant par la suite au client de modifier son mot de passe en cas d'oublis
            $utilisateur->setInfoUtilisateur($prenom,$nom,$email,$tel,'client',$id['id_utilisateur'],$clef);// on enregistre les infos de l'utilisateur
            return 1;
            
        }
        if($verif==1)
        {
            erreur("Votre pseudo n'est pas disponible");
        }
    }
    else
    {
        erreur("Les mots de passe ne correspondent pas");
    }
    return 0;
}

function erreur($message)// génére des messages d'erreur
{
    echo "<script>alert(\"".$message."\")</script>";
    
}
function infoBandeau($idClient)// focntion qui permet d'afficher une notification dans le bandeau si l'utilisateur n'a pas entré toutes ses infos
{
    $utilisateur=new LoginUtilisateur;
    $info=$utilisateur->getInfoUtilisateur($idClient);
    $information=$info->fetch();
    return $information;
}
function afficheslogan() // permet d'aficher le slogan lors de son appel
{
    $affiche=new InscriptionUtilisateur;
    $slogan =$affiche->getSlogan();
    $slogan=$slogan->fetch()[0];
    return $slogan;
}

function afficheTextPres() // permet d'afficher le texte de présentation
{
    $affiche=new InscriptionUtilisateur;
    $pres =$affiche->getPres();
    $pres=$pres->fetch()[0];
    return $pres;
}

function afficheTextCond() // permet d'afficher les conditions d'utilisation
{
    $affiche=new InscriptionUtilisateur;
    $cond =$affiche->getCond();
    $cond=$cond->fetch()[0];
    return $cond;
}

//les trois fonctions suiantes permettent d'afficher les coordonnées de Domisep
function afficheTextTel()
{
    $affiche=new InscriptionUtilisateur;
    $cond =$affiche->getTel();
    $cond=$cond->fetch()[0];
    return $cond;
}

function afficheTextMail()
{
    $affiche=new InscriptionUtilisateur;
    $cond =$affiche->getMail();
    $cond=$cond->fetch()[0];
    return $cond;
}

function afficheTextAdresse()
{
    $affiche=new InscriptionUtilisateur;
    $cond =$affiche->getAdresse();
    $cond=$cond->fetch()[0];
    return $cond;
}


function afficheModif($slog) // permet de traiter la modification du slogan
{
    if (!empty($_POST['Modifier_le_slogan']))
    {
        $affiche=new InscriptionUtilisateur;
        $modifslogan =$affiche->modifSlogan($slog);
        return $modifslogan;  
    }
    
}

function afficheAdmin($id,$mdp,$mdpVerif) // permet de traiter l'ajout d'un admin
{
    if (isset ($_POST['login_admin'],$_POST['password_admin']))
    {
        if($mdp == $mdpVerif) // permet de vérifier la correspondance des deux mdp
        {
            echo"<script>alert('Administrateur ajouté');</script>";
            $verif=0;
            $utilisateur=new InscriptionUtilisateur;
            $listeLogin=$utilisateur->getLoginUtilisateurs();
            while($liste=$listeLogin->fetch()) // permet de vérifier si l'identifiant n'est pas déjà pris
            {
                if($liste['login']==$id)
                {
                    
                    $verif=1;  
                }
            }
            
            if ($verif==0)
            {
                
                $criptedMdp=password_hash($mdp,PASSWORD_DEFAULT);
                $affiche=new InscriptionUtilisateur;
                $ajoutAdmin =$affiche->ajoutAdmin($id,$criptedMdp);
                return $ajoutAdmin;
                
            }
            if($verif==1)
            {
                erreur("Votre pseudo n'est pas disponible");
            }
        }

        else
            {
                echo "<script>alert('Les deux mots de passe ne sont pas les mêmes');</script>";
            }

    }
}

function afficheOp($id,$mdp,$mdpVerif) // permet de traiter l'ajout d'un opérateur
{
   if (isset ($_POST['login_op'],$_POST['password_op']))
    {
        if($mdp == $mdpVerif) // permet de vérifier la correspondance des deux mdp
        {
            echo"<script>alert('Opérateur ajouté');</script>";
            $verif=0;
        
            $verif=0;
            $utilisateur=new InscriptionUtilisateur;
            $listeLogin=$utilisateur->getLoginUtilisateurs();
            while($liste=$listeLogin->fetch()) // permet de vérifier si l'identifiant n'est pas déjà pris
            {
                
                if($liste['login']==$id)
                {
                    
                    $verif=1;
                    
                    
                }
            }
            
            if ($verif==0)
            {
                
                $criptedMdp=password_hash($mdp,PASSWORD_DEFAULT);
                $affiche=new InscriptionUtilisateur;
                $ajoutOp =$affiche->ajoutOp($id,$criptedMdp);
                return $ajoutOp;
                
            }
            if($verif==1)
            {
                erreur("Votre pseudo n'est pas disponible");
            }
        }

        else
            {
                echo "<script>alert('Les deux mots de passe ne sont pas les mêmes');</script>";
            }

    }
}


function affichePres($texte_pres) // permet de traiter la modification du texte de présentation
{
    if (!empty($_POST['texte_pres']))
    {
        $affiche=new InscriptionUtilisateur;
        $pres =$affiche->ajoutPres($texte_pres);
        return $pres;
    }
}

function afficheCond($texte_cond) // permet de traiter la modification des conditions d'utilisation
{
    if (!empty($_POST['texte_cond']))
    {
        $affiche=new InscriptionUtilisateur;
        $cond=$affiche->ajoutCond($texte_cond);
        return $cond;
    }
}

function afficheContact($telephone,$mail,$adresse) // permet de traiter la modification des coordonnées de Domisep
{
    if (isset($_POST['telephone_contact'],$_POST['mail_contact'],$_POST['adresse_contact']))
    {
        $affiche=new InscriptionUtilisateur;
        $cond=$affiche->ajoutContact($telephone,$mail,$adresse);
        return $cond;
    }
}

function verifierMail($mail) //fonction permettant de vérifier que le mail du client (voulant récupérer son mot de passe) est dans la BDD
{
    $utilisateur=new LoginUtilisateur;
    $recupMail=$utilisateur->verifMail()->fetchAll(); //Appel la fonction SQL récupérant tous les mails de la BDD
    $verifEmail = NULL; //Variable qui va s'activer à 1 seulement si le mail rentré correspond à un mail de la BDD
    foreach ($recupMail as $testMail) {
        if($mail == $testMail['email']) //test du mail dans un boucle, pour le comparer à tous les mails
        {
            $verifEmail = 1;
        }
    }
    return $verifEmail;

}
function gettoken($mail) //fonction permettant de récupérer le token pour le mettre dans l'url du mail envoyé au client ayant perdu son mdp
{
    $utilisateur=new LoginUtilisateur;
    $token=$utilisateur->getClef($mail); //fait appel à la fonction SQL dans le modele
    return $token;
}

function modifMdpReinitialisation($mdp,$mdpVerif,$id) //Fonction permettant de modifier le mot de passe avec l'id (récupéré grâce au token)
{
    $verif=0;
    if($mdp==$mdpVerif) //vérifie que les deux mots de passes concordent
    {
        $verif=1;
        $utilisateur=new InscriptionUtilisateur;
        $criptedMdp=password_hash($mdp,PASSWORD_DEFAULT); //cripte le nouveau mdp
        $utilisateur->setNewMdp($criptedMdp,$id); //Fait appel à la fonction SQL
    }
    else
    {
        $verif=2;
    }
    return $verif;
}

function getIdReinitialisation($token) // Fonction répuérant l'id du client grâce au token présent dans l'url reçu par le client
{
    $utilisateur=new InscriptionUtilisateur;
    $id_client=$utilisateur->getIdToken($token)->fetch(); //Fait appel à la fonction SQL
    return $id_client;    
}
