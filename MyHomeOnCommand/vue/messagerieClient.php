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

                <?php foreach($tab as $truc): ?>
                    <div class="boiteQ">
                        <?php echo nl2br($truc['contenu_q']); ?>
                    </div>

                    <?php
                    if ($truc['contenu_r'] !== NULL)    //N'afficher la réponse que si elle n'est pas vide
                        {
                    ?>
                        <div class="boiteR">
                            <?php echo nl2br($truc['contenu_r']); ?>
                        </div>
                    <?php
                        }
                    ?>
                <?php endforeach ?>
                
                <form method="post" id="formQ">
                    <textarea name="textQ" id="textQ" rows="7" cols="50" placeholder="Saisissez-votre question ici"></textarea>
                    <input name="Bouton_question" class="Bouton" type="submit" value="Envoyer">
                </form>

            </div>

        </div>

    </body>

    <?php
    include('vue/footer.php');
    ?>

</html>
