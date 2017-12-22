<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleSupportClient.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />

        <meta charset="utf-8"/>
        <title>MyHomeOnCommand</title>
    </head>

    <?php
    include('vue/header.php');
    ?>

    <body>

        <div id="corps">

    	   <?php
           include('vue/menuClient.php');
           ?>

            <div id="CorpTexte">
                

                    <div class="boiteQ">
                        <p> Bonjour je pose une question, pourrais-je avoir une réponse?</p>
                    </div>

                    <div class="boiteR">
                        <p> Bonjour, bien sûr, voilà votre réponse, sombre filou. JE vous  ici même une réponse pas piquée des hannetons qui devrait s'étendre sur 2 ou 3 lignes pour voir comment ca rend sur le site et pour voir si je peux enfin passer au php ou si je reste sur le site comme ca. Enfin bon voyons ce que ca donne maintenant. </p>
                    </div>


                <form method="post" action="" id="formQ">
                    <textarea name="textQ" id="textQ" rows="7" cols="50" placeholder="Saisissez-votre question ici"></textarea>
                    <input class="Bouton" type="Button" class="submit" value="Envoyer">

                </form>

            </div>
            <div id="restrictionBoites">
                </div>

        </div>

    </body>

    <?php
    include('vue/footer.php');
    ?>

</html>