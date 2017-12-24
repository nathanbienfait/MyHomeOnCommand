<!DOCTYPE html>

	<html>

		<head>
			<meta charset='utf-8'/>
			<link rel="stylesheet" href="css/styleHeaderFooter.css"/>
			<link rel="stylesheet" href="css/styleMenu.css" />
			<link rel="stylesheet" href="css/stylePanneauClientTrie.css">
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
						foreach($idtypesEquipement as $idtypeEquipement)
						{
							$id_logements = ObtenirLogementsAvecType($idtypeEquipement, $_SESSION['id']);
							$type_equipement = ObtenirTypeEquipementDepuisId($idtypeEquipement);
							echo "<div class='bloc_type_equipement'>";	/* début div 1 */
							echo "<div class='titre_image'>";	/*début div 2 */
							echo '<h1>' . ucfirst($type_equipement) . '</h1>';
							if($type_equipement=="humidite")
							{	
								echo '<div class="photo"><img src=\'images/Goutte.png\' alt=\'humidite\' class=\'humidite\'></div>';
								$suffixe_type = '%';
							}
							elseif($type_equipement=="temperature")
							{	
								echo '<div class="photo"><img src=\'images/Thermometre.png\' alt=\'thermometre\' class=\'thermometre\'></div>';				
								$suffixe_type = '°C';						
							}
							elseif($type_equipement=="ouverture")
							{	
								echo '<div class="photo"><img src=\'images/ouvertureFenetre.png\' alt=\'ouverture\' class=\'ouverture\'></div>';
							}

							echo "</div>";	/* fin div 2 */
							if(!empty($id_logements))
							{
								foreach($id_logements as $id_logement)
								{
									echo "<div class='nom_logement'>";	/*debut div 3 */
									$nom_logement = Obtenir_nom_logement($id_logement);
									echo '<h2>' . $nom_logement . '</h2>';
									echo "</div>";	/* fin div 3 */
									$equipements = ObtenirEquipementsDunTypeEtLogement($idtypeEquipement, $id_logement, $_SESSION['id']);
									echo "<div class='liste_donnees'>";	/* debut div 4 */
									foreach ($equipements as $equipement)
									{
										$piece=ObtenirPieceDeLequipement($equipement);
										echo "<div class='bloc_donnees'>";	/* debut div 5 */
										echo $piece . '</br>';
										$donnee_equipement = Obtenir_derniere_donnee_equipement($equipement);
										if($type_equipement == "ouverture")
										{
											if($donnee_equipement == 0)
											{
												echo "Fermé";
											}
											else
											{
												echo "Ouvert";
											}
										}
										else
										{
											echo $donnee_equipement;
											echo $suffixe_type;
										}
										echo "</div>"; /* fin div 5 */
									}
									echo "</div>";	/* fin div 4 */
								}
							}
							else
							{
								echo "<div class='pas_equipement'>Ce type d'équipement n'est présent dans aucun de vos logements. Vous pouvez vous en procurer dans nos boutiques !</div>";
							}
							echo "</div>";	/* fin div 1 */
						}	

							?>								
					</div>

					<div id='trier'>
						<form action="index.php?page=panneau" method="post">
						<p>
						<label for="tri">Trier les équipements par :</label>
						<select name="tri" id="tri">
							<option value="piece">Pièce</option>
							<option value="type_commande">Type de commande</option>
							<option value="type_parametre" selected>Type de paramètre</option>
						</select>
						<input type="submit" value="Trier" id="bouton_tri"/>
						</p>
						</form>
					</div>

				</div>
			</div>
			<?php include('vue/footer.php'); ?>
		</body>
	</html>