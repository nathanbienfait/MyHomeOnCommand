<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleSupportClient.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <title>MyHomeOnCommand</title>
    </head>
    <?php include('vue/header.php');?>
    <body>
        <div id="corps">
    	   <?php include('vue/menuClient.php');?>

    	   <div id="CorpTexte">
                
               <div id="contactSupport">
                    <a id="textcontact" href="index.php?page=messagerieClient">contactez le support</a>
               </div>
               <div>
                    <?php foreach($tableauqr as $truc): ?>
                        <div class="groupeq"><strong>QUESTION: </strong><br><?php echo nl2br($truc['contenu_q']);?></br></div>
                        <div class="grouper"><strong>REPONSE: </strong><br><?php echo nl2br($truc['contenu_r']); ?></div>
                    <?php endforeach;  ?>
               </div>
                
    	   </div>
        </div>

    </body>
    <?php include('vue/footer.php');?>
</html>
