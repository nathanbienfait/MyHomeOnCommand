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
           include('vue/menuClient.php');
           ?>

            <div id="corpsTexte">

                <?php 
                    if ($premierMessage == 1)    /*Si aucune question n'a encore été posée (si $tab est vide), $premierMessage a la valeur de 1 et on affiche
                                                donc un message expliquant que faire ici */
                    {
                    ?>
                        <div class="boiteQ">
                            <p> Vous n'avez pas encore posé de question. Vous pouvez poser votre première question juste en dessous. Pensez toutefois à vérifier que votre question n'a pas déjà été posée sur notre page FAQ. </p>
                        </div>
                    <?php
                    }
                    ?>

                <?php foreach($tab as $truc):  //Pour chaque élément (contenu_q et contenu_r) fetched avec visuMessagerieClient dans controleurMessagerieClient ?>

                        <div class="boiteQ">
                            <?php echo nl2br($truc['contenu_q']); //On affiche une question contenu_q ?>   
                        </div>


                    <?php
                    if ($truc['contenu_r'] !== NULL)    //N'afficher la réponse que si elle n'est pas vide
                        {
                    ?>
                        <div class="boiteR">
                            <?php echo nl2br($truc['contenu_r']); //On affiche la réponse contenu_r correspondante à sa contenu_q ?>
                        </div>
                    <?php
                        }
                    ?>
                <?php endforeach ?>
                
                <form method="post" id="formQ">
                    <textarea name="textQ" id="textQ" rows="7" cols="50" placeholder="Saisissez-votre question ici"></textarea> 
                    <input name="Bouton_question" class="Bouton" type="submit" value="Envoyer">     <!-- On envoie à controleurRoute le message du form --> 
                </form>

            </div>

        </div>

    </body>

    <?php
    include('vue/footer.php');
    ?>

</html>
