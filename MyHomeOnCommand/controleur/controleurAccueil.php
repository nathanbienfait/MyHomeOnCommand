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
            $clef = password_hash($nom,PASSWORD_DEFAULT); //génère le token permettant par la suite au client de modifier son mot de passe en cas d'oublis
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

function afficheTextCond()
{
    $affiche=new InscriptionUtilisateur;
    $cond =$affiche->getCond();
    $cond=$cond->fetch()[0];
    return $cond;
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

function afficheAdmin($id,$mdp,$mdpVerif)
{
    if (isset ($_POST['login_admin'],$_POST['password_admin']))
    {
        if($mdp == $mdpVerif)
        {
            echo"<script>alert('Administrateur ajouté');</script>";
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

        else
            {
                echo "<script>alert('Les deux mots de passe ne sont pas les mêmes');</script>";
            }

    }
}

function afficheOp($id,$mdp,$mdpVerif)
{
   if (isset ($_POST['login_op'],$_POST['password_op']))
    {
        if($mdp == $mdpVerif)
        {
            echo"<script>alert('Opérateur ajouté');</script>";
            $verif=0;
        
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

        else
            {
                echo "<script>alert('Les deux mots de passe ne sont pas les mêmes');</script>";
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

function afficheCond($texte_cond)
{
    if (!empty($_POST['texte_cond']))
    {
        $affiche=new InscriptionUtilisateur;
        $cond=$affiche->ajoutCond($texte_cond);
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
