<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/Style_Accueil.css" />
        <title>MyHomeOnCommand</title>
    </head>
    
    <body>
        <div id="bandeau_accueil">
            <div id="logo"><img src="images/Logoetnomsite2white.png" alt="Logo de MyHomeOnCommand" /></div>
            <div id="titre">Bienvenue sur MyHomeOnCommand.com</div>
        </div>
        <div id="barre_gauche"></div>
        <div id="corps">    
            <div class="formulaire">
                <form id="connexion" method="post" action="index.php">
                    <p>Connexion:</p>
                    <p>
                        <label for="login">Pseudo:</label>
                        </br>
                        <input type="text" id="login" name="login"/>
                        </br>
                        </br>
                        <label for="mdp">Mot de passe:</label>
                        </br>
                        <input type="text" id="mdp" name="mdp"/>
                        </br>
                        </br>
                        <input type="submit" value="Se Connecter"/>  
                    </p>
                </form>
            </div>

            <div class="formulaire">
                <form id="inscription" method="post" action="">
                    <p>Formulaire d'inscription:</p>
                    <p>
                        <label for="nom_inscription">Nom:</label>
                        </br>
                        <input type="text" id="nom_inscription" name="nom_inscription"/>
                        </br>
                        </br>
                        <label for="prenom_inscription">Prénom:</label>
                        </br>
                        <input type="text" id="prenom_inscription" name="prenom_inscription"/>
                        </br>
                        </br>
                        <label for="telephone_inscription">Numéro de téléphone:</label>
                        </br>
                        <input type="text" id="telephone_inscription" name="telephone_inscription"/>
                        </br>
                        </br>
                        <label for="email_inscription">Email:</label>
                        </br>
                        <input type="text" id="email_inscription" name="email_inscription"/>
                        </br>
                        </br>
                        <label for="pseudo_inscription">Pseudo:</label>
                        </br>
                        <input type="text" id="pseudo_inscription" name="pseudo_inscription"/>
                        </br>
                        </br>
                        <label for="mdp_inscription">Mot de passe:</label>
                        </br>
                        <input type="text" id="mdp_inscription" name="mdp_inscription"/>
                        </br>
                        </br>
                        <input type="submit" value="Se Connecter"/>  
                    </p>
                </form>
            </div>
        
        </div>  
        <div id="bas">conditions générales d'utilisation</div>
    </body>
    
</html>