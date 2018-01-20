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
                <?php
                    echo afficheTextPres();
                ?>
            </div>
            <div id="contact_accueil">
                <p>Contact</p>
            </div>
        </div>
        <div id="partie_droite">    
            <div class="formulaire">
                <div id="connexion">
                <form method="post" action="index.php?page=panneau">
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
                <div id="CorpTexte">
                        <button class="bouton_aff_modal" id="bouton_aff_modal" data-modal="modal1">Mot de passe oublié</button>
                        <div class='modal' id="modal1">
                            <div class='modal-content'>
                                <span class='close' >&times;</span>
                                    <form method="Post" action="index.php?page=accueil">
                                        <p> Votre adresse Mail :</p>
                                        <input type="email" name="email"><br>
                                        <br><input type="submit" name="envoi_mdp_oublié" value="envoyer">
                                    </form>
                            </div>
                        </div>     
                </div>
            </div>
            </div>

            <div class="formulaire">
                <form id="inscription" name="inscription" method="post" action="index.php?page=inscription">
                    <p>Formulaire d'inscription:</p>
                    <p>
                        <label for="nom_inscription">Nom:</label>
                        </br>
                        <input type="text" id="nom_inscription" name="nom_inscription" onblur="verifNom(this)" required/>
                        </br>
                        </br>
                        <label for="prenom_inscription">Prénom:</label>
                        </br>
                        <input type="text" id="prenom_inscription" name="prenom_inscription" onblur="verifNom(this)" required/>
                        </br>
                        </br>
                        <label for="pseudo_inscription">Identifiant:</label>
                        </br>
                        <input type="text" id="pseudo_inscription" name="pseudo_inscription" onblur="verifNom(this)" required/>
                        </br>
                        </br>
                        <label for="mdp_inscription">Mot de passe:</label>
                        </br>
                        <input type="password" id="mdp_inscription" name="mdp_inscription" onblur="verifNom(this)" required/>
                        </br>
                        </br>
                        <label for="mdpconf_inscription">Confirmer le mot de passe:</label>
                        </br>
                        <input type="password" id="mdpconf_inscription" name="mdpconf_inscription" onblur="verifNom(this)" required/>
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
        function surligne(champ, erreur)
        {
           if(erreur)
              champ.style.backgroundColor = "#fba";
           else
              champ.style.backgroundColor = "";
        }
        function verifNom(champ)
        {
            if(champ.value.length < 2 || champ.value.length >30)
           {
              surligne(champ, true);
              return false;
           }
           else
           {
              surligne(champ, false);
              return true;

           }

        }
        
        function verifForm(f)
        {
            var nomOk = verifNom(f.nom_inscription);
            var prenomOk = verifNom (f.prenom_inscription);
            var identifiantOk = verifNom(f.pseudo_inscription);
            var mdpOk = verifNom(f.mdp_inscription);
            var mdpconfOk = verifNom(f.mdpconf_inscription);
            if(nomOk && prenomOk && identifiantOk && mdpOk && mdpconfOk )
            {
                if(f.mdp_inscription.value==f.mdpconf_inscription.value)
                    {
                        return true;
                    }
                else
                    {
                        alert("Les mots de passes ne correspondent pas");
                        return false;
                    }
            }
            else
            {
                alert("Veuillez remplir correctement tous les champs");
                return false;
            }
        }
        
        document.inscription.onsubmit = function()
        {
            return verifForm(this);
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
         document.inscription.onsubmit = function()
        {
            return confirm('Confirmez votre inscriptions?');
        }
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
