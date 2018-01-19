<!DOCTYPE html>
<html>
	<head>
		<title>Gestion du profil</title>
		<link rel="stylesheet" href="css/styleGestionProfilClient.css" />
		<link rel="stylesheet" href="css/styleMenu.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
       
        <meta charset="utf-8" />
    </head>

<?php
include("header.php");
?>

    <body>
        <div id="flex">
    	   <?php            
                include("menuClient.php");
            ?>
            <section id="fondBlanc">

                <div id="Box1">

                    <div id="infoBlock1">
                        <p class="infoTitre">Modification du mot de passe :</p>

                        <div id="Forms">
                            <form  method="post" name="formMdp" >

                                <p>Ancien mot de passe :</p>
                                <input type="password" name="oldMdp" required/>
                                </br>
                                <p>Nouveau mot de passe :</p>
                                <input type="password" name="newMdp" required />
                                </br>
                                <p>Confirmer le nouveau mot de passe :</p>
                                <input type="password" name="confNewMdp" required />
                                </br>
                                </br>
                                <input class="bouton" type="submit" value="Valider les changements" name="clientValiModifMdp" />

                            </form>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    
    
    <?php
    include("footer.php");
    ?>