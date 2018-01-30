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
<!-- on définit le nom de tous les onglets !-->
		        <div id="onglet">
                <span id="titre_slogan">Modifier le slogan </span>
                <br> <br> <br>
                <span id="titre_equipement">Ajouter un type d'équipement </span>
                <br> <br> <br>
                <span id="titre_modifEquipement">Modifier un type d'équipement</span>
                <br> <br> <br>
		        <span id="titre_suppEquipement">Supprimer un type d'équipement</span>
                <br> <br> <br>
                <span id="titre_admin">Ajouter un administrateur </span>
                <br> <br> <br>
                <span id="titre_op">Ajouter un opérateur </span>
		        <br> <br> <br>
                <span id="titre_pres">Texte de présentation </span>
		        <br> <br> <br>
		  	<span id="titre_cond">Conditions d'utilisation </span>
			<br> <br> <br>
               	 	<span id="titre_contact">Contact</span>
                </div>

		    	<div id="modification">

                <div id="slogan"> <!-- Permet de modifier le slogan qui apparait dans le header du site !-->
                <p class='paragraphe'>
                <h1>Modifier le slogan :</h1>
				<form method='POST' id="modif_slogan" action='index.php?page=modification'>
					<input type="text" id="modif" name="Modifier_le_slogan" required />
					<input type="submit" class="valider" value="Valider" name="bouton_valider_slogan" />
				</form>
                </p>
				</div>
				
                
		<div id="equipement">	<!-- permet d'ajouter un type d'équipement grâce à un formulaire !-->		
			<p>
			<h1>Ajouter un type d'équipement :</h1>
			<form method='POST' id="modif_equipement" action='index.php?page=modification' enctype="multipart/form-data">
                            <label for="Ajouter_un_equipement"> Nom du capteur : </label></br>
			    <input type="text" id="ajoutEquipement" name='Ajouter_un_equipement' required /></br></br>               
                            <label for="type_donnees"> Indiquer si le type d'équipement peut avoir seulement deux états <br>(ex : ouvert/fermé, allumé/éteint ...) : </label></br>
                            <select name="type_donnees" onchange="afficherCacher()">
                                <option value="1"> Données à deux états </option>
                                <option value="2"> Autre </option>
                            </select></br></br>
                            <div id="pourBinaire"><label for="etat_haut">Message à afficher quand l'état de l'équipement est "HAUT" :</label></br>
                            <input type="text" name="etat_haut"></br></br>
                            <label for="etat_bas">Message à afficher quand l'état de l'équipement est "BAS" :</label></br>
                            <input type="text" name="etat_bas"></br></br></div>
                            <div id="pourNonBinaire"><label for="unite"> Unité de la valeur mesurée : </label></br>
                            <input type="text" name="unite" /></br></br></div>
                            <label for="logo"> Importer un logo pour ce type d'équipement <br> (ce logo apparaîtra sur le panneau de contrôle des clients) </label></br></br>
                            <input type="file" name="logo" /></br></br>
                            <label for="image_fond"> Importer une image de fond pour ce type d'équipement <br> (cette image de fond apparaîtra sur le panneau de contôle des clients quand elle est triée par type d'équipement) </label><br><br>
                            <input type="file" name="image_fond"/></br></br>
			    <input type="submit" class="valider" value="Valider" name="bouton_valider_equipement" />
		 	</form>
			</p>
		</div>

		<div id="modifEquipement">   <!--permet de modifier un type d'équipement déjà existant !-->
                    <p>
                    
                    <?php
                    $typeEquipement=new admin;
                        
                        if(empty($_POST['typeEquipement']) AND empty($_POST['caracEquipement']))  /* première étape : on choisit le type à modifier */
                        {
                            $listeIdTypeEquipement=$typeEquipement->Obtenir_tous_id_type_equipement();
                            echo "<h1>Sélectionner un type d'équipement :</h1></br>";
                            echo "<form method='post' action='index.php?page=modification' enctype='multipart/form-data'>";
                            echo "<select name='typeEquipement'>";              
                            foreach($listeIdTypeEquipement as $idTypeEquipement)
                            {
                                $nomTypeEquipement=$typeEquipement->ObtenirTypeEquipementDepuisId($idTypeEquipement);
                                echo '<option value=\'' . $idTypeEquipement . '\'>' . $nomTypeEquipement . '</option>';
                            }
                            echo "</select>";
                            echo "<input type='submit' value='Valider' name='bouton_valider_selecType' />";
                        }

                        elseif(empty($_POST['caracEquipement']))  /* deuxième étape : on choisit la caractéristique à modifier */
                        {
                            $idTypeCapteurSelec=htmlspecialchars($_POST['typeEquipement']);
                            $typeDonnees=$typeEquipement->ObtenirTypeDonnees($idTypeCapteurSelec);
                            echo "<h1>Sélectionner la caractéristique à modifier</h1></br>";
                            echo "<form method='post' action='index.php?page=modification' enctype='multipart/form-data'>";
                            echo '<input type=\'hidden\' name=\'idTypeCapteur\' value=\'' . $idTypeCapteurSelec . '\'>';
                            echo "<select name='caracEquipement'>";
                            echo "<option value='nom_type_equipement'>Nom du type d'équipement</option>";
                            echo "<option value='image_fond'>Image de fond pour ce type</option>";
                            echo "<option value='logo'>Logo pour ce type</option>";
                            if($typeDonnees == 1)
                            {
                                echo "<option value='message_etat_haut'>Message à afficher en état haut</option>";
                                echo "<option value='message_etat_bas'>Message à afficher en état bas</option>";
                            }
                            else
                            {
                                echo "<option value='unite'>Unité de ce type</option>";
                            }
                            echo "</select>";
                            echo "<input type='submit' value='Valider' name='bouton_valider_selecCarac' />"; 
                        }

                        else /* troisième étape : on indique la nouvelle valeur (dépend de la caractéristique choisie) */
                        {
                            $caracEquipement=htmlspecialchars($_POST['caracEquipement']);
                            echo "<h1>Modifier la caractéristique sélectionnée</h1></br>";
                            echo "<form method='post' action='index.php?page=modification' enctype='multipart/form-data'>";
                            echo '<input type=\'hidden\' name=\'idTypeCapteur\' value=\'' . htmlspecialchars($_POST['idTypeCapteur']) . '\'>';
                            echo '<input type=\'hidden\' name=\'caracSelec\' value=\'' . $caracEquipement . '\'>';
                            if($caracEquipement=='nom_type_equipement' OR $caracEquipement=='message_etat_bas' OR $caracEquipement=='message_etat_haut' OR $caracEquipement=='unite')
                            {   
                                echo "<label for='nouvelleCarac'>Indiquer la nouvelle valeur :</label></br>";   
                                echo "<input type='text' name='nouvelleCarac' required>";
                            }
                            else
                            {
                                echo "<label for='nouvelleCarac'>Choisissez un fichier à télécharger :</label></br>";
                                echo "<input type='file' name='nouvelleCarac' required/>";
                            }
                            echo "<input type='submit' value='Valider' name='bouton_valider_nouvelleCarac' />";    
                        }
                        ?>
                    </form>
                    </p>
                </div>

		<div id="suppEquipement">  <!-- permet de supprimer un type d'équipement existant !-->
                    <p> <?php
                        echo "<h1>Supprimer un type d'équipement :</h1></br>";
                        echo "<form method='post' action='index.php?page=modification' enctype='multipart/form-data' onsubmit='return confirmer();'>";
                        echo "<select name='typeEquipementSupp'>";
                        foreach($listeIdTypeEquipement as $idTypeEquipement)
                        {
                            $nomTypeEquipement=$typeEquipement->ObtenirTypeEquipementDepuisId($idTypeEquipement);
                            echo '<option value=\'' . $idTypeEquipement . '\'>' . $nomTypeEquipement . '</option>';
                        }
                        echo "</select>";
                        echo "<input type='submit' value='Valider' name='bouton_valider_selecTypeSupp' />";
                        ?>
                    </form>    
                    </p>
                </div>

                <div id="admin"> <!-- Permet d'ajouter un nouvel admin à la base de données  !-->
                    <p>
			<h1>Ajouter un administrateur :</h1>
                        <form method='POST' id="ajout_admin" action='index.php?page=modification'>
                            Identifiant
                            <input type="text" id="login" name="login_admin" required />
                            <br> <br>
                            Mot de passe
                            <input type="password" id="password" name="password_admin" required />
			    <br><br>
                            Confirmer le mot de passe
                            <input type="password" class="password" name="password_admin_verif" required />
                            <br><br>
                            <input type="submit" class="valider" value="Valider" name="bouton_valider_admin" />
                        </form>
                    </p>
                </div>

                <div id="operateur">  <!-- Permet d'ajouter un nouvel opérateur à la base de données  !-->
                    <p>
			<h1>Ajouter un opérateur :</h1>
                        <form method='POST' id="ajout_op" action='index.php?page=modification'>
                            Identifiant
                            <input type="text" id="login" name="login_op" required />
                            <br> <br>
                            Mot de passe
                            <input type="password" id="password" name="password_op" required />
			    <br><br>
                            Confirmer le mot de passe
                            <input type="password" class="password" name="password_op_verif" required />
                            <br><br>
                            <input type="submit" class="valider" value="Valider" name="bouton_valider_op" />
                        </form>
                    </p>
                </div>

		 <div id="presentation">  <!-- Permet de modifier le texte de presentation de Domisep !-->
                    <p>
			 <h1>Qui sommmes nous ?</h1>
                        <form method='POST' id="explication" action='index.php?page=modification'>
                            <textarea  id="texte_pres" name="texte_pres" required rows="5" cols="40" ></textarea><br>
                            <input type="submit" class="valider" value="Valider" name="bouton_valider_pres" />
                        </form>
                    </p>
                </div>
		
		<div id="conditions">   <!-- Permet de remplir les conditions d'utilisation !-->
                        <p>
			<h1>Ecrire les conditions d'utilisation :</h1>
                        <form method='POST' id="condition" action='index.php?page=modification'>
                        	<textarea  id="texte_cond" name="texte_cond" required rows="15" cols="70"></textarea>
                                <br>
                                <input type="submit" class="valider" value="Valider" name="bouton_valider_cond" />
                        </form>
                        </p>
                </div>
		
		<div id="contactDomisep">  <!-- Permet de remplir les coordonnées de Domisep !-->
                        <p>
            	<h1>Comment contacter Domisep :</h1>
                        <form method='POST' id="contact" action='index.php?page=modification'>
                            Téléphone
                            <br>
                            <input type="text" id="contactTel" name="telephone_contact" required />
                            <br> <br>
                            Email
                            <br>
                            <input type="text" id="contactMail" name="mail_contact" required />
                            <br><br>
                            Adresse
                            <br>
                            <textarea  id="contactAdresse" name="adresse_contact" required rows="3" cols="20"></textarea>
                            <br>
                            <input type="submit" class="valider" value="Valider" name="bouton_valider_contact" />
                        </form>
                        </p>
        	</div>

	</div>

	</div>

		


<?php include('vue/footer.php');?>
<script>
	/* on fait en sorte qu'aucun des formulaires n'apparaisse */
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
    var cas7 = document.querySelector('#contactDomisep');
cas7.style.display="none";
    var cas8 = document.querySelector('#modifEquipement');
<?php if(empty($_POST['typeEquipement']) AND empty($_POST['caracEquipement'])) { echo "cas8.style.display='none';"; }
else {echo "cas8.style.display='';"; } ?>
    var cas9 = document.querySelector('#suppEquipement');
cas9.style.display="none";

	/* dans la partie qui suit on demande aux formulaires de s'afficher quand on appuie sur l'onglet correspondant ou de ne plus s'afficher */
	
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
        cas7.style.display="none";
        cas8.style.display="none";
        cas9.style.display="none";
	    
        x1=1;
        x2=0;
        x3=0;
        x4=0;
        x5=0;
        x6=0;
        x7=0;
        x8=0;
        x9=0;

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
        cas7.style.display="none";
        cas8.style.display="none";
        cas9.style.display="none";

        x2=1;
        x1=0;
        x3=0;
        x4=0;
        x5=0;
        x6=0;
        x7=0;
        x8=0;
        x9=0;
       
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
	    cas7.style.display="none";
	    cas8.style.display="none";
        cas9.style.display="none";
        
        x3=1;
        x1=0;
        x2=0;
        x4=0;
        x5=0;
        x6=0;
        x7=0;
	    x8=0;
        x9=0;

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
	    cas7.style.display="none";
	    cas8.style.display="none";
        cas9.style.display="none";
        
        x4=1;
        x1=0;
        x2=0;
        x3=0;
        x5=0;
        x6=0;
        x7=0;
	    x8=0;
        x9=0;

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
	    cas7.style.display="none";
	    cas8.style.display="none";
        cas9.style.display="none";
        
        x5=1;
        x1=0;
        x2=0;
        x3=0;
        x4=0;
        x6=0;
        x7=0;
	    x8=0;
        x9=0;

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
	    cas7.style.display="none";
	    cas8.style.display="none";
        cas9.style.display="none";
        
        x6=1;
        x1=0;
        x2=0;
        x3=0;
        x4=0;
        x5=0;
        x7=0;
        x8=0;
        x9=0;

    }
    else
    {
        cas6.style.display="none";
        x6=0;
    }
 });

var tab7 = document.querySelector('#titre_contact');
var x7=0;
tab7.addEventListener('click', function() {
    if(x7==0)
    {
        cas7.style.display="";
        cas1.style.display="none";
        cas2.style.display="none";
        cas3.style.display="none";
        cas4.style.display="none";
	    cas5.style.display="none";
	    cas6.style.display="none";
	    cas8.style.display="none";
        cas9.style.display="none";
		    
        x7=1;
        x1=0;
        x2=0;
        x3=0;
        x4=0;
	    x5=0;
	    x6=0;
	    x8=0;
        x9=0;
       
    }
    else
    {
        cas7.style.display="none";
        x7=0;
    }
 });

var tab8 = document.querySelector('#titre_modifEquipement');
var x8=0;
tab8.addEventListener('click', function() {
    if(x8==0)
    {
        cas8.style.display="";
        cas1.style.display="none";
        cas2.style.display="none";
        cas3.style.display="none";
        cas4.style.display="none";
	    cas5.style.display="none";
	    cas6.style.display="none";
	    cas7.style.display="none";
        cas9.style.display="none";
		    
        x8=1;
        x1=0;
        x2=0;
        x3=0;
        x4=0;
        x5=0;
        x6=0;
        x7=0;
        x9=0;
       
    }
    else
    {
        cas8.style.display="none";
        x8=0;
    }
 });

var tab9 = document.querySelector('#titre_suppEquipement');
var x9=0;
tab9.addEventListener('click', function() {
    if(x9==0)
    {
        cas9.style.display="";
        cas1.style.display="none";
        cas2.style.display="none";
        cas3.style.display="none";
        cas4.style.display="none";
        cas5.style.display="none";
        cas6.style.display="none";
        cas7.style.display="none";
        cas8.style.display="none";
            
        x9=1;
        x1=0;
        x2=0;
        x3=0;
        x4=0;
        x5=0;
        x6=0;
        x7=0;
        x8=0;
       
    }
    else
    {
        cas9.style.display="none";
        x9=0;
    }
 });
	
function confirmer()
{
    return confirm("La suppression d'un type d'équipement est définitive et peut entraîner des dysfonctionnements. Confirmer la suppression de ce type de capteur ?");
}

var binaire = document.getElementById('pourBinaire');
var pasBinaire = document.getElementById('pourNonBinaire');
binaire.style.display="block";
pasBinaire.style.display="none";
var y=0;

function afficherCacher()
{
    if(y==0)
    {
        binaire.style.display="none";
        pasBinaire.style.display="block";
        y=1;
    }
    else
    {
        binaire.style.display="block";
        pasBinaire.style.display="none";
        y=0;
    }
}
</script>
    </body>
   		
</html>
