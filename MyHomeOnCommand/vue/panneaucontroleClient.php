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
							$compteLogement += 1;
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
											$donnee_equipement=Obtenir_derniere_donnee_equipement($id_equipement);
											
											if($type_equipement=="humidite")
											{	
												echo '<h2>Humidité</h2>';
												echo '<div class="photo"><img src=\'images/Goutte.png\' alt=\'humidite\' class=\'humidite\'></div>';
												
												echo $donnee_equipement;
												echo '%';
												echo '</br>';
												echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
												echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
												echo '<input type=\'number\' name=\'valeur_cible\' min=\'0\' max=\'100\'>';
												echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $id_equipement . '\'/>';
												echo '<input type=\'hidden\' name=\'tri\' value=\'piece\'/>';
												echo '<input type=\'submit\' value=\'Appliquer\'/>';
											}
											elseif($type_equipement=="temperature")
											{	
												echo '<h2>Température</h2>';
												echo '<div class="photo"><img src=\'images/Thermometre.png\' alt=\'thermometre\' class=\'thermometre\'></div>';
												
												echo $donnee_equipement;
												echo '°C';
												echo '</br>';
												echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
												echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
												echo '<input type=\'number\' name=\'valeur_cible\' min=\'0\' max=\'40\'>';
												echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $id_equipement . '\'/>';
												echo '<input type=\'hidden\' name=\'tri\' value=\'piece\'/>';
												echo '<input type=\'submit\' value=\'Appliquer\'/>';
												
											}

											elseif($type_equipement=="ouverture")
											{	
												echo '<h2>Porte</h2>';
												echo '<div class="photo"><img src=\'images/ouvertureFenetre.png\' alt=\'ouverture\' class=\'ouverture\'></div>';
													
												if ($donnee_equipement==0)
												{
													echo "Fermé";
													echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
													echo '<label for=\'valeur_cible\' class=\'label\'>Contrôler l\'ouverture à distance</label></br>';
													echo '<select name=\'valeur_cible\'>';
													echo '<option value=\'ouvert\'selected>Ouvrir</option>';
													echo '<option value=\'type_parametre\'>Fermer</option>';
													echo '</select>';
													echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $id_equipement . '\'/>';
													echo '<input type=\'hidden\' name=\'tri\' value=\'piece\'/>';
													echo '<input type=\'submit\' value=\'Appliquer\'/>';
												}
												else
												{
													echo "Ouvert";
													echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
													echo '<label for=\'valeur_cible\' class=\'label\'>Contrôler l\'ouverture à distance</label></br>';
													echo '<select name=\'valeur_cible\'>';
													echo '<option value=\'ouvert\'selected>Ouvrir</option>';
													echo '<option value=\'type_parametre\'>Fermer</option>';
													echo '</select>';
													echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $id_equipement . '\'/>';
													echo '<input type=\'hidden\' name=\'tri\' value=\'piece\'/>';
													echo '<input type=\'submit\' value=\'Appliquer\'/>';
												}
											}
											elseif($type_equipement=="fumee")
											{
												echo "<h2>Fumée</h2>";
												if($donnee_equipement==0)
												{
													echo "Aucun problème à signaler";
												}
												else
												{
													echo "Fumée détectée dans la pièce ! Faites attention !";
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

            var a=document.getElementById('panneau_controle_bloc_principal');
            a.onclick=function(){
            	alert('pain');
            }
			</script>
		</body>
	</html>
