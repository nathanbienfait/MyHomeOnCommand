<?php
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
            $clef = password_hash($nom,PASSWORD_DEFAULT);
            $utilisateur->setInfoUtilisateur($prenom,$nom,$email,$tel,'client',$id['id_utilisateur'],$clef);
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
function afficheTextPres()
{
    $affiche=new InscriptionUtilisateur;
    $pres =$affiche->getPres();
    $pres=$pres->fetch()[0];
    return $pres;
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
        
        $verif=0;
        $utilisateur=new InscriptionUtilisateur;
        $listeLogin=$utilisateur->getLoginUtilisateurs();
        while($liste=$listeLogin->fetch())
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
}

function afficheOp($id,$mdp)
{
    if (isset ($_POST['login_op'],$_POST['password_op']))
    {
        
        $verif=0;
        $utilisateur=new InscriptionUtilisateur;
        $listeLogin=$utilisateur->getLoginUtilisateurs();
        while($liste=$listeLogin->fetch())
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
}

function affichePres($texte_pres)
{
    if (!empty($_POST['texte_pres']))
    {
        $affiche=new InscriptionUtilisateur;
        $pres =$affiche->ajoutPres($texte_pres);
        return $pres;
    }
}

function verifierMail($mail)
{
    $utilisateur=new LoginUtilisateur;
    $recupMail=$utilisateur->verifMail()->fetchAll();
    $verifEmail = NULL;
    foreach ($recupMail as $testMail) {
        if($mail == $testMail['email'])
        {
            $verifEmail = 1;
        }
    }
    return $verifEmail;

}
function gettoken($mail)
{
    $utilisateur=new LoginUtilisateur;
    $token=$utilisateur->getClef($mail);
    return $token;
}

function modifMdpReinitialisation($mdp,$mdpVerif,$id)
{
    $verif=0;
    if($mdp==$mdpVerif)
    {
        $verif=1;
        $utilisateur=new InscriptionUtilisateur;
        $criptedMdp=password_hash($mdp,PASSWORD_DEFAULT);
        $utilisateur->setNewMdp($criptedMdp,$id);
    }
    else
    {
        $verif=2;
    }
    return $verif;
}

function getIdReinitialisation($token)
{
    $utilisateur=new InscriptionUtilisateur;
    $id_client=$utilisateur->getIdToken($token)->fetch();
    return $id_client;    
}
