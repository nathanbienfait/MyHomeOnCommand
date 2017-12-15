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
			<div id="corps">
				<?php include('vue/menuClient.php'); ?>
				<div id='paslemenu'>
					
					<div id='panneau_controle_bloc_principal'>
						<?php
						foreach($id_logements as $id_logement)
						{
							echo '<div class=\'case_logement\'>';
								$nom_logement=Obtenir_nom_logement($id_logement);
								echo '<h1>';
								echo $nom_logement;
								echo '</h1>';
								$id_pieces=Obtenir_id_pieces($id_logement);
								echo '<div class=\'liste_pieces\'>';
								foreach(Obtenir_id_pieces($id_logement) as $id_piece)
								{
									echo '<div class=\'case_piece\'>';
										$nom_piece=Obtenir_nom_piece($id_piece);
										echo '<h1>';
										echo $nom_piece;
										echo '</h1>';
										echo '<div class=\'liste_equipements\'>';
										foreach(Obtenir_id_equipements($id_piece) as $id_equipement)
										{
											echo '<div class=\'case_equipement\'>';
											$type_equipement=Obtenir_type_equipement($id_equipement);
											$donnee_equipement=Obtenir_derniere_donnee_equipement($id_equipement);
											
											if($type_equipement=="humidite")
											{	
												echo '<h2>Humidité</h2>';
												echo '<div class="photo"><img src=\'images/Goutte.png\' alt=\'humidite\' class=\'humidite\'></div>';
												
												echo $donnee_equipement;
												echo '%';
											}
											elseif($type_equipement=="temperature")
											{	
												echo '<h2>Température</h2>';
												echo '<div class="photo"><img src=\'images/Thermometre.png\' alt=\'thermometre\' class=\'thermometre\'></div>';
												
												echo $donnee_equipement;
												echo '°C';
												
											}

											elseif($type_equipement=="ouverture")
											{	
												echo '<h2>Porte</h2>';
												echo '<div class="photo"><img src=\'images/ouvertureFenetre.png\' alt=\'ouverture\' class=\'ouverture\'></div>';
													
												if ($donnee_equipement==0)
												{
													echo "Fermé";
												}
												else
												{
													echo "Ouvert";
												}
											}
											echo '</div>';
										}
										echo '</div>';
									echo '</div>';
								}
								echo '</div>';
							echo '</div>';	
						}
						?>
					</div>

					<!--<div id='trier'>
						<form action="" method="post">
						<p>
						<label for="tri">Trier les équipements par :</label>
						<select name="tri" id="tri">
							<option value="piece">Pièce</option>
							<option value="type_commande">Type de commande</option>
							<option value="type_parametre">Type de paramètre</option>
						</select>
						</p>
						</form>
					</div>!-->

				</div>
			</div>
			<?php include('vue/footer.php'); ?>
		</body>
	</html>


