<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleConditionsUtilisationsMentionslegales.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        
        <title>MyHomeOnCommand</title>
	</head>

	<body>
	<?php include("header.php"); ?>
 <!-- Permet d'afficher le contenu des conditions d'utilisation (modifiables depuis un compte admin !-->
	<div id="corps"> <p> <?php echo afficheTextCond()?> </p>
  	</div>

	<?php include("footer.php"); ?>

</body>
</html>
