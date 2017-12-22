<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <link rel="stylesheet" href="css/styleAdminDonneeClient.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <title>MyHomeOnCommand</title>
    </head>
    
    <body>
        
        <?php include('vue/header.php');?>
        <div id='corps'>
        <?php include('vue/menuAdmin.php');?>
       
            <div id='tableau'>
            <table>
               

               <tr>
                   <th>Prénom</th>
                   <th>Nom</th>
                   <th>Email</th>
                   <th>Téléphone</th>
                   <th>Type</th>
                   <th>Pseudo</th>
                   <th>Id du client</th>
                   
               </tr>
               
        <?php 
            $taille=sizeof($info);
            $x=0;
            while($x<$taille)
            {
                echo " <div id='modal_".$info[$x+7]."'class='modal'>
                          <div class='modal-content'>
                            <span id='close_".$info[$x+7]."' >&times;</span>
                                <form class='connexion' method='post' action='index.php?page=adminPanneauClient'>
                                    <input type='text' id='prenom' name='prenom' value='".$info[$x]."' required/>
                                    <input type='text' id='nom' name='nom' value='".$info[$x+1]."' required/>
                                    <input type='text' id='email' name='email' value='".$info[$x+2]."' />
                                    <input type='text' id='telephone' name='telephone' value='".$info[$x+3]."' />
                                    <input type='text' id='type' name='type' value='".$info[$x+4]."' required/>
                                    <input type='text' id='pseudo' name='pseudo' value='".$info[$x+5]."' required/>

                                    <input type='text' id='idClient' name='idClient' value='".$info[$x+7]."' required/>
                                    <input type='submit' value='Modifier' name='bouton_modifier' />
                                </form>
                          </div>
                        </div>
                        ";
                echo "  <tr>
                            <td>".$info[$x]."</td>
                            <td>".$info[$x+1]."</td>
                            <td>".$info[$x+2]."</td>
                            <td>".$info[$x+3]."</td>
                            <td>".$info[$x+4]."</td>
                            <td>".$info[$x+5]."</td>
                            <td>".$info[$x+7]."</td>
                            <td style='border: none;'><button id='".$info[$x+7]."' type='button'>Modifier</button></td>
                        ";
                echo "  <script>
                            var modal".$info[$x+7]." = document.getElementById('modal_".$info[$x+7]."');
                            var btn".$info[$x+7]." = document.getElementById('".$info[$x+7]."');
                            var span".$info[$x+7]." = document.getElementById('close_".$info[$x+7]."');
                                
                                    btn".$info[$x+7].".onclick = function() {
                                    modal".$info[$x+7].".style.display = 'block';

                                }

                                    span".$info[$x+7].".onclick = function() {
                                        modal".$info[$x+7].".style.display = 'none';
                                    }
                                    window.onclick = function(event) {
                                        if (event.target == modal".$info[$x+7].") {
                                            modal".$info[$x+7].".style.display = 'none';
                                        }
                                    }


                        </script>
                
                        ";
                $x=$x+8;
            }
        ?>
        </table>
        </div>
        
        </div>
        <?php include('vue/footer.php');?>

<script>
        var modal = document.getElementByClassName('modal');
        var btn = document.getElementsByClassName('bouton_modal_modif');
        var span = document.getElementsByClassName("close");
        var x=0;
        while(x<btn.length)
            {
                btn[x].onclick = function() {
                modal[x].style.display = "block";

                }
                
                span[x].onclick = function() {
                    modal[x].style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == modal[x]) {
                        modal[x].style.display = "none";
                    }
                }
                x++;
            }
        

</script>
    </body>
</html>
