<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <link rel="stylesheet" href="css/styleReinitialisation.css" />
        <title>MyHomeOnCommand</title>
    </head>
    
    <body>
    <div id="corpsTexte">
        <?php 

        if(isset($verif))
                {
                    if($verif==1)
                    {
                        echo "<script> alert('Votre mot de passe a été modifié')</script>";
                        require_once('vue/accueil.php');
                    }
                    elseif ($verif===2) 
                    {
                        echo "<script> alert('Les mots de passe ne correspond pas')</script>";
                    }
                } ?>
        <?php include('vue/header.php');?>
        <form id="formulaire" method="post" action="index.php?page=reinitialisation&clef=<?php echo($_GET['clef']); ?>">
    	<p>Entrez votre nouveau mot de passe : <input type="password" name="mdp">
        </p>
    	<p>Confirmez le mot de passe : <input type="password" name="mdpverif">
        </p>
        <input id='submit' type="submit">
        </form>
    </div>
   	</body>
    <?php include('vue/footer.php');?>
</html>