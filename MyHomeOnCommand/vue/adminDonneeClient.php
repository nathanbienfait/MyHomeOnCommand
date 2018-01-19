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
                 
                   <th>Identifiant</th>
                   <th>Id du client</th>
                   
               </tr>
               
        <?php 
            $taille=sizeof($info);
            $x=0;
            while($x<$taille)
            {
                echo " <div id='modal_".$info[$x+7]."'class='modal'>
                          <div class='modal-content'>
                            <span class='close' id='close_".$info[$x+7]."' >&times;</span>
                                <form class='connexion' method='post' action='index.php?page=adminPanneauClient'>
                                    <label for='prenom'>Prénom</label><br><input type='text' id='prenom' name='prenom' value='".$info[$x]."' required/><br><br>
                                    <label for='nom'>Nom</label><br><input type='text' id='nom' name='nom' value='".$info[$x+1]."' required/><br><br>
                                    <label for='email'>Email</label><br><input type='text' id='email' name='email' value='".$info[$x+2]."' /><br><br>
                                    <label for='telephone'>Téléphone</label><br><input type='text' id='telephone' name='telephone' value='".$info[$x+3]."' /><br><br>
                                    <label for='type'>Type</label><br><input type='text' id='type' name='type' value='".$info[$x+4]."' required/><br><br>
                                    <label for='pseudo'>Identifiant</label><br><input type='text' id='pseudo' name='pseudo' value='".$info[$x+5]."' required/><br><br>
                                    <input type='text' id='idClient' name='idClient' value='".$info[$x+7]."' style='visibility:hidden;'required/><br>
                                    <input type='submit' value='Modifier' name='bouton_modifier' style='width:10%;' />
                                </form>
                                <form method='post' action='index.php?page=adminPanneauClient'>
                                    <input type='text' id='idClient' name='idClient' value='".$info[$x+7]."' style='visibility:hidden;'required/><br>
                                    <input type='submit' class='.suppr' value='Supprimer' name='bouton_supprimer' style='width:10%;' />
                                </form>
                          </div>
                        </div>
                        ";
                echo "  <tr>
                            <td>".$info[$x]."</td>
                            <td>".$info[$x+1]."</td>
                            <td>".$info[$x+2]."</td>
                            <td>".$info[$x+3]."</td>
                            
                            <td>".$info[$x+5]."</td>
                            <td>".$info[$x+7]."</td>
                            <td style='border: none;'><button class='bouton_aff_modal' data-modal='modal_".$info[$x+7]."'>Modifier</button></td>
                        ";
                $x=$x+8;
            }       
        ?>
        </table>
        </div>
        
        </div>
        <?php include('vue/footer.php');?>
        <script>
            var boutonSuppr=document.querySelectorAll(".suppr");
            boutonSuppr.forEach(function(bouton){
                bouton.onclick=function(){
                    return confirm('Confirmez la suppression? Cela entrainera la suppression des entitées dépendentes.');
                }
            })
            
            var boutonsAffModal=document.querySelectorAll(".bouton_aff_modal");
            boutonsAffModal.forEach(function(bouton){
                bouton.onclick=function(){
                    var modal=bouton.getAttribute('data-modal');
                    document.getElementById(modal).style.display='block';
                }
            })
            
            var boutonsFermer=document.querySelectorAll(".close");
            boutonsFermer.forEach(function(bouton){
                bouton.onclick=function(){
                    var modal=bouton.closest('.modal');
                    modal.style.display='none';
                }
            })
            
            window.onclick = function(event){
                if(event.target.className== "modal")
                    {
                        event.target.style.display='none';
                        
                    }
            }
        </script>
    </body>
</html>
