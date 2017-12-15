<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleConsommationAdmin.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        
        <title>MyHomeOnCommand</title>
    </head>

    <body>
    <?php include("header.php"); ?>

    <div id="corps">

        <?php include("menuAdmin.php"); ?>

        <ul id="liste_graph">
            <li id="lumieres">Temps moyen d'utilisation des lumières </br>
                <img id="imagegraphe2" src="images/exgraphe2.png" alt="Exemple de graphe" /></li>
            <li id="electricite">Consommation d'électricité </br>
                <img id="imagegraphe1" src="images/exgraphe1.png" alt="Exemple de graphe" /></li> 
            <li id="eau">Consommation d'eau </br>
                <img id="imagegraphe1" src="images/exgraphe1.png" alt="Exemple de graphe" /></li>
            <li id="gaz">Consommation de gaz </br>
                <img id="imagegraphe2" src="images/exgraphe2.png" alt="Exemple de graphe" /></li>
        </ul>

    </div>

    <?php include("footer.php"); ?>

</body>
</html>
