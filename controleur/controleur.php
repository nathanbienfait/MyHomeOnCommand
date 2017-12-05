<?php



function afficheAccueil()
{
    if(isset($_SESSION['prenom']))
    {
        session_unset();
        session_destroy();
    }
    require_once('vue/Page_Accueil.php');
    
}
function login($login,$mdp)
{
   
    
    $utilisateur=new LoginUtilisateur;
    $verification=$utilisateur->getAuthentification();
    while($verif=$verification->fetch())
    {
        if($verif['login']==$login)
        {
            if($verif['password']==$mdp)
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
            $utilisateur->setUtilisateur($pseudo,$mdp);
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

function adminInfoClient()
{
    $admin=new admin;
    
    $tableInfoClient=$admin->getDonneeClient();
    $x=0;
    while($table=$tableInfoClient->fetch())
    {
       
        $tableinfo[$x]=$table['prenom'];
        $tableinfo[$x+1]=$table['nom'];
        $tableinfo[$x+2]=$table['email'];
        $tableinfo[$x+3]=$table['telephone'];
        $tableinfo[$x+4]=$table['statut_utilisateur'];
        $tableinfo[$x+5]=$table['login'];
        $tableinfo[$x+6]=$table['password'];
        $tableinfo[$x+7]=$table['id_utilisateur'];
        $x=$x+8;
        
    }
    
    
    
    return $tableinfo;
}

function adminModifInfoClient($prenom,$nom,$email,$telephone,$type,$pseudo,$mdp,$idClient)
{
    $admin=new admin;
    $admin->modifDonneeClient($prenom,$nom,$email,$telephone,$type,$idClient);
    $admin->modifCompteClient($pseudo,$mdp,$idClient);
    echo "<script>alert(\"Modifications réalisées\")</script>";
    
}
