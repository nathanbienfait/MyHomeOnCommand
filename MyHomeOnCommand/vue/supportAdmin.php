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
        <script>
            function show($x)
            {
                if ($x==2)
                {
                    return confirm('Voulez-vous supprimer cette question ?');
                }
                else if ($x==1)
                {
                    return confirm('Voulez-vous modifier cette question ?');
                }
            }
            
        </script>
    <div id="flex">
           <?php include('vue/menuAdmin.php');?>

           <div id="CorpTexte">
                <form action="index.php?page=supportAdmin">
                    <input type="search" id="maRecherche" name="q" placeholder="Recherche" action="index.php?page=supportAdmin">
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
                            if (isset($_POST['edit']) && $_POST['edit'] == $questionsreponses[$x+2])
                            {
                                echo '
                                <form method="Post" action="index.php?page=supportAdmin">
                                <div class="qrBouton">
                                    <table class="groupeq">
                                        <tr>
                                            <td><strong>QUESTION: </strong><textarea class="modif" name="modifq">'.$questionsreponses[$x].'</textarea></td>
                                        </tr>
                                        <tr>
                                            <td><strong>REPONSE: </strong><textarea class="modif" name="modifr">'. $questionsreponses[$x+1].'</textarea></td>
                                        </tr>
                                    </table>

                                        <input id="edit" onclick="return show(1); " class="png2" type="image" src="images/edit.png" name="edit2" value='.$questionsreponses[$x+2].'>
                                </form>        

                                    

                                </div>';
                            }
                            else
                            {
                            echo '
                                <div class="qrBouton">
                                    <table class="groupeq">
                                        <tr>
                                            <td><strong>QUESTION: </strong><br>'.nl2br($questionsreponses[$x]).'</td>
                                        </tr>
                                        <tr>
                                            <td><strong>REPONSE: </strong><br>'.nl2br($questionsreponses[$x+1]).'</td>
                                        </tr>
                                    </table>
                                    <form class="bouton" action="index.php?page=supportAdmin" method="Post" name="action" >
                                        <input class="png" onclick="return show(2); " type="image" src="images/delete.png" name="supprimer" value='.$questionsreponses[$x+2].' ></form>
                                    <form class="bouton" action="index.php?page=supportAdmin" method="Post" name="action" >
                                        <input id="edit" class="png2" type="image" src="images/edit.png" name="edit" value='.$questionsreponses[$x+2].'>
                                        
                                    </form>
                                    

                                </div>';
                            }
                            $x=$x + 3;
                             
                        }
                        
                    ?>
                
               </div>

           </div>
    </div>
    <script>
  
</script>
    </body>
    <?php include('vue/footer.php');?>
</html>
