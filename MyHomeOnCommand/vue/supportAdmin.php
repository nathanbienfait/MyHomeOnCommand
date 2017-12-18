<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleSupportAdmin.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        
        <title>MyHomeOnCommand</title>
    </head>
    <?php include('vue/header.php');?>
    <body>
    <div id="flex">
           <?php include('vue/menuAdmin.php');?>

           <div id="CorpTexte">
                <form>
                    <input type="search" id="maRecherche" name="q" placeholder="Recherche">
                </form>
            <div>
                
            </div>
               <div>
                    
                    <?php 
                        $questionsreponses=tableauqr();
                        $taille=count($questionsreponses);
                        $x=0;
                        while ($x < $taille-1)
                        {
                            echo '
                                <div class="qrBouton">
                                    <table class="groupeq">
                                        <tr>
                                            <td><strong>QUESTION: </strong><br>'.$questionsreponses[$x].'</td>
                                        </tr>
                                        <tr>
                                            <td><strong>REPONSE: </strong><br>'. $questionsreponses[$x+1].'</td>
                                        </tr>
                                    </table>
                                    <form class="bouton" action="index.php?page=supportAdmin" method="Post">
                                        <input class="png" type="image" src="images/delete.png" name="supprimer" value='.$questionsreponses[$x+2].'>
                                        <input class="png2" type="image" src="images/edit.png" name="edit" value='.$questionsreponses[$x+2].'>
                                        
                                    </form>
                                    

                                </div>';
                            $x=$x + 3;
                        }
                        
                    ?>
                
               </div>
                
           </div>
    </div>
    </body>
    <?php include('vue/footer.php');?>
</html>
