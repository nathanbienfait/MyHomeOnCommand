<script src="https://use.fontawesome.com/584565f215.js"></script>
<div id="bandeau_accueil">
    <div id="logo"><a href="index.php?page=<?php if(isset($_SESSION['type'])){if($_SESSION['type']==3){echo "panneau";}if($_SESSION['type']==1){echo "adminPanneauClient";}}else{echo "accueil";} ?>" title="Accueil"><img id="imagelogo" src="images/logo.png" alt="Logo de MyHomeOnCommand" /></a></div>
        <div id="titre">
    <?php 
        // Permet d'afficher le slogan (qui est modifiable depuis un compte admin
        echo afficheslogan();
            
        if(isset($_SESSION['prenom']))
        {
            if($_SESSION['type']==3)//si l'utilisateur est un client on affiche un message avec son prénom/nom dans le bandeau
            {
                $info=infoBandeau($_SESSION['id']);
                echo "</br></br><div id='sousTitre'>Bonjour ".$info['prenom']." ". $info['nom']."</div>";
                $verif=verifInfoClient();
                if($verif==1)//si le client n'a pas rempli toutes ses infos on affiche un bouton qui lui notifie en afficheant une modal
                {
                    $texte='Veuillez completer les informations de votre profil dans l\'onglet "Gestion du profil"';
                    echo "<div id='annonce'><button id='Bouton'><i class='fa fa-exclamation-triangle' aria-hidden='true'>&nbsp&nbspNotification</i></button></div>";
                }
            
            }
            if($_SESSION['type']==1)//si l'utilisateur est un admin on affiche un message avec son identifant dans le bandeau
            {
                echo "</br></br><div id='sousTitre'>Bonjour administrateur ".$_SESSION['prenom']."</div>";
            }
            
        }
        
    ?>
    </div>
    
</div>
<div id="modalverif" class="modal"><!-- on crée une modal qui contient un message pour l'utilisateur si besoin !-->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p><?php echo $texte; ?></p>
  </div>
</div>
<script>
    // on gère l'affichage de la modal et sa fermeture
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
