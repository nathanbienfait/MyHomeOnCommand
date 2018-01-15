<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleAccueil.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        
        
        <title>MyHomeOnCommand</title>
    </head>
    
    <body>
        <?php include('vue/header.php');?>
        <div id="corps">
        <div id="barre_gauche_accueil">
            <div id="description_accueil">
                <p>Qui sommes-nous?</p>
            </div>
            <div id="contact_accueil">
                <p>Contact</p>
            </div>
        </div>
        <div id="partie_droite">    
            <div class="formulaire">
                <form id="connexion" method="post" action="index.php?page=panneau">
                    <p>Connexion:</p>
                    <p>
                        <label for="login">Identifiant:</label>
                        </br>
                        <input type="text" id="login" name="login" required/>
                        </br>
                        </br>
                        <label for="mdp">Mot de passe:</label>
                        </br>
                        <input type="password" id="mdp" name="mdp" required/>
                        </br>
                        </br>
                        <input type="submit" value="Se Connecter" name="bouton_connexion" />  
                    </p>
                </form>
            </div>

            <div class="formulaire">
                <form id="inscription" name="inscription" method="post" action="index.php?page=inscription">
                    <p>Formulaire d'inscription:</p>
                    <p>
                        <label for="nom_inscription">Nom:</label>
                        </br>
                        <input type="text" id="nom_inscription" name="nom_inscription" required/>
                        </br>
                        </br>
                        <label for="prenom_inscription">Prénom:</label>
                        </br>
                        <input type="text" id="prenom_inscription" name="prenom_inscription" required/>
                        </br>
                        </br>
                        <label for="pseudo_inscription">Identifiant:</label>
                        </br>
                        <input type="text" id="pseudo_inscription" name="pseudo_inscription" required/>
                        </br>
                        </br>
                        <label for="mdp_inscription">Mot de passe:</label>
                        </br>
                        <input type="password" id="mdp_inscription" name="mdp_inscription" required/>
                        </br>
                        </br>
                        <label for="mdpconf_inscription">Confirmer le mot de passe:</label>
                        </br>
                        <input type="password" id="mdpconf_inscription" name="mdpconf_inscription" required/>
                        </br>
                        </br>
                        <input type="checkbox" name="checkconditions"required/>
                        <label for="checkconditions">J'accepte les <span id='myBtn' style='color:blue; text-decoration:underline;'>conditions d'utilisation</span></label>
                        </br>
                        </br>
                        <input type="submit" value="S'inscrire" name="bouton_inscription"/>  
                    </p>
                </form>
            </div>
        
        </div>
    </div>
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Conditions légales d'utilisation</p>
  </div>
</div>
    <?php include('vue/footer.php');?>
    <script>
        document.inscription.onsubmit = function()
        {
            return confirm('Confirmez votre inscriptions?');
        }       
        var modal = document.getElementById('modal');
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[1];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        console.log(span);
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    </body>
</html>
