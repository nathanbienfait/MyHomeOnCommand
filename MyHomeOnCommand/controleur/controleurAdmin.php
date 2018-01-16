<?php

function afficheAccueil()
{
    if(isset($_SESSION['prenom']))
    {
        session_unset();
        session_destroy();
    }
    require_once('vue/accueil.php');
    
}
function login($login,$mdp)
{
   
    
    $utilisateur=new LoginUtilisateur;
    $verification=$utilisateur->getAuthentification();
    while($verif=$verification->fetch())
    {
        if($verif['login']==$login)
        {
            if(password_verify($mdp,$verif['password']))
            {
                
                $_SESSION['prenom'] = $verif['login'];
                $_SESSION['mdp'] = $verif['password'];
                $_SESSION['id'] = $verif['id_utilisateur'];
                $_SESSION['type'] = $verif['id_type_utilisateur'];
                
            }
            
        }
    }
    if(!isset($_SESSION['prenom'],$_SESSION['mdp'],$_SESSION['id'],$_SESSION['type']))
    {
        erreur("L'authentification a échoué");
    }  
}

function inscription($nom,$prenom,$tel,$email,$pseudo,$mdp,$mdpconf)
{
    if($mdp==$mdpconf)
    {
        $verif=0;
        $utilisateur=new InscriptionUtilisateur;
        $listeLogin=$utilisateur->getLoginUtilisateurs();
        while($liste=$listeLogin->fetch())
        {
            
            if($liste['login']==$pseudo)
            {
                
                $verif=1;
                
                
            }
        }
        
        if ($verif==0)
        {
            
            $criptedMdp=password_hash($mdp,PASSWORD_DEFAULT);
            $utilisateur->setUtilisateur($pseudo,$criptedMdp);
            $idUtil=$utilisateur->getIdUtilisateur($pseudo);
            $id=$idUtil->fetch();
            $utilisateur->setInfoUtilisateur($prenom,$nom,$email,$tel,'client',$id['id_utilisateur']);
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


function erreur($message)
{
    echo "<script>alert(\"".$message."\")</script>";
    
}

function infoBandeau($idClient)
{
    $utilisateur=new LoginUtilisateur;
    $info=$utilisateur->getInfoUtilisateur($idClient);
    $information=$info->fetch();
    return $information;
}

function afficheslogan()
{
    $affiche=new InscriptionUtilisateur;
    $slogan =$affiche->getSlogan();
    $slogan=$slogan->fetch()[0];
    return $slogan;
}

function afficheModif($slog)
{
    if (!empty($_POST['Modifier_le_slogan']))
    {
        $affiche=new InscriptionUtilisateur;
        $modifslogan =$affiche->modifSlogan($slog);
        return $modifslogan;  
    }
    
}

function afficheCapteur($capteur)
{
    if (!empty($_POST['Ajouter_un_capteur']))
    {
        $affiche=new InscriptionUtilisateur;
        $ajoutCapteur =$affiche->ajoutCapteur($capteur);
        return $ajoutCapteur;
    }
}

function afficheAdmin($id,$mdp)
{
    if (isset ($_POST['login_admin'],$_POST['password_admin']))
    {
        $criptedMdp=password_hash($mdp,PASSWORD_DEFAULT);
        $affiche=new InscriptionUtilisateur;
        $ajoutAdmin =$affiche->ajoutAdmin($id,$criptedMdp);
        return $ajoutAdmin;
    }
}

function afficheOp($id,$mdp)
{
    if (isset ($_POST['login_op'],$_POST['password_op']))
    {
        $criptedMdp=password_hash($mdp,PASSWORD_DEFAULT);
        $affiche=new InscriptionUtilisateur;
        $ajoutAdmin =$affiche->ajoutOp($id,$criptedMdp);
        return $ajoutAdmin;
    }
}


