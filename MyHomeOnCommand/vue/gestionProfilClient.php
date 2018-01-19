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
                        <p class="infoTitre">Informations personnelles :</p>


                            <div id="Forms">
                                <form method="post" name="formModif" >
                           
                                <p> Identifiant : </p>
                                <input type="text" name="login" value="<?php echo $tab[0] ?>" onblur="verifNom(this)" required/>
                                </br>
                                <p> Prénom : </p>
                                <input type="text" name="prenom" value="<?php echo $tab[2] ?>" onblur="verifNom(this)" required/>
                                </br>
                                <p> Nom : </p>
                                <input type="text" name="nom" value="<?php echo $tab[3] ?>" onblur="verifNom(this)" required/>
                                </br>
                                <p> e-mail : </p>
                                <input type="text" name="email" value="<?php echo $tab[4] ?>" onblur="verifMail(this)" />
                                </br>
                                <p> Téléphone : </p>
                                <input type="text" name="telephone" value="<?php echo $tab[5] ?>" onblur="verifTel(this)" />
                                </br>
                                </br>
                                <input class="bouton" type="submit" value="Valider les changements" name="clientValiModifsInfo" />
                            </div>

                            <p class="infoTitre2"> Mot de passe : </p>
                            </br>
                            <div id="FormsMdp">
                                <a href="index.php?page=modificationMdpClient" class="boutonMdp" name="clientModifMdp"> Modifier le mot de passe </a>
                            </div>

                    </div>
                </div>
            </section>
        </div>
    
    
    <?php
    include("footer.php");
    ?>

    <script>
        function surligne(champ, erreur)
        {
           if(erreur)
              champ.style.backgroundColor = "#fba";
           else
              champ.style.backgroundColor = "";
        }

        function verifNom(champ)
        {
            if(champ.value.length < 2 || champ.value.length >30)
           {
              surligne(champ, true);
              return false;
           }
           else
           {
              surligne(champ, false);
              return true;

           }
        }

        function verifMail(champ)
        {
            if ((champ.value.indexOf('@') == -1) || (champ.value.indexOf('.') == -1))
            {
                surligne(champ, true);
                return false;
            }
            else
            {
                surligne(champ, false);
                return true;
            }
        }

        function verifTel(champ)
        {
            if (champ.value.length < 7 || champ.value.length > 14 || (isNaN(champ.value) == true))
            {
                surligne(champ, true);
                return false;
            }
            else
            {
                surligne(champ, false);
                return true;
            }
        }

        function verifForm(f)
        {
            var identifiantOk = verifNom(f.login);
            var nomOk = verifNom(f.nom);
            var prenomOk = verifNom (f.prenom);
            var emailOk = verifMail (f.email);
            var telOk = verifTel (f.telephone);
            if(nomOk && prenomOk && identifiantOk && emailOk && telOk)
            {
                return true;
            }
            else
            {
                alert("Veuillez remplir correctement tous les champs");
                return false;
            }
        }

        document.formModif.onsubmit = function()
        {
            return verifForm(this);
        }

    </script>

    </body>

</html>

