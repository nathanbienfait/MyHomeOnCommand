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
                </div>

		    	<div id="modification">

                <div id="slogan">
                <p class='paragraphe'>
                <h1>Modifier le slogan :</h1>
				<form method='POST' id="modif_slogan" action='index.php?page=modification'>
					<input type="text" id="modif" name="Modifier_le_slogan" required />
					<input type="submit" class="valider" value="Valider" name="bouton_valider_slogan" />
				</form>
                </p>
				</div>
				
                
		<div id="equipement">			
			<p>
			<h1>Ajouter un type d'équipement :</h1>
			<form method='POST' id="modif_equipement" action='index.php?page=modification' enctype="multipart/form-data">
                            <label for="Ajouter_un_equipement"> Nom du capteur : </label></br>
			    <input type="text" id="ajoutEquipement" name='Ajouter_un_equipement' required /></br></br>               
                            <label for="type_donnees"> Indiquer si le type d'équipement peut avoir seulement deux états <br>(ex : ouvert/fermé, allumé/éteint ...) : </label></br>
                            <select name="type_donnees">
                                <option value="1"> Données à deux états </option>
                                <option value="2"> Autre </option>
                            </select></br></br>
                            <label for="etat_haut">Message à afficher quand l'état de l'équipement est "HAUT" :</label></br>
                            <input type="text" name="etat_haut"></br></br>
                            <label for="etat_bas">Message à afficher quand l'état de l'équipement est "BAS" :</label></br>
                            <input type="text" name="etat_bas"></br></br>
                            <label for="unite"> Unité de la valeur mesurée : </label></br>
                            <input type="text" name="unite" /></br></br>
                            <label for="logo"> Importer un logo pour ce type d'équipement <br> (ce logo apparaîtra sur le panneau de contrôle des clients) </label></br></br>
                            <input type="file" name="logo" /></br></br>
                            <label for="image_fond"> Importer une image de fond pour ce type d'équipement <br> (cette image de fond apparaîtra sur le panneau de contôle des clients quand elle est triée par type d'équipement) </label><br><br>
                            <input type="file" name="image_fond"/></br></br>
			    <input type="submit" class="valider" value="Valider" name="bouton_valider_equipement" />
		 	</form>
			</p>
		</div>

		<div id="modifEquipement">
                    <p>
                    
                    <?php
                    $typeEquipement=new admin;
                        
                        if(empty($_POST['typeEquipement']) AND empty($_POST['caracEquipement']))
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

                        elseif(empty($_POST['caracEquipement']))
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

                        else
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

		<div id="suppEquipement">
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

                <div id="admin">
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

                <div id="operateur">
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

		 <div id="presentation">
                    <p>
			 <h1>Qui sommmes nous ?</h1>
                        <form method='POST' id="explication" action='index.php?page=modification'>
                            <textarea  id="texte_pres" name="texte_pres" required rows="5" cols="40" ></textarea><br>
                            <input type="submit" class="valider" value="Valider" name="bouton_valider_pres" />
                        </form>
                    </p>
                </div>
		
		<div id="conditions">
                        <p>
			<h1>Ecrire les conditions d'utilisation :</h1>
                        <form method='POST' id="condition" action='index.php?page=modification'>
                        	<textarea  id="texte_cond" name="texte_cond" required rows="15" cols="70"></textarea>
                                <br>
                                <input type="submit" class="valider" value="Valider" name="bouton_valider_cond" />
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
    var cas7 = document.querySelector('#modifEquipement');
<?php if(empty($_POST['typeEquipement']) AND empty($_POST['caracEquipement'])) { echo "cas7.style.display='none';"; }
else {echo "cas7.style.display='';"; } ?>
    var cas8 = document.querySelector('#suppEquipement');
cas8.style.display="none";

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
	    
        x1=1;
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

        x2=1;
        x1=0;
        x3=0;
        x4=0;
        x5=0;
        x6=0;
        x7=0;
        x8=0;
       
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
        
        x3=1;
        x1=0;
        x2=0;
        x4=0;
        x5=0;
        x6=0;
        x7=0;
	x8=0;
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
        
        x4=1;
        x1=0;
        x2=0;
        x3=0;
        x5=0;
        x6=0;
        x7=0;
	x8=0;
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
        
        x5=1;
        x1=0;
        x2=0;
        x3=0;
        x4=0;
        x6=0;
        x7=0;
	x8=0;
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
        
        x6=1;
        x1=0;
        x2=0;
        x3=0;
        x4=0;
        x5=0;
        x7=0;
        x8=0;
    }
    else
    {
        cas6.style.display="none";
        x6=0;
    }
 });

var tab7 = document.querySelector('#titre_modifEquipement');
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
		    
        x7=1;
        x1=0;
        x2=0;
        x3=0;
        x4=0;
	x5=0;
	x6=0;
	x8=0;
       
    }
    else
    {
        cas7.style.display="none";
        x7=0;
    }
 });

var tab8 = document.querySelector('#titre_suppEquipement');
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
		    
        x8=1;
        x1=0;
        x2=0;
        x3=0;
        x4=0;
        x5=0;
        x6=0;
        x7=0;
       
    }
    else
    {
        cas8.style.display="none";
        x8=0;
    }
 });
</script>
    </body>
   		
</html>
