<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <link rel="stylesheet" href="css/stylePanneauControle.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <title>MyHomeOnCommand</title>
    </head>
    
    <body>
        
        <?php include('vue/header.php');?>
        <div id='corps'>
        <?php include('vue/menuClient.php');?>
            
            <div class='tri'>
                <div class='nomTri'>Nom tri</div>
                <div class='infoCapteur'>info</div>
            
            </div>
            
        </div>
        <?php include('vue/footer.php');?>
            
    </body>
</html>