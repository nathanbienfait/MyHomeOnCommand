<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleMessagerie.css" />
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
           include('vue/menuOperateur.php');
           ?>

            <div id="corpsTexte">

                <?php foreach($tabou as $truc): ?>

                    <div class="boiteR">        <!-- Il faut bien prendre la class boiteR pour contenu_q puisque c'est le CSS utilisé pour le client,
                                                on fait donc le symétrique en inversant comme ça -->
                            <?php echo nl2br($truc['contenu_q']); ?>
                        </div>

                    <?php
                    if ($truc['contenu_r'] !== NULL)    //N'afficher la réponse que si elle n'est pas vide
                        {
                    ?>
                    <div class="boiteQ">
                        <?php echo nl2br($truc['contenu_r']); ?>
                    </div>
                    <?php
                        }
                    ?>                        
                    
                <?php endforeach ?>
                
                <form method="post" id="formR">
                    <textarea name="textR" id="textR" rows="7" cols="50" placeholder="Saisissez-votre question ici"></textarea>
                    <input type="hidden" name="idCurrentClient" value=<?php echo $tabou[0]['id_utilisateur'];?>>
                    <input type="hidden" name="bouton_lobby_repondre" value="bouton_lobby_repondre">
                    <input name="bouton_repondre" class="Bouton" type="submit" value="Envoyer">
                </form>

            </div>

        </div>

    </body>

    <?php
    include('vue/footer.php');
    ?>

</html>
