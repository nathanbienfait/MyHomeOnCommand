<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <link rel="stylesheet" href="css/styleModification.css" />
        
        <title>MyHomeOnCommand</title>
    </head>
    
    
    <body>
        <?php include('vue/header.php');?>
	    <div id="corps">

	    		<?php include('vue/menuAdmin.php');?>

		      <div id="onglet">
                <span id="titre_slogan">Modifier le slogan </span>
                <br> <br> <br>
                <span id="titre_capteur">Ajouter un type de capteur </span>
                <br> <br> <br>
                <span id="titre_admin">Ajouter un administrateur </span>
                <br> <br> <br>
                <span id="titre_op">Ajouter un opérateur </span>
                  </div>
		    	<div id="modification">
                <div id="slogan">
			    	<p class='paragraphe'>
			    		Modifier le slogan
						<form method='POST' id="modif_slogan" action='index.php?page=modification'>
						    <input type="text" id="modif" name="Modifier_le_slogan" required />
						    <input type="submit" id="valider" value="Valider" name="bouton_valider_slogan" />
						</form>
					</p>
				</div>
				
                
				<div id="capteur">			
					<p>
						Ajouter un type de capteur
						<form method='POST' id="modif_capteur" action='index.php?page=modification'>
						    <input type="text" id="ajoutCapteur" name='Ajouter_un_capteur' required />
						    <input type="submit" id="valider" value="Valider" name="bouton_valider_capteur" />
						</form>
					</p>
				</div>

                <div id="admin">
                    <p>
                        Ajouter un administrateur
                        <form method='POST' id="ajout_admin" action='index.php?page=modification'>
                            Identifiant
                            <input type="text" id="login" name="login_admin" required />
                            <br> <br>
                            Mot de passe
                            <input type="password" id="password" name="password_admin" required />
                            <input type="submit" id="valider" value="Valider" name="bouton_valider_admin" />
                        </form>
                    </p>
                </div>

                <div id="operateur">
                    <p>
                        Ajouter un opérateur
                        <form method='POST' id="ajout_op" action='index.php?page=modification'>
                            Identifiant
                            <input type="text" id="login" name="login_op" required />
                            <br> <br>
                            Mot de passe
                            <input type="password" id="password" name="password_op" required />
                            <input type="submit" id="valider" value="Valider" name="bouton_valider_op" />
                        </form>
                    </p>
                </div>

			</div>

		</div>


<?php include('vue/footer.php');?>
<script>
    var cas1 = document.querySelector('#slogan');
cas1.style.display="none";
    var cas2 = document.querySelector('#capteur');
cas2.style.display="none";
    var cas3 = document.querySelector('#admin');
cas3.style.display="none";
    var cas4 = document.querySelector('#operateur');
cas4.style.display="none";

var tab1 = document.querySelector('#titre_slogan');
var x1=0;
tab1.addEventListener('click', function() {
    if(x1==0)
    {
        cas1.style.display="";
        cas2.style.display="none";
        cas3.style.display="none";
        cas4.style.display="none";
        
        x1=1;
        x2=0;
        x3=0;
        x4=0;
        
    }
    else
    {
        cas1.style.display="none";
        x1=0;
    }
 });

var tab2 = document.querySelector('#titre_capteur');
var x2=0;
tab2.addEventListener('click', function() {
    if(x2==0)
    {
        cas2.style.display="";
        cas1.style.display="none";
        cas3.style.display="none";
        cas4.style.display="none";
        
        x2=1;
        x1=0;
        x3=0;
        x4=0;
       
    }
    else
    {
        cas2.style.display="none";
        x2=0;
    }
 });

var tab3 = document.querySelector('#titre_admin');
var x3=0;
tab3.addEventListener('click', function() {
    if(x3==0)
    {
        cas3.style.display="";
        cas1.style.display="none";
        cas2.style.display="none";
        cas4.style.display="none";
        
        x3=1;
        x1=0;
        x2=0;
        x4=0;
       
    }
    else
    {
        cas3.style.display="none";
        x3=0;
    }
 });

var tab4 = document.querySelector('#titre_op');
var x4=0;
tab4.addEventListener('click', function() {
    if(x4==0)
    {
        cas4.style.display="";
        cas1.style.display="none";
        cas2.style.display="none";
        cas3.style.display="none";

        
        x4=1;
        x1=0;
        x2=0;
        x3=0;
       
    }
    else
    {
        cas4.style.display="none";
        x4=0;
    }
 });

</script>
    </body>
   		
</html>
