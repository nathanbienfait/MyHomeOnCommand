<!DOCTYPE html>                                     <!--Cette page s'affiche quand l'inscription n'a pas rencontré de problème -->
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleInscriptionReussie.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
       
        <title>MyHomeOnCommand</title>
    </head>
    
    <body>
        <?php include('vue/header.php');?>
        <div id="corps">
        <br/>

            <div id="Box1">                                 <!--Boite dans l'aquelle s'affiche le message de bienvenue -->
                <p class="bienvenue"> Bienvenue ! </p>  
                <br/>
                <p class="decalTextDroite"> Votre inscription s'est déroulée sans souci. </p>
                <p class="decalTextDroite"> Vous pouvez maintenant retourner à l'accueil et vous connecter : <a href="index.php?page=accueil" class="lienRetour">Accueil</a> </p>           <!-- Lien pour retourner à l'accueil -->
            </div>
        </div>
        <?php include('vue/footer.php');?>
    </body>
</html>
