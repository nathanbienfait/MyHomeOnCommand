<!DOCTYPE html>

	<html>

		<head>
			<meta charset='utf-8'/>
			<link rel="stylesheet" href="css/styleHeaderFooter.css"/>
			<link rel="stylesheet" href="css/stylePanneauClient.css"/>
			<link rel="stylesheet" href="css/styleMenu.css" />
            <link rel="stylesheet" href="css/styleGeneral.css" />
			<title> MyHomeOnCommand </title>
		</head>



		<body>
			<?php include('vue/header.php'); ?>
			<div id="corps"> <!-- début div 1 -->
				<?php include('vue/menuClient.php'); ?>
				<div id='paslemenu'> <!-- début div 2 -->
					
					<div id='panneau_controle_bloc_principal'> <!-- début div 3 -->
						<?php
						$compteLogement=0;
						foreach($id_logements as $id_logement)
						{
							echo '<div class=\'case_logement\' id=\''. $compteLogement . '\'>'; /* début div 4 */
								$nom_logement=Obtenir_nom_logement($id_logement);
								echo '<h1 class="titre_logement">' . $nom_logement . '</h1>';
								$id_pieces=Obtenir_id_pieces($id_logement);
								/* echo '<div class=\'liste_pieces\'>'; /*début div 5 */
								foreach(Obtenir_id_pieces($id_logement) as $id_piece)
								{
									echo '<div class=\'case_piece\'>'; /* début div 6 */
									echo '<div class=\'nom_piece\'>';
										$nom_piece=Obtenir_nom_piece($id_piece);
										echo '<h1>';
										echo $nom_piece;
										echo '</h1>';
										echo '</div>';
										echo '<div class=\'liste_equipements\'>'; /* début div 7 */
										foreach(Obtenir_id_equipements($id_piece) as $id_equipement)
										{
											echo '<div class=\'case_equipement\'>'; /* début div 8 */
											$etat=ObtenirEtatEquipement($id_equipement);
											$type_equipement=Obtenir_type_equipement($id_equipement);
											$id_type_equipement=ObtenirIdTypeEquipementDepuisNom($type_equipement);
											$typeDonnees=ObtenirTypeDonnees($id_type_equipement);
											$logo=ObtenirLogoTypeEquipement($id_type_equipement);
											$unite=ObtenirUniteTypeEquipement($id_type_equipement);
											$donnee_equipement=Obtenir_derniere_donnee_equipement($id_equipement);
											
											echo '<h2>' . ucfirst($type_equipement) . '</h2>';
											echo '<div class="photo"><img src=\'' . $logo . '\' alt=\'' . $type_equipement . '\' class=\'' . $type_equipement . '\'></div>';
											echo '</br>';
											if($typeDonnees==2)
											{
												echo $donnee_equipement;
												echo $unite . '</br></br>';
												echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
												echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
												if($unite == "%") {$max=100;} else {$max=1000000;}
												echo '<input type=\'number\' name=\'valeur_cible\' min=\'0\' max=\'' . $max . '\'>';
												echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $id_equipement . '\'/>';
												echo '<input type=\'hidden\' name=\'tri\' value=\'piece\'/>';
												echo '<input type=\'submit\' value=\'Appliquer\'/>';
											}
											elseif($typeDonnees==1)
											{	
												if ($donnee_equipement==0)
												{
													$message=ObtenirMessageBas($id_type_equipement);
													echo $message . '</br></br>';
													echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
													echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
													echo '<select name=\'valeur_cible\'>';
													echo '<option value=\'1\'selected>Ouvrir/activer</option>';
													echo '</select>';
													echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $id_equipement . '\'/>';
													echo '<input type=\'hidden\' name=\'tri\' value=\'piece\'/>';
													echo '<input type=\'submit\' value=\'Appliquer\'/>';
												}
												else
												{
													$message=ObtenirMessageHaut($id_type_equipement);
													echo $message . '</br></br>';
													echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
													echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
													echo '<select name=\'valeur_cible\'>';
													echo '<option value=\'2\' selected>Fermer/désactiver</option>';
													echo '</select>';
													echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $id_equipement . '\'/>';
													echo '<input type=\'hidden\' name=\'tri\' value=\'piece\'/>';
													echo '<input type=\'submit\' value=\'Appliquer\'/>';
												}
											}
											echo "</form>";

											if($etat==1)
											{
												echo '<div><img src=\'images/bonEtat.png\' alt=\'Etat_Bon\'  class=\'etat\'></div>';
											}
											else
											{
												echo '<div><img src=\'images/mauvaisEtat.png\' alt=\'Etat_Mauvais\' class=\'etat\'></div>';
											}
											echo '</div>'; /* fin div 8 */
										}
										echo '</div>'; /* fin div 7 */
									echo '</div>'; /* fin div 6 */
								}
								/* echo '</div>'; /* fin div 5 */
							echo '</div>';	/* fin div 4 */
						}
						?>
					</div> <!-- fin div 3 -->

					<div id='trier'>
						<form action="index.php?page=panneau" method="post">
						<p>
						<label for="tri">Trier les équipements par :</label>
						<select name="tri" id="tri">
							<option value="piece" selected>Pièce</option>
							<option value="type_parametre">Type de paramètre</option>
						</select>
						<input type="submit" value="Trier" id="bouton_tri"/>
						</p>
						</form>
					</div>

				</div> <!-- fin div 2 -->
			</div> <!-- fin div 1 -->
			<?php include('vue/footer.php'); ?>

			<script type="text/javascript">
				var tab = new Array();
				for(var i=0 ; i< <?php echo $compteLogement; ?> ; i++)
				{
					tab[i]=document.getElementById(i);
       	    	 	tab[i].onclick=function(){
       	    	 		alert('haha');
                	/*tab[i].childNodes.forEach(function(y){
                		y.style.display="none";*/
                	/*var piece=document.querySelectorAll(".titre_logement .case_piece");
                	var x=0;
                	while(x<piece.length)
                	{
                		piece[x].style.display='none';
                		x++;
                	}*/
                }
            }
            
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
	</html><!DOCTYPE html>

	<html>

		<head>
			<meta charset='utf-8'/>
			<link rel="stylesheet" href="css/styleHeaderFooter.css"/>
			<link rel="stylesheet" href="css/stylePanneauClient.css"/>
			<link rel="stylesheet" href="css/styleMenu.css" />
            <link rel="stylesheet" href="css/styleGeneral.css" />
			<title> MyHomeOnCommand </title>
		</head>



		<body>
			<?php include('vue/header.php'); ?>
			<div id="corps"> <!-- début div 1 -->
				<?php include('vue/menuClient.php'); ?>
				<div id='paslemenu'> <!-- début div 2 -->
					
					<div id='panneau_controle_bloc_principal'> <!-- début div 3 -->
						<?php
						$compteLogement=0;
						foreach($id_logements as $id_logement)
						{
							echo '<div class=\'case_logement\' id=\''. $compteLogement . '\'>'; /* début div 4 */
								$nom_logement=Obtenir_nom_logement($id_logement);
								echo '<h1 class="titre_logement">' . $nom_logement . '</h1>';
								$id_pieces=Obtenir_id_pieces($id_logement);
								/* echo '<div class=\'liste_pieces\'>'; /*début div 5 */
								foreach(Obtenir_id_pieces($id_logement) as $id_piece)
								{
									echo '<div class=\'case_piece\'>'; /* début div 6 */
									echo '<div class=\'nom_piece\'>';
										$nom_piece=Obtenir_nom_piece($id_piece);
										echo '<h1>';
										echo $nom_piece;
										echo '</h1>';
										echo '</div>';
										echo '<div class=\'liste_equipements\'>'; /* début div 7 */
										foreach(Obtenir_id_equipements($id_piece) as $id_equipement)
										{
											echo '<div class=\'case_equipement\'>'; /* début div 8 */
											$etat=ObtenirEtatEquipement($id_equipement);
											$type_equipement=Obtenir_type_equipement($id_equipement);
											$id_type_equipement=ObtenirIdTypeEquipementDepuisNom($type_equipement);
											$typeDonnees=ObtenirTypeDonnees($id_type_equipement);
											$logo=ObtenirLogoTypeEquipement($id_type_equipement);
											$unite=ObtenirUniteTypeEquipement($id_type_equipement);
											$donnee_equipement=Obtenir_derniere_donnee_equipement($id_equipement);
											
											echo '<h2>' . ucfirst($type_equipement) . '</h2>';
											echo '<div class="photo"><img src=\'' . $logo . '\' alt=\'' . $type_equipement . '\' class=\'' . $type_equipement . '\'></div>';
											echo '</br>';
											if($typeDonnees==2)
											{
												echo $donnee_equipement;
												echo $unite . '</br></br>';
												echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
												echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
												if($unite == "%") {$max=100;} else {$max=1000000;}
												echo '<input type=\'number\' name=\'valeur_cible\' min=\'0\' max=\'' . $max . '\'>';
												echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $id_equipement . '\'/>';
												echo '<input type=\'hidden\' name=\'tri\' value=\'piece\'/>';
												echo '<input type=\'submit\' value=\'Appliquer\'/>';
											}
											elseif($typeDonnees==1)
											{	
												if ($donnee_equipement==0)
												{
													$message=ObtenirMessageBas($id_type_equipement);
													echo $message . '</br></br>';
													echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
													echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
													echo '<select name=\'valeur_cible\'>';
													echo '<option value=\'1\'selected>Ouvrir/activer</option>';
													echo '</select>';
													echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $id_equipement . '\'/>';
													echo '<input type=\'hidden\' name=\'tri\' value=\'piece\'/>';
													echo '<input type=\'submit\' value=\'Appliquer\'/>';
												}
												else
												{
													$message=ObtenirMessageHaut($id_type_equipement);
													echo $message . '</br></br>';
													echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
													echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
													echo '<select name=\'valeur_cible\'>';
													echo '<option value=\'2\' selected>Fermer/désactiver</option>';
													echo '</select>';
													echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $id_equipement . '\'/>';
													echo '<input type=\'hidden\' name=\'tri\' value=\'piece\'/>';
													echo '<input type=\'submit\' value=\'Appliquer\'/>';
												}
											}
											echo "</form>";

											if($etat==1)
											{
												echo '<div><img src=\'images/bonEtat.png\' alt=\'Etat_Bon\'  class=\'etat\'></div>';
											}
											else
											{
												echo '<div><img src=\'images/mauvaisEtat.png\' alt=\'Etat_Mauvais\' class=\'etat\'></div>';
											}
											echo '</div>'; /* fin div 8 */
										}
										echo '</div>'; /* fin div 7 */
									echo '</div>'; /* fin div 6 */
								}
								/* echo '</div>'; /* fin div 5 */
							echo '</div>';	/* fin div 4 */
						}
						?>
					</div> <!-- fin div 3 -->

					<div id='trier'>
						<form action="index.php?page=panneau" method="post">
						<p>
						<label for="tri">Trier les équipements par :</label>
						<select name="tri" id="tri">
							<option value="piece" selected>Pièce</option>
							<option value="type_parametre">Type de paramètre</option>
						</select>
						<input type="submit" value="Trier" id="bouton_tri"/>
						</p>
						</form>
					</div>

				</div> <!-- fin div 2 -->
			</div> <!-- fin div 1 -->
			<?php include('vue/footer.php'); ?>

			<script type="text/javascript">
				var tab = new Array();
				for(var i=0 ; i< <?php echo $compteLogement; ?> ; i++)
				{
					tab[i]=document.getElementById(i);
       	    	 	tab[i].onclick=function(){
       	    	 		alert('haha');
                	/*tab[i].childNodes.forEach(function(y){
                		y.style.display="none";*/
                	/*var piece=document.querySelectorAll(".titre_logement .case_piece");
                	var x=0;
                	while(x<piece.length)
                	{
                		piece[x].style.display='none';
                		x++;
                	}*/
                }
            }
            
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
