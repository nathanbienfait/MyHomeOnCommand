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
                <span id="titre_equipement">Ajouter un type d'équipement </span>
                <br> <br> <br>
                <span id="titre_admin">Ajouter un administrateur </span>
                <br> <br> <br>
                <span id="titre_op">Ajouter un opérateur </span>
		<br> <br> <br>
                <span id="titre_pres">Texte de présentation </span>
		<br> <br> <br>
		<span id="titre_cond">Conditions d'utilisation </span>
                  </div>
		    	<div id="modification">
                <div id="slogan">
			<p class='paragraphe'>
			<h1>Modifier le slogan :</h1>
				<form method='POST' id="modif_slogan" action='index.php?page=modification'>
					<input type="text" id="modif" name="Modifier_le_slogan" required />
					<input type="submit" id="valider" value="Valider" name="bouton_valider_slogan" />
				</form>
			</p>
				</div>
				
                
		<div id="equipement">			
			<p>
			<h1>Ajouter un type d'équipement :</h1>
			<form method='POST' id="modif_equipement" action='index.php?page=modification' enctype="multipart/form-data">
                            <label for="Ajouter_un_equipement"> Nom du capteur : </label></br>
			    <input type="text" id="ajoutEquipement" name='Ajouter_un_equipement' required /></br></br>            
                            <label for="type_donnees"> Indiquer si le type d'équipement peut avoir seulement deux états (ex : ouvert/fermé, allumé/éteint ...) : </label></br>
                            <select name="type_donnees">
                                <option value="1"> Données à deux états </option>
                                <option value="2"> Autre </option>
                            </select></br></br>    
                            <label for="unite"> Unité de la valeur mesurée : </label></br>
                            <input type="text" name="unite" /></br></br>
                            <label for="logo"> Importer un logo pour ce type d'équipement (ce logo apparaîtra sur le panneau de contrôle des clients) </label></br></br>
                            <input type="file" name="logo" /></br></br>
                            <label for="image_fond"> Importer une image de fond pour ce type d'équipement (cette image de fond apparaîtra sur le panneau de contôle des clients quand elle est triée par type d'équipement) </label></br>
                            <input type="file" name="image_fond"/></br></br>
			    <input type="submit" id="valider" value="Valider" name="bouton_valider_equipement" />
			</form>
			</p>
		</div>

                <div id="admin">
                    <p>
			<h1>Ajouter un administrateur :</h1>
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
			<h1>Ajouter un opérateur :</h1>
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

		 <div id="presentation">
                    <p>
			 <h1>Qui sommmes nous ?</h1>
                        <form method='POST' id="explication" action='index.php?page=modification'>
                            <textarea  id="texte_pres" name="texte_pres" required ></textarea>
                            <input type="submit" id="valider" value="Valider" name="bouton_valider_pres" />
                        </form>
                    </p>
                </div>
		
		<div id="conditions">
                        <p>
			<h1>Ecrire les conditions d'utilisation :</h1>
                        <form method='POST' id="condition" action='index.php?page=modification'>
                        	<textarea  id="texte_cond" name="texte_cond" required rows="15" cols="70"></textarea>
                                <br>
                                <input type="submit" id="valider" value="Valider" name="bouton_valider_cond" />
                        </form>
                        </p>
                </div>

	</div>

	</div>

		


<?php include('vue/footer.php');?>
<script>
    var cas1 = document.querySelector('#slogan');
cas1.style.display="none";
    var cas2 = document.querySelector('#equipement');
cas2.style.display="none";
    var cas3 = document.querySelector('#admin');
cas3.style.display="none";
    var cas4 = document.querySelector('#operateur');
cas4.style.display="none";
    var cas5 = document.querySelector('#presentation');
cas5.style.display="none";
    var cas6 = document.querySelector('#conditions');
cas6.style.display="none";

var tab1 = document.querySelector('#titre_slogan');
var x1=0;
tab1.addEventListener('click', function() {
    if(x1==0)
    {
        cas1.style.display="";
        cas2.style.display="none";
        cas3.style.display="none";
        cas4.style.display="none";
        cas5.style.display="none";
        cas6.style.display="none";

        
        x1=1;
        x2=0;
        x3=0;
        x4=0;
        x5=0;
        x6=0;

    }
    else
    {
        cas1.style.display="none";
        x1=0;
    }
 });

var tab2 = document.querySelector('#titre_equipement');
var x2=0;
tab2.addEventListener('click', function() {
    if(x2==0)
    {
        cas2.style.display="";
        cas1.style.display="none";
        cas3.style.display="none";
        cas4.style.display="none";
        cas5.style.display="none";
        cas6.style.display="none";

        x2=1;
        x1=0;
        x3=0;
        x4=0;
        x5=0;
        x6=0;
       
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
        cas5.style.display="none";
        cas6.style.display="none";

        
        x3=1;
        x1=0;
        x2=0;
        x4=0;
        x5=0;
        x6=0;
       
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
        cas5.style.display="none";
        cas6.style.display="none";

        
        x4=1;
        x1=0;
        x2=0;
        x3=0;
        x5=0;
        x6=0;
       
    }
    else
    {
        cas4.style.display="none";
        x4=0;
    }
 });

var tab5 = document.querySelector('#titre_pres');
var x5=0;
tab5.addEventListener('click', function() {
    if(x5==0)
    {
        cas5.style.display="";
        cas1.style.display="none";
        cas2.style.display="none";
        cas3.style.display="none";
        cas4.style.display="none";
        cas6.style.display="none";

        
        x5=1;
        x1=0;
        x2=0;
        x3=0;
        x4=0;
        x6=0;
       
    }
    else
    {
        cas5.style.display="none";
        x5=0;
    }
 });

var tab6 = document.querySelector('#titre_cond');
var x6=0;
tab6.addEventListener('click', function() {
    if(x6==0)
    {
        cas6.style.display="";
        cas1.style.display="none";
        cas2.style.display="none";
        cas3.style.display="none";
        cas4.style.display="none";
        cas5.style.display="none";

        
        x6=1;
        x1=0;
        x2=0;
        x3=0;
        x4=0;
        x5=0;
       
    }
    else
    {
        cas6.style.display="none";
        x6=0;
    }
 });


</script>
    </body>
   		
</html>
