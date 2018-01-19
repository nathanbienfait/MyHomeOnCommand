<!DOCTYPE html>

	<html>

		<head>
			<meta charset='utf-8'/>
			<link rel="stylesheet" href="css/styleHeaderFooter.css"/>
			<link rel="stylesheet" href="css/styleMenu.css" />
			<link rel="stylesheet" href="css/stylePanneauClientTrie.css"/>
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
							$compteType+=1;
							$fond = ObtenirImageTypeEquipement($idtypeEquipement);
							$id_logements = ObtenirLogementsAvecType($idtypeEquipement, $_SESSION['id']);
							$type_equipement = ObtenirTypeEquipementDepuisId($idtypeEquipement);
							$unite = ObtenirUniteTypeEquipement($idtypeEquipement);
							echo "<div class='bloc_type_equipement'>";	/* début div 1 */
							echo "<div  class='titre_image'>"; /* début div 2 */
							echo '<div id=\'bouton' . $compteType . '\'>'; /*début div 3 */
							echo '<h1>' . ucfirst($type_equipement) . '</h1>';
							echo '<div><img src=\'' . $fond . '\' alt=\'' . $idtypeEquipement . '\' class=\'photo\'></div>';

							echo "</div>"; /*fin div 3 */
							echo "</div>";	/* fin div 2 */
							if(!empty($id_logements))
							{
								foreach($id_logements as $id_logement)
								{
									$compteLogement+=1;
									echo "<div class='nom_logement'>"; /*début div 5*/
									echo '<div class=\'voirLogements' . $compteType . '\'>';	/*début div 4 */
									$nom_logement = Obtenir_nom_logement($id_logement);
									echo '<h2>' . $nom_logement . '</h2>';
									echo "</div>"; /* fin div 5 */
									echo "</div>";	/* fin div 4 */
									$equipements = ObtenirEquipementsDunTypeEtLogement($idtypeEquipement, $id_logement, $_SESSION['id']);
									/*echo '<div id=\'voirDonnees' . $compteLogement . '\'>'; /* début div 6 */
									echo "<div class='liste_donnees'>";	 /*début div 7*/
									foreach ($equipements as $equipement)
									{
										$piece=ObtenirPieceDeLequipement($equipement);
										$etat=ObtenirEtatEquipement($equipement);
										echo "<div class='bloc_donnees'>";	/* début div 8 */
										echo $piece . '</br>';
										$donnee_equipement = Obtenir_derniere_donnee_equipement($equipement);

										if($type_equipement == "ouverture")
										{
											if($donnee_equipement == 0)
											{
												echo "Fermé";
												echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
												echo '<label for=\'valeur_cible\' class=\'label\'>Contrôler l\'ouverture à distance</label></br>';
												echo '<select name=\'valeur_cible\'>';
												echo '<option value=\'ouvert\'selected>Ouvrir</option>';
												echo '<option value=\'type_parametre\'>Fermer</option>';
												echo '</select>';
												echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $equipement . '\'/>';
												echo '<input type=\'hidden\' name=\'tri\' value=\'type_parametre\'/>';
												echo '<input type=\'submit\' value=\'Appliquer\'/>';

											}
											else
											{
												echo "Ouvert";
												echo '</br>';
												echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
												echo '<label for=\'valeur_cible\' class=\'label\'>Contrôler l\'ouverture à distance</label></br>';
												echo '<select name=\'valeur_cible\'>';
												echo '<option value=\'ouvert\'>Ouvrir</option>';
												echo '<option value=\'type_parametre\'selected>Fermer</option>';
												echo '</select>';
												echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $equipement . '\'/>';
												echo '<input type=\'hidden\' name=\'tri\' value=\'type_parametre\'/>';
												echo '<input type=\'submit\' value=\'Appliquer\'/>';
											}
										}
										elseif($type_equipement == "fumee")
										{
											if($donnee_equipement == 0)
											{
												echo 'Aucun problème à signaler.';
											}
											else
											{
												echo 'ATTENTION TAUX ANORMAL DE FUMEE DETECTE';
											}
										}
										elseif(!empty($unite))
										{
											echo $donnee_equipement;
											echo $unite;
											echo '</br>';
											echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
											echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
											if($unite == "%") {$max=100;} else {$max=40;}
											echo '<input type=\'number\' name=\'valeur_cible\' min=\'0\' max=\'' . $max . '\'>';
											echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $equipement . '\'/>';
											echo '<input type=\'hidden\' name=\'tri\' value=\'type_parametre\'/>';
											echo '<input type=\'submit\' value=\'Appliquer\'/>';
										}

										echo "</form>";

										if($etat==1)
										{
											echo '<div><img src=\'images/bonEtat.png\' alt=\'Etat_Bon\' class=\'etat\'></div>';
										}
										else
										{
											echo '<div><img src=\'images/mauvaisEtat.png\' alt=\'Etat_Mauvais\' class=\'etat\'></div>';
										}

										echo "</div>"; /* fin div 8 */
									}
									echo "</div>"; /* fin div 7 */
									/*echo "</div>";	/* fin div 6 */
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
							<option value="type_parametre" selected>Type de paramètre</option>
						</select>
						<input type="submit" value="Trier" id="bouton_tri"/>
						</p>
						</form>
					</div>

				</div>
			</div>
			<?php include('vue/footer.php'); ?>

		<script type="text/javascript">
			tabLogements = new Array();
			tabDonnees = new Array();
			for(var i = 0 ; i < <?php $compteType ; ?> ; i++)
			{
				tabLogements[i] = getElementsByClass('voirLogements' + i);
			}

			for(var i = 0 ; i < <?php $compteLogement ; ?> ; i++)
			{
				tabDonnees[i] = getElementsByClass('voirDonnees' + i);
			}

			function Afficher_Cacher(x)
			{
				if(x.style.display=="block")
				{
					x.style.display = "none";
				}
				else
				{
					x.style.display = "block";
				}
			}

		</script>
		</body>
	</html>
