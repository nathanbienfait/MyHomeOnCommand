<!DOCTYPE html>
<html>                      <!-- Cette page sert à regrouper toutes les questions sans réponses des clients et à y répondre en cliquant sur un bouton -->
    <head>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleMessagerie.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />

        <meta charset="utf-8"/>
        <meta http-equiv="refresh" content="120"> <!--Rafraichit la page automatiquement la page toutes les 2minutes pour que l'opérateur n'ai pas à le faire-->
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
                    '; //Si aucune question d'un client n'est sans réponse, le lobby étant vide, on affiche ce message
                }
                ?>
                <?php foreach($tab as $item): ?>

                    <p class="blacktext">Question posée par <?php echo nl2br($item['prenom']); ?> <?php echo nl2br($item['nom']) ?> : </p> 

                                                                                    <!--On affiche le nom et prénom du client posant la question -->
                    <div class="boiteNewQuest">
                        <?php echo nl2br($item['contenu_q']);               //On affiche le contenu de la question ?>
                    </div>
                    <form method="post">
                        <input type="hidden" name="id_name" value=<?php echo $item['id_utilisateur']; 
                                            //On met la value en hidden pour qu'elle n'apparaisse pas et qu'on puis quand même l'envoyer via le bouton ?>> 
                        <input name="bouton_lobby_repondre" class="bouton_lobby_repondre" type="submit" value="Répondre">
                                                <!-- On envoie l'id du client auquel on veut répondre dans le controleurRoute -->
                    </form>

                <?php endforeach ?>

            </div>

        </div>

    </body>

    <?php
    include('vue/footer.php');
    ?>

</html>
