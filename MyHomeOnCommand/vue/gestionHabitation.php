<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <link rel="stylesheet" href="css/styleGestionHabitation.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <title>MyHomeOnCommand</title>
    </head>
    
    <body>
        
        <?php include('vue/header.php');?>
        
        <div id='corps'>
        <?php include('vue/menuClient.php');?>
            <div id='tableauDeGestion'>
                
                <?php
						foreach($id_logements as $id_logement)
						{
                            echo "<div class='logement'>
                            <form class='connexion' method='post' action='index.php?page=adminPanneauClient'>";
                            
								$nom_logement=Obtenir_nom_logement($id_logement);
								echo "<label for='nomLogement'>Logement</label><br><input type='text'  name='nomLogement' value='".$nom_logement."' required/></br></br>";
								
								$id_pieces=Obtenir_id_pieces($id_logement);
								$numeroPiece=1;
								foreach(Obtenir_id_pieces($id_logement) as $id_piece)
								{
									
                                    $nom_piece=Obtenir_nom_piece($id_piece);
                                    echo "</br></br><label for='nomPiece".$numeroPiece."'>Pièce ".$numeroPiece."</label><br><input type='text'  name='nomPiece".$numeroPiece."' value='".$nom_piece."' required/></br>";
                                    $numeroPiece++;
                                    $numeroEquip=1;
                                    foreach(Obtenir_id_equipements($id_piece) as $id_equipement)
                                    {
                                        if($numeroEquip==1)
                                        {
                                            echo "<p>Equipement de cette pièce</p>";
                                        }
                                        $type_equipement=Obtenir_type_equipement($id_equipement);
                                        echo "<input type='text'  name='nomEquipement".$numeroEquip."' value='".$type_equipement."' required/></br></br>";
                                        $numeroEquip++;
                                      

                                    }
                               
								}
								
								echo '</form></div>';
								}
								
                
							
						?>
                    
              <a href="index.php?page=ajouterHabitation"><input type='button' value='Ajouter'></a>
            </div>
            
            
        </div>
        <?php include('vue/footer.php');?>
            
    </body>
</html>

