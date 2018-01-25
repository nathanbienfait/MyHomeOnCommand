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
				<div id='paslemenu'> <!-- début div 2 --> <!-- on définit tout ce qui se trouve à droite du menu !-->
					
					<div id='panneau_controle_bloc_principal'> <!-- début div 3 --> <!-- les éléments dans ce div se rapportent à l'affichage des données !-->
						<?php
						array_filter($id_logements);
						if(empty($id_logements))
						{
							echo "<div id='pasDeLogement'>";
							echo "Veuillez renseigner les informations liées à votre logement dans l'onglet 'Gestion de l'habitation'";
							echo "</div>";
						}
						else
						{
						foreach($id_logements as $id_logement) /*on prend un à un chaque logement de l'utilisateur */
						{
							echo '<div class=\'case_logement\'>'; /* début div 4 */ /*cette div contient toutes les infos du logement */
								$nom_logement=$panneau->Obtenir_nom_logement($id_logement);
								echo '<h1 class="titre_logement">' . $nom_logement . '</h1>';
								$id_pieces=$panneau->Obtenir_id_pieces($id_logement);
								foreach($id_pieces as $id_piece) /*on prend un à un chaque pièce du logement */
								{
									echo '<div class=\'case_piece\'>'; /* début div 6 */
									echo '<div class=\'nom_piece\'>';
										$nom_piece=$panneau->Obtenir_nom_piece($id_piece);
										echo '<h1>';
										echo $nom_piece;
										echo '</h1>';
										echo '</div>';
										echo '<div class=\'liste_equipements\'>'; /* début div 7 */
										foreach($panneau->Obtenir_id_equipements($id_piece) as $id_equipement) /* on prend un à un chaque équipement dans la pièce */
										{
											echo '<div class=\'case_equipement\'>'; /* début div 8 */ /*on affiche ici toutes les informations liées aux equipements */
											$nom_equipement=$panneau->ObtenirNomEquipement($id_equipement);
											$etat=$panneau->ObtenirEtatEquipement($id_equipement);
											$type_equipement=$panneau->Obtenir_type_equipement($id_equipement);
											$id_type_equipement=$panneau->ObtenirIdTypeEquipementDepuisNom($type_equipement);
											$typeDonnees=$panneau->ObtenirTypeDonnees($id_type_equipement);
											$logo=$panneau->ObtenirLogoTypeEquipement($id_type_equipement);
											$unite=$panneau->ObtenirUniteTypeEquipement($id_type_equipement);
											$donnee_equipement=$panneau->Obtenir_derniere_donnee_equipement($id_equipement);
											
											echo '<h2>' . ucfirst($type_equipement) . '</h2>';
											echo '<div class="photo"><img src=\'' . $logo . '\' alt=\'' . $type_equipement . '\' class=\'' . $type_equipement . '\'></div>'; /* on affiche le logo de l'équipement en fonction de l'adresse dans la bdd */

											echo '</br>';
											echo '<h2 class=\'nomEquipement\'>' . $nom_equipement . '</h2>';
											if($typeDonnees==2) /* si les données ne sont pas binaires : */
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
											elseif($typeDonnees==1) /* si les données sont binaires : */
											{	
												if ($donnee_equipement==0)
												{
													$message=$panneau->ObtenirMessageBas($id_type_equipement);
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
													$message=$panneau->ObtenirMessageHaut($id_type_equipement);
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

											if($etat==1) /* on affiche à l'aide d'une image si l'équipement fonctionne */
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
							echo '</div>';	/* fin div 4 */
						}
					}	
					?>
					</div> <!-- fin div 3 -->

					<div id='trier'> <!-- ce formulaire permet de choisir la facon dont on affiche les equipements !-->
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
				var pieces=document.querySelectorAll("")
			</script>
		</body>
	</html>
