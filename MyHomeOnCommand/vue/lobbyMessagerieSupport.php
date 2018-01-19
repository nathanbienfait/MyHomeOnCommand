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

                <?php 
                if ($tab==NULL)
                {
                    echo '
                    <p name="noNewMessage" class="noNewMessage"> Vous n\'avez aucune nouvelle question. </p>
                    ';
                }
                ?>
                <?php foreach($tab as $item): ?>

                    <p class="blacktext">Question posée par <?php echo nl2br($item['prenom']); ?> <?php echo nl2br($item['nom']) ?> : </p>
                    <div class="boiteNewQuest">
                        <?php echo nl2br($item['contenu_q']); ?>
                    </div>
                    <form method="post">
                        <input type="hidden" name="id_name" value=<?php echo $item['id_utilisateur']; ?>>
                        <input name="bouton_lobby_repondre" class="bouton_lobby_repondre" type="submit" value="Répondre">
                    </form>
                <?php endforeach ?>

            </div>

        </div>

    </body>

    <?php
    include('vue/footer.php');
    ?>

</html>
