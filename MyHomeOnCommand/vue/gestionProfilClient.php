<!DOCTYPE html>
<html>
	<head>
		<title>Gestion du profil</title>
		<link rel="stylesheet" href="css/gestionProfilClient.css" />
		<link rel="stylesheet" href="css/styleMenu.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
       
        <meta charset="utf-8" />
    </head>

<?php
include("Header.php");
?>

    <body>
        <div id="flex">
    	   <?php            
                include("menuClient.php");
            ?>
            <section id="fondBlanc">

                <div id="Box1">

                    <div id="infoBlock1">
                        <p class="infoTitre">Informations personnelles </p>

                        <?php
                        echo '

                            <div id="Forms">
                                <form method="post">
                           
                                <p> Identifiant : </p>
                                <input type="text" name="login" value="'.$tab[0].'" />
                                </br>
                                <p> Mot de passe : </p>
                                <input type="password" name="password" value="'.$tab[1].'" />
                                </br>
                                <p> Prénom : </p>
                                <input type="text" name="prenom" value="'.$tab[2].'" />
                                </br>
                                <p> Nom : </p>
                                <input type="text" name="nom" value="'.$tab[3].'" />
                                </br>
                                <p> e-mail : </p>
                                <input type="text" name="email" value="'.$tab[4].'" />
                                </br>
                                <p> Téléphone : </p>
                                <input type="text" name="telephone" value="'.$tab[5].'"/>
                                </br>
                                </br>
                                <input class="Bouton" type="submit" value="Valider les changements" name="clientValiModifsInfo" />

                            </div>
                        ';
                        ?>

                    </div>
                </div>
            </section>
        </div>
    </body>
    
<?php
include("Footer.php");
?>

</html>

