<!DOCTYPE html>

	<html>

		<head>
			<meta charset='utf-8'/>
			<link rel="stylesheet" href="style_panneaucontrole"/>
			<title> <?php htmlspecialchars($title); ?> </title>
		</head>


<!--On affiche le formulaire de tri des équipements!-->
		<body>
			<section>
				<div id='trier'>
					<form action="" method="post">
					<p>
					<label for="tri">Trier par :</label>
					<select name="tri" id="tri">
						<option value="piece">Pièce</option>
						<option value="type_commande">Type de commande</option>
						<option value="type_parametre">Type de paramètre</option>
					</select>
					</p>
					</form>
				</div>



				<?php
				while($logement)	// on affiche les logements de l'utilisateur
				{
					echo "<div class='logement'>";
						echo $logement['nom_logement'];
						while($piece)	//on affiche les pieces de chaque logement
						{
							echo "<div class='piece'>";
								echo $piece['nom_piece'];
								while($equipement)	//on affiche les equipements de chaque piece
								{
									echo "<div class='equipement'>";
										$i=0;
										echo $equipement['nom_equipement'];
										echo $i;
										$i+=1;
										while($type_equipement)
										{
											if($type_equipement=='temperature')
											{
												echo "<img src='' alt='thermometre' id='thermometre'/>";
												while($donnees_equipement)
												{
													echo $donnees_equipement['valeur'];
													echo "°C";
												}
											}
											if ($type_equipement=="humidite")
											{
												echo "<img src='' alt='humidite' id='humidite'/>";
												while($donnees_equipement)
												{
													echo $donnees_equipement['valeur'];
													echo "%";
													
												}
											}
											if ($type_equipement=="ouverture")
											{
												echo "<img src='' alt='ouverture' id='ouverture'/>";
												while($donnees_equipement)
												{
													if($donnees_equipement['valeur']==0)
													{
														echo "FERME";
													}
													else
													{
														echo "OUVERT";
													}
												}
											}
											if ($type_equipement=="fumee")
											{
												echo "<img src='' alt='fumée' id='fumee'/>";
												while($donnees_equipement)
												{
													if($donnees_equipement['valeur']==0)
													{
														echo "Tout va bien";
													}
													else
													{
														echo "Tout va mal";
													}
												}						
											}
										}
									echo "</div>";
								}
							echo "</div>";	
						}
					echo "</div>";
				}
				?>
			</section>
		</body>
	</html>


