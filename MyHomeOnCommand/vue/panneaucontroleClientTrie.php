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
				<div id='paslemenu'> <!-- tout ce qui est à droite du menu !-->
					
					<div id='panneau_controle_bloc_principal'> <!-- toute l'interface permettant l'affichage des données !-->
						<?php
						foreach($idtypesEquipement as $idtypeEquipement) /* on affiche un à un les différents types d'équipement */
						{
							$typeDonnees=ObtenirTypeDonnees($idtypeEquipement);
							$fond = ObtenirImageTypeEquipement($idtypeEquipement);
							$id_logements = ObtenirLogementsAvecType($idtypeEquipement, $_SESSION['id']);
							$type_equipement = ObtenirTypeEquipementDepuisId($idtypeEquipement);
							$unite = ObtenirUniteTypeEquipement($idtypeEquipement);
							echo "<div class='bloc_type_equipement'>";	/* début div 1 */ /*contient toutes les informations relatives à 1 type d'équipement */
							echo "<div  class='titre_image'>"; /* début div 2 */
							echo '<h1>' . ucfirst($type_equipement) . '</h1>';
							echo '<div><img src=\'' . $fond . '\' alt=\'' . $idtypeEquipement . '\' class=\'photo\'></div>'; /* affiche l'image de fond liée au type d'équipement en fonction de son adresse */
							echo "</div>";	/* fin div 2 */
							if(!empty($id_logements)) /* on vérifie qu'au moins un logement possède ce type d'équipement */
							{
								foreach($id_logements as $id_logement)
								{
									echo "<div class='nom_logement'>"; /*début div 5*/
									$nom_logement = Obtenir_nom_logement($id_logement);
									echo '<h2>' . $nom_logement . '</h2>';
									echo "</div>"; /* fin div 5 */
									$equipements = ObtenirEquipementsDunTypeEtLogement($idtypeEquipement, $id_logement, $_SESSION['id']);
									echo "<div class='liste_donnees'>";	 /*début div 7*/
									foreach ($equipements as $equipement) /* on affiche un à un les équipements du bon type dans le logement */
									{
										$piece=ObtenirPieceDeLequipement($equipement);
										$etat=ObtenirEtatEquipement($equipement);
										echo "<div class='bloc_donnees'>";	/* début div 8 */ /* contient les données des équipements */
										echo $piece . '</br>';
										$donnee_equipement = Obtenir_derniere_donnee_equipement($equipement);

										if($typeDonnees == 1) /* si les données de ce type d'équipement sont binaires : */
										{
											if($donnee_equipement == 0) /* et si les données sont à 0 */
											{
												$message=ObtenirMessageBas($idtypeEquipement);
												echo $message;
												echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
												echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
												echo '<select name=\'valeur_cible\'>';
												echo '<option value=\'1\'selected>Ouvrir/activer</option>';
												echo '</select>';
												echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $equipement . '\'/>';
												echo '<input type=\'hidden\' name=\'tri\' value=\'type_parametre\'/>';
												echo '<input type=\'submit\' value=\'Appliquer\'/>';
											}
											else /* et si les données sont à 1 */
											{
												$message=ObtenirMessageHaut($equipement);
												echo $message;
												echo '</br>';
												echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
												echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
												echo '<select name=\'valeur_cible\'>';
												echo '<option value=\'0\'selected>Fermer/désactiver</option>';
												echo '</select>';
												echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $equipement . '\'/>';
												echo '<input type=\'hidden\' name=\'tri\' value=\'type_parametre\'/>';
												echo '<input type=\'submit\' value=\'Appliquer\'/>';
											}
										}
										
										else /* si les données de ce type d'équipement ne sont pas binaires */
										{
											echo $donnee_equipement;
											echo $unite;
											echo '</br>';
											echo '<form action=\'index.php?page=panneau\' method=\'post\'>';
											echo '<label for=\'valeur_cible\' class=\'label\'>Indiquer valeur cible</label></br>';
											if($unite == "%") {$max=100;} else {$max=1000000;}
											echo '<input type=\'number\' name=\'valeur_cible\' min=\'0\' max=\'' . $max . '\'>';
											echo '<input type=\'hidden\' name=\'id_equipement\' value=\'' . $equipement . '\'/>';
											echo '<input type=\'hidden\' name=\'tri\' value=\'type_parametre\'/>';
											echo '<input type=\'submit\' value=\'Appliquer\'/>';
										}

										echo "</form>";

										if($etat==1) /* on affiche si l'équipement fonctionne */
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
								}
							}
							else /* se lance s'il n'y pas de logement équipé de ce type d'équipement */
							{
								echo "<div class='pas_equipement'>Ce type d'équipement n'est présent dans aucun de vos logements. Vous pouvez vous en procurer dans nos boutiques !</div>";
							}
							echo "</div>";	/* fin div 1 */
						}	

							?>								
					</div>

					<div id='trier'> <!-- on choisit la façon dont on veut afficher les équipements !-->
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
