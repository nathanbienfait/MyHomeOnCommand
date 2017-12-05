<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/Style_General.css" />
        <link rel="stylesheet" href="css/SupportClient.css" />
        <link rel="stylesheet" type="text/css" href="css/Menu6.css">
        <link rel="stylesheet" type="text/css" href="css/headerFooter2.css">
        <title>MyHomeOnCommand</title>
    </head>
    <?php include('Header.php');?>
    <body>
        <div id="flex">
    	   <?php include('menuClient.php');?>

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
                        while ($x < $taille)
                        {
                            echo '<p class="groupeq"><strong>QUESTION: </strong><br>'.$questionsreponses[$x].'</p><p class="grouper"><strong>REPONSE: </strong><br>'. $questionsreponses[$x+1]."</p>";
                            $x=$x + 2;
                        }
                    ?>
               </div>
                
    	   </div>
        </div>

    </body>
    <?php include('Footer.php');?>
</html>