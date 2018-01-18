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
                    echo "<div><div class='ensemble'><div class='logement'><br><h4>Logement: ".$logements[$x_logement+1]."</h4><button class='bouton_aff_modal' data-modal='modal_log_".$logements[$x_logement]."'><i class='fa fa-pencil' aria-hidden='true'></i>
                    </button></div><br><div id='modal_log_".$logements[$x_logement]."' class='modal'>
                          <div class='modal-content'>
                            <span class='close' id='close_".$logements[$x_logement]."' >&times;</span>
                                <form class='modif' method='post' action='index.php?page=gestionHabitationClient'>
                                    <label for='id' style='display:none;'>Id:</label>
                                    <input type='number' name='id' value='".$logements[$x_logement]."' style='visibility:hidden;' required/>
                                    <br><label for='nom'>Nom:</label>
                                    <br><input type='text' name='nom' value='".$logements[$x_logement+1]."' required/>
                                    <input type='submit' value='Modifier' name='bouton_modifier_logement' />
                                </form>
                                <form class='supprimer' method='post' action='index.php?page=gestionHabitationClient'>
                                    <input type='number' name='id' value='".$logements[$x_logement]."' style='visibility:hidden;' required/><br>
                                    <input type='submit' class='suppr' value='supprimer' name='bouton_supprimer_logement' />
                                </form>
                          </div>
                        </div><br>";
                    
                    $x_piece=0;
                    while($x_piece<sizeof($pieces))
                    {
                        if($pieces[$x_piece+2]==$logements[$x_logement])
                        {
                            echo "<div class='logement' style='margin-left:15px;margin-top:15px;'><br>Piece:".$pieces[$x_piece+1]."<button class='bouton_aff_modal' data-modal='modal_piece_".$pieces[$x_piece]."'><i class='fa fa-pencil' aria-hidden='true'></i>
                            </button></div><br><div id='modal_piece_".$pieces[$x_piece]."' class='modal'>
                          <div class='modal-content'>
                            <span class='close' id='close_".$pieces[$x_piece]."' >&times;</span>
                                <form class='modif' method='post' action='index.php?page=gestionHabitationClient'>
                                    <label for='id' style='display:none;'>Id:</label>
                                    <input type='number' name='id' value='".$pieces[$x_piece]."' style='visibility:hidden;' required/>
                                    <br><label for='nom'>Nom:</label>
                                    <br><input type='text' name='nom' value='".$pieces[$x_piece+1]."' required/>
                                    <input type='submit' value='Modifier' name='bouton_modifier_piece' />
                                </form>
                                <form class='supprimer' method='post' action='index.php?page=gestionHabitationClient'>
                                    <input type='number' name='id' value='".$pieces[$x_piece]."' style='visibility:hidden;' required/><br>
                                    <input type='submit' class='suppr' value='supprimer' name='bouton_supprimer_piece' />
                                </form>
                          </div>
                        </div>";
                            $x_cemac=0;
                            while($x_cemac<sizeof($cemacs))
                            {
                                if($cemacs[$x_cemac+2]==$pieces[$x_piece])
                                {
                                    echo "<div class='logement' style='margin-left:30px;'><br>Cemac:".$cemacs[$x_cemac+1]."<button class='bouton_aff_modal' data-modal='modal_cemac_".$cemacs[$x_cemac]."'><i class='fa fa-pencil' aria-hidden='true'></i>
                                    </button></div><br><div id='modal_cemac_".$cemacs[$x_cemac]."' class='modal'>
                                  <div class='modal-content'>
                                    <span class='close' id='close_".$cemacs[$x_cemac]."' >&times;</span>
                                        <form class='modif' method='post' action='index.php?page=gestionHabitationClient'>
                                            <label for='id' style='display:none;'>Id:</label>
                                            <input type='number' name='id' value='".$cemacs[$x_cemac]."' style='visibility:hidden;' required/>
                                            <br><label for='nom'>Nom:</label>
                                            <br><input type='text' name='nom' value='".$cemacs[$x_cemac+1]."' required/>
                                            <input type='submit' value='Modifier' name='bouton_modifier_cemac' />
                                        </form>
                                        <form class='supprimer' method='post' action='index.php?page=gestionHabitationClient'>
                                    <input type='number' name='id' value='".$cemacs[$x_cemac]."' style='visibility:hidden;' required/><br>
                                    <input type='submit' class='suppr' value='supprimer' name='bouton_supprimer_cemac' />
                                </form>
                                  </div>
                                </div>";
                                    $x_equip=0;
                                    while($x_equip<sizeof($equipements))
                                    {
                                        if($equipements[$x_equip+2]==$cemacs[$x_cemac])
                                        {
                                            echo "<div class='logement' style='margin-left:45px;'><br>Equipement:".$equipements[$x_equip+1]."<button class='bouton_aff_modal' data-modal='modal_equip_".$equipements[$x_equip]."'><i class='fa fa-pencil' aria-hidden='true'></i></button></div><br><div id='modal_equip_".$equipements[$x_equip]."' class='modal'>
                                  <div class='modal-content'>
                                    <span class='close' id='close_".$equipements[$x_equip]."' >&times;</span>
                                        <form class='modif' method='post' action='index.php?page=gestionHabitationClient'>
                                            <label for='id' style='display:none;'>Id:</label>
                                            <input type='number' name='id' value='".$equipements[$x_equip]."' style='visibility:hidden;' required/>
                                            <br><label for='nom'>Nom:</label>
                                            <br><input type='text' name='nom' value='".$equipements[$x_equip+1]."' required/>
                                            <input type='submit' value='Modifier' name='bouton_modifier_equipement' />
                                        </form>
                                        <form class='supprimer' method='post' action='index.php?page=gestionHabitationClient'>
                                    <input type='number' name='id' value='".$equipements[$x_equip]."' style='visibility:hidden;' required/><br>
                                    <input type='submit' class='suppr' value='supprimer' name='bouton_supprimer_equip' />
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
                    
                
                <div><a href="index.php?page=ajouterHabitation"><input type='button' value='Ajouter'></a><button id="bouton_aff_modif">Modifier</button></div>
            </div>
            
            
        </div>
        <?php include('vue/footer.php');?>
        <script>
            
            var boutonSuppr=document.querySelectorAll(".suppr");
            boutonSuppr.forEach(function(bouton){
                bouton.onclick=function(){
                    return confirm('Confirmez la suppression? Cela entrainera la suppression des entitées dépendentes.');
                }
            })
            
            var boutonsAffModal=document.querySelectorAll(".bouton_aff_modal");
            boutonsAffModal.forEach(function(bouton){
                bouton.onclick=function(){
                    var modal=bouton.getAttribute('data-modal');
                    document.getElementById(modal).style.display='block';
                }
            })
            boutonsAffModal.forEach(function(bouton){
                bouton.style.display='none';
            })
            var boutonAffModif=document.querySelector("#bouton_aff_modif");
            boutonAffModif.onclick=function(){
                if(boutonsAffModal[0].style.display=='none')
                {
                    boutonsAffModal.forEach(function(bouton){
                    bouton.style.display='';
                    })
                }
                else
                {
                    boutonsAffModal.forEach(function(bouton){
                    bouton.style.display='none';
                    })
                }
            }
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

