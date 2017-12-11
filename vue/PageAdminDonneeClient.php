<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/Style_General.css" />
        <link rel="stylesheet" href="css/headerFooter.css" />
        <link rel="stylesheet" href="css/Style_adminDonneeClient.css" />
        <link rel="stylesheet" href="css/Menu.css" />
        <title>MyHomeOnCommand</title>
    </head>
    
    <body>
        
        <?php include('vue/Header.php');?>
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
                   <th>Mot de Passe</th>
                   <th>Id du client</th>
                   
               </tr>
               
        <?php 
            $taille=sizeof($info);
            $x=0;
            while($x<$taille)
            {
                echo "  <tr>
                        <form class='connexion' method='post' action='index.php?page=adminPanneauClient'>
                            <td><input type='text' id='prenom' name='prenom' value='".$info[$x]."' required/></td>
                            <td><input type='text' id='nom' name='nom' value='".$info[$x+1]."' required/></td>
                            <td><input type='text' id='email' name='email' value='".$info[$x+2]."' required/></td>
                            <td><input type='text' id='telephone' name='telephone' value='".$info[$x+3]."' required/></td>
                            <td><input type='text' id='type' name='type' value='".$info[$x+4]."' required/></td>
                            <td><input type='text' id='pseudo' name='pseudo' value='".$info[$x+5]."' required/></td>
                            <td><input type='text' id='mdp' name='mdp' value='".$info[$x+6]."' required/></td>
                            <td><input type='text' id='idClient' name='idClient' value='".$info[$x+7]."' required/></td>
                            <td><input type='submit' value='Modifier' name='bouton_modifier' />  </td>
                        </form>
                        </tr>
                        ";
                
                $x=$x+8;
            }
        ?>
        </table>
        </div>
        
        </div>
        <?php include('vue/Footer.php');?>
            
    </body>
</html>
