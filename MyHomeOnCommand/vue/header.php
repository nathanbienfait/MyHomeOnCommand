<div id="bandeau_accueil">
    <div id="logo"><a href="index.php?page=<?php if(isset($_SESSION['type'])){if($_SESSION['type']==3){echo "panneau";}if($_SESSION['type']==1){echo "adminPanneauClient";}}else{echo "accueil";} ?>" title="Accueil"><img id="imagelogo" src="images/logo.png" alt="Logo de MyHomeOnCommand" /></a></div>
        <div id="titre">A connected home in a connected world
    <?php 
        if(isset($_SESSION['prenom']))
        {
            if($_SESSION['type']==3)
            {
                $info=infoBandeau($_SESSION['id']);
                echo "</br></br><div id='sousTitre'>Bonjour ".$info['prenom']." ". $info['nom']."</div>";
            }
            if($_SESSION['type']==1)
            {
                echo "</br></br><div id='sousTitre'>Bonjour administrateur ".$_SESSION['prenom']."</div>";
            }
            
        }
    ?>
    </div>
    
</div>
<div id='bandeau_invisible'></div>