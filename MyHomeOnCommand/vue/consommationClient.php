<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleConsommationClient.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <title>MyHomeOnCommand</title>
</head>

<body>
	<?php
		include("header.php");
	?>

	<div id="corps">

		<?php
		include("menuClient.php");
		?>
		<div id="graph">
		<ul id="liste_graph">
			<li id="lumieres">Temps moyen d'utilisation des lumières 
				<img id="imagegraphe1" src="images/exgraphe1.png" alt="utilisation lumiere" />
			</li>
			<li id="electricite">Consommation d'électricité
				<img id="imagegraphe2" src="images/exgraphe2.png" alt="consommation electricite" />
			</li> 
			<li id="eau">Consommation d'eau
				<img id="imagegraphe1" src="images/exgraphe1.png" alt="consommation eau" />
			</li>
			<li id="gaz">Consommation de gaz
				<img id="imagegraphe2" src="images/exgraphe2.png" alt="consommation gaz" />
			</li>
		</ul>
		</div>
	</div>
	<div id="footer">
	<?php
		include("footer.php");
	
	?>
	</div>
	

</body>

</html>