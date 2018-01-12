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
               
                $x_logement=0;
                while($x_logement<sizeof($logements))
                {
                    echo "<div><div class='ensemble'><div class='logement'><br>Logement: ".$logements[$x_logement+1]."<button class='bouton_aff_modal' data-modal='modal_".$logements[$x_logement]."'><i class='fa fa-pencil' aria-hidden='true'></i>
                    </button><form class='supprimer' method='post' action='index.php?page=gestionHabitationClient'>
                                    <input type='number' name='id' value='".$logements[$x_logement]."' style='visibility:hidden;' required/>
                                    <input type='submit' value='supprimer' name='bouton_supprimer_logement' />
                                </form></div><br><div id='modal_".$logements[$x_logement]."' class='modal'>
                          <div class='modal-content'>
                            <span class='close' id='close_".$logements[$x_logement]."' >&times;</span>
                                <form class='modif' method='post' action='index.php?page=gestionHabitationClient'>
                                    <label for='id' style='display:none;'>Id:</label>
                                    <input type='number' name='id' value='".$logements[$x_logement]."' style='visibility:hidden;' required/>
                                    <br><label for='nom'>Nom:</label>
                                    <br><input type='text' name='nom' value='".$logements[$x_logement+1]."' required/>
                                    <input type='submit' value='Modifier' name='bouton_modifier_logement' />
                                </form>
                          </div>
                        </div><br>";
                    
                    $x_piece=0;
                    while($x_piece<sizeof($pieces))
                    {
                        if($pieces[$x_piece+2]==$logements[$x_logement])
                        {
                            echo "<div class='logement'><br>piece:".$pieces[$x_piece+1]."<button class='bouton_aff_modal' data-modal='modal_".$pieces[$x_piece]."'><i class='fa fa-pencil' aria-hidden='true'></i>
                            </button></div><br><div id='modal_".$pieces[$x_piece]."' class='modal'>
                          <div class='modal-content'>
                            <span class='close' id='close_".$pieces[$x_piece]."' >&times;</span>
                                <form class='modif' method='post' action='index.php?page=gestionHabitationClient'>
                                    <label for='id' style='display:none;'>Id:</label>
                                    <input type='number' name='id' value='".$pieces[$x_piece]."' style='visibility:hidden;' required/>
                                    <br><label for='nom'>Nom:</label>
                                    <br><input type='text' name='nom' value='".$pieces[$x_piece+1]."' required/>
                                    <input type='submit' value='Modifier' name='bouton_modifier_piece' />
                                </form>
                          </div>
                        </div>";
                            $x_cemac=0;
                            while($x_cemac<sizeof($cemacs))
                            {
                                if($cemacs[$x_cemac+2]==$pieces[$x_piece])
                                {
                                    echo "<div class='logement'><br>cemac:".$cemacs[$x_cemac+1]."<button class='bouton_aff_modal' data-modal='modal_".$cemacs[$x_cemac]."'><i class='fa fa-pencil' aria-hidden='true'></i>
                                    </button></div><br><div id='modal_".$cemacs[$x_cemac]."' class='modal'>
                                  <div class='modal-content'>
                                    <span class='close' id='close_".$cemacs[$x_cemac]."' >&times;</span>
                                        <form class='modif' method='post' action='index.php?page=gestionHabitationClient'>
                                            <label for='id' style='display:none;'>Id:</label>
                                            <input type='number' name='id' value='".$cemacs[$x_cemac]."' style='visibility:hidden;' required/>
                                            <br><label for='nom'>Nom:</label>
                                            <br><input type='text' name='nom' value='".$cemacs[$x_cemac+1]."' required/>
                                            <input type='submit' value='Modifier' name='bouton_modifier_cemac' />
                                        </form>
                                  </div>
                                </div>";
                                    $x_equip=0;
                                    while($x_equip<sizeof($equipements))
                                    {
                                        if($equipements[$x_equip+2]==$cemacs[$x_cemac])
                                        {
                                            echo "<div class='logement'><br>equipement:".$equipements[$x_equip+1]."<button class='bouton_aff_modal' data-modal='modal_".$equipements[$x_equip]."'><i class='fa fa-pencil' aria-hidden='true'></i></button></div><br><div id='modal_".$equipements[$x_equip]."' class='modal'>
                                  <div class='modal-content'>
                                    <span class='close' id='close_".$equipements[$x_equip]."' >&times;</span>
                                        <form class='modif' method='post' action='index.php?page=gestionHabitationClient'>
                                            <label for='id' style='display:none;'>Id:</label>
                                            <input type='number' name='id' value='".$equipements[$x_equip]."' style='visibility:hidden;' required/>
                                            <br><label for='nom'>Nom:</label>
                                            <br><input type='text' name='nom' value='".$equipements[$x_equip+1]."' required/>
                                            <input type='submit' value='Modifier' name='bouton_modifier_equipement' />
                                        </form>
                                  </div>
                                </div>";
                                        }
                                        $x_equip+=3;
                                    }
                                }
                                $x_cemac+=3;
                            }
                        }
                        
                        $x_piece+=3;
                    }
                    echo "</div></div>";
                    $x_logement+=2;
                }
                    
							
				?>
                    
              <a href="index.php?page=ajouterHabitation"><input type='button' value='Ajouter'></a>
            </div>
            
            
        </div>
        <?php include('vue/footer.php');?>
        <script>
            var boutonsAffModal=document.querySelectorAll(".bouton_aff_modal");
            boutonsAffModal.forEach(function(bouton){
                bouton.onclick=function(){
                    var modal=bouton.getAttribute('data-modal');
                    document.getElementById(modal).style.display='block';
                }
            })
            
            var boutonsFermer=document.querySelectorAll(".close");
            boutonsFermer.forEach(function(bouton){
                bouton.onclick=function(){
                    var modal=bouton.closest('.modal');
                    modal.style.display='none';
                }
            })
            
            window.onclick = function(event){
                if(event.target.className== "modal")
                    {
                        event.target.style.display='none';
                        
                    }
            }
        </script>
    </body>
</html>

