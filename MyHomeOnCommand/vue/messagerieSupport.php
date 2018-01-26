<!DOCTYPE html>
<html>                <!--Cette page est très similaire à messagerieClient : pour plus d'informations, ce réferer aux commentaires sur celle-ci -->
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
                    <textarea name="textR" id="textR" rows="7" cols="50" placeholder="Saisissez-votre réponse ici"></textarea>
                    <input type="hidden" name="idCurrentClient" value=<?php echo $tabou[0]['id_utilisateur']; //On transmet l'id en hidden à controleurRoute?>>
                    <input type="hidden" name="bouton_lobby_repondre" value="bouton_lobby_repondre">
                                    <!--On envoie également en hidden ce bouton_lobby_repondre pour rester dans la première boucle if dans controleurRoute -->
                    <input name="bouton_repondre" class="Bouton" type="submit" value="Envoyer">
                </form>

            </div>

        </div>

    </body>

    <?php
    include('vue/footer.php');
    ?>

</html>
