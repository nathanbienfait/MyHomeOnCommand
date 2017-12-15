<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleSupportClient.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <title>MyHomeOnCommand</title>
    </head>
    <?php include('vue/header.php');?>
    <body>
        <div id="corps">
    	   <?php include('vue/menuClient.php');?>

    	   <div id="CorpTexte">
                <form>
                    <input type="search" id="maRecherche" name="q" placeholder="Recherche">
                </form>
               <div id="contactSupport">
                    <a id="textcontact" href="mailto:support@domeisep.com">contactez le support</a>
               </div>
               <div>
                    <?php 
                        $questionsreponses=tableauqr();
                        $taille=count($questionsreponses);
                        $x=0;
                        while ($x < $taille - 1)
                        {
                            echo '<p class="groupeq"><strong>QUESTION: </strong><br>'.$questionsreponses[$x].'</p><p class="grouper"><strong>REPONSE: </strong><br>'. $questionsreponses[$x+1]."</p>";
                            $x=$x + 2;
                        }
                    ?>
               </div>
                
    	   </div>
        </div>

    </body>
    <?php include('vue/footer.php');?>
</html>