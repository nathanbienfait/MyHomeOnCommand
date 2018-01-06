<script src="https://use.fontawesome.com/584565f215.js"></script>
<div id="bandeau_accueil">
    <div id="logo"><a href="index.php?page=<?php if(isset($_SESSION['type'])){if($_SESSION['type']==3){echo "panneau";}if($_SESSION['type']==1){echo "adminPanneauClient";}}else{echo "accueil";} ?>" title="Accueil"><img id="imagelogo" src="images/logo.png" alt="Logo de MyHomeOnCommand" /></a></div>

        <div id="titre">A connected home in a connected world
    <?php 
        if(isset($_SESSION['prenom']))
        {
            if($_SESSION['type']==3)
            {
                
                $bdd = new PDO('mysql:host=localhost;dbname=myhomeoncommand;charset=utf8', 'root', '');
                $reponse=$bdd->query('SELECT contenu FROM slogan');
                while ($donnees = $reponse->fetch())
                {
                    echo $donnees['contenu'];
                }
                $reponse->closeCursor();


                $info=infoBandeau($_SESSION['id']);
                echo "</br></br><div id='sousTitre'>Bonjour ".$info['prenom']." ". $info['nom']."</div>";
                $verif=verifInfoClient();
                if($verif==1)
                {
                    $texte='Veuillez completer les informations de votre profil dans l\'onglet "Gestion du profil"';
                    echo "<div id='annonce'><button id='Bouton'><i class='fa fa-exclamation-triangle' aria-hidden='true'>&nbsp&nbspNotification</i></button></div>";
                }
            
            }

            if($_SESSION['type']==1)
            {
              $bdd = new PDO('mysql:host=localhost;dbname=myhomeoncommand;charset=utf8', 'root', '');
                $reponse=$bdd->query('SELECT contenu FROM slogan');
                while ($donnees = $reponse->fetch())
                {
                    echo $donnees['contenu'];
                }
                $reponse->closeCursor();
                ?>

            <div id='basHeader'>  

                <div id='bonjour'>
                <br/><br/>
                <?php
                echo "Bonjour administrateur ".$_SESSION['prenom']." ";
                ?>
                </div>

                <div id='modifier'>
                <br/><br/>
                <form method='POST' action='index.php?page=adminPanneauClient'>
                    <input type="text" id="modif" name="Modifier_le_slogan" required placeholder="Modifier le slogan"/>
                    <input type="submit" id="valider" value="Valider" name="bouton_valider" />
                </form>
                </div>

            </div>  
            <?php 
            }
            
        }
        
    ?>
    </div>
    
</div>
<div id="modalverif" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p><?php echo $texte; ?></p>
  </div>
</div>
<script>
        var modal = document.getElementById('modalverif');
        var btn = document.getElementById("Bouton");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
</script>
<div id='bandeau_invisible'></div>
