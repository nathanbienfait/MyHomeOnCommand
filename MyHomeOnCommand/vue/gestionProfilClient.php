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


                            <div id="Forms">                            <!--On crée un formulaire dans lequel on va retrouver toutes les infos du client -->
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

                                <!--Chaque case contient un nom, une valeur qu'on récupère via la fonction clientVisuProfilClient() du controleurGestionProfilClient appellée dans le controleurRoute et un onblur qui met la case en rouge si la case ne contient pas une donnée correcte. On ajoute un required pour les données ne pouvant pas être NULL, forçant ainsi le client à les remplir. Enfin, on trouve un bouton de type submit qui, si il est appuyé, renvoit toutes les valeurs dans le contreurRoute qui fait ensuite appel a la fonction clientModifInfoClient() -->

                            <p class="infoTitre2"> Mot de passe : </p>
                            </br>
                            <div id="FormsMdp">
                                <a href="index.php?page=modificationMdpClient" class="boutonMdp" name="clientModifMdp"> Modifier le mot de passe </a>
                            </div>

                            <!--Ici, on a juste un bouton "modifier le mot de passe" qui est un lien vers la page modifictaionMdpClient.php -->

                    </div>
                </div>
            </section>
        </div>
    
    
    <?php
    include("footer.php");
    ?>

    <script>                                //Fonction qui met une case en rouge si le contenu n'est pas valide 
        function surligne(champ, erreur)
        {
           if(erreur)
              champ.style.backgroundColor = "#fba";
           else
              champ.style.backgroundColor = "";
        }

        function verifNom(champ)        //Fonction qui vérifie si le champ nom/prénom/login crédible
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

        function verifMail(champ)       //Fonction qui vérifie si l'adresse mail rentrée est bien une adresse mail
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

        function verifTel(champ)        //Fonction qui vérifie si le numéro de telephone correspond au normes
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

        function verifForm(f)           //Fonction qui vérifie si les champs sont tous remplis correctement et renvoit true si oui
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

        document.formModif.onsubmit = function()            //Submit si la fonction verifForm renvoit bien true
        {
            return verifForm(this);
        }

    </script>

    </body>

</html>

