<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/stylegeneral.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <link rel="stylesheet" href="css/styleAjouterHabitation.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <title>MyHomeOnCommand</title>
    </head>
    
    <body>
        
        <?php include('vue/header.php');?>
        
        <div id='corps'>
        <?php include('vue/menuClient.php');?>
           
                            
            <div class='tableauDajout'>
                
                    
                 <form id="logement" method="post" action="index.php?page=ajouterHabitation">
                    <p>Ajouter un logement:</p>
                    <p>
                        <label for="nomLogement">Nom de votre logement:</label>
                        </br>
                        <input type="text" id="nomLogement" name="nomLogement" required/>
                        </br>
                        </br>
                        <label for="rue">Rue:</label>
                        </br>
                        <input type="text" id="rue" name="rue" required/>
                        </br>
                        </br>
                        <label for="ville">Ville:</label>
                        </br>
                        <input type="text" id="ville" name="ville" required/>
                        </br>
                        </br>
                        <label for="cp">Code postal:</label>
                        </br>
                        <input type="text" id="cp" name="cp" required/>
                        </br>
                        </br>
                        <label for="pays">Pays:</label>
                        </br>
                        <input type="text" id="pays" name="pays" required/>
                        </br>
                        </br>
                        <input type="submit" value="Ajouter le logement" name="bouton_ajouter_logement" />  
                    </p>
                </form>
            </div>

            <div class='tableauDajout'>
                
                    
                 <form id="piece" method="post" action="index.php?page=ajouterHabitation">
                    <p>Ajouter une pièce:</p>
                    <p>
                        <label for="nomLogementPiece">Nom de votre logement:</label>
                        </br>
                        <select type="text" id="nomLogementPiece" name="nomLogementPiece" required>
                            <option value="" disabled selected>Séléctionner le logement</option>
                            <?php
                                $x=0;
                               
                                while($x<sizeof($tableauNomLogement))
                                {
                                echo "<option value='".$tableauNomLogement[$x]."'>".$tableauNomLogement[$x+1]."</option>";
                                $x=$x+2;
                                }
                            ?>
                            
                        </select>
                        </br>
                        </br>
                        <label for="nomPiece">Nom de votre pièce:</label>
                        </br>
                        <input type="text" id="nomPiece" name="nomPiece" required/>
                        </br>
                        </br>
                        <input type="submit" value="Ajouter la pièce" name="bouton_ajouter_piece" />  
                    </p>
                </form>
            </div>


            <div class='tableauDajout'>
                
                    
                 <form id="cemac" method="post" action="index.php?page=ajouterHabitation">
                    <p>Ajouter un CeMac:</p>
                    <p>
                        <label for="nomLogementPieceCemac">Nom de votre logement:</label>
                        </br>
                        <select type="text" id="nomLogementPieceCemac" name="nomLogementPieceCemac" required>
                            <option value="" disabled selected>Séléctionner le logement</option>
                             <?php
                                $x=0;
                               
                                while($x<sizeof($tableauNomLogement))
                                {
                                echo "<option value='".$tableauNomLogement[$x]."'>".$tableauNomLogement[$x+1]."</option>";
                                $x=$x+2;
                                }
                            ?>
                        </select>
                        </br>
                        </br>
                        <label for="nomPieceCemac">Nom de votre piece:</label>
                        </br>
                       
                        <select type="text" id="nomPieceCemac" name="nomPieceCemac" required>
                             <option value="" style='display: none' disabled selected>Séléctionner la pièce</option>
                            <?php
                                
                                $x=0;
                               
                                while($x<sizeof($tableauNomPiece))
                                {
                                echo "<option class='piece' id='".$tableauNomPiece[$x+2]."' value='".$tableauNomPiece[$x]."' style='display: none'>".$tableauNomPiece[$x+1]."</option>";
                                $x=$x+3;
                                }
                            ?>
                        </select>
                        </br>
                        </br>
                        <label for="nomCemac">Nom de votre CeMac:</label>
                        </br>
                        <input type="text" id="nomCemac" name="nomCemac" required/>
                        </br>
                        </br>
                        <input type="submit" value="Ajouter le CeMac" name="bouton_ajouter_cemac" />  
                    </p>
                </form>
            </div>

            
            <div class='tableauDajout'>
                
                    
                 <form id="equipement" method="post" action="index.php?page=ajouterHabitation">
                    <p>Ajouter un équipement:</p>
                    <p>
                        <label for="nomLogementPieceCemacEquipement">Nom de votre logement:</label>
                        </br>
                        <select type="text" id="nomLogementPieceCemacEquipement" name="nomLogementPieceCemacEquipement" required>
                            <option value="" disabled selected>Séléctionner le logement</option>
                             <?php
                                $x=0;
                               
                                while($x<sizeof($tableauNomLogement))
                                {
                                echo "<option value='".$tableauNomLogement[$x]."'>".$tableauNomLogement[$x+1]."</option>";
                                $x=$x+2;
                                }
                            ?>
                        </select>
                        </br>
                        </br>
                        <label for="nomPieceCemacEquipement">Nom de votre piece:</label>
                        </br>
                        <select type="text" id="nomPieceCemacEquipement" name="nomPieceCemacEquipement" required>
                            <option value="" style='display: none' disabled selected>Séléctionner la pièce</option>
                            <?php
                                
                                $x=0;
                               
                                while($x<sizeof($tableauNomPiece))
                                {
                                echo "<option class='piece2' id='".$tableauNomPiece[$x+2]."' value='".$tableauNomPiece[$x]."' style='display: none'>".$tableauNomPiece[$x+1]."</option>";
                                $x=$x+3;
                                }
                            ?>
                        </select>
                        </br>
                        </br>
                        <label for="nomCemacEquipement">Nom de votre CeMac:</label>
                        </br>
                        <select type="text" id="nomCemacEquipement" name="nomCemacEquipement" required>
                            <option value="" style='display: none' disabled selected>Séléctionner le CeMac</option>
                            <?php
                                
                                $x=0;
                               
                                while($x<sizeof($tableauNomCemac))
                                {
                                echo "<option class='cemac' id='".$tableauNomCemac[$x+2]."' value='".$tableauNomCemac[$x]."' style='display: none'>".$tableauNomCemac[$x+1]."</option>";
                                $x=$x+3;
                                }
                            ?>
                            
                        </select>
                        </br>
                        </br>
                        <label for="typeEquipement">Type de votre equipement:</label>
                        </br>
                        <select type="text" id="typeEquipement" name="typeEquipement" required>
                            <option value="" style='display: none' disabled selected>Séléctionner le type</option>
                            <?php
                                
                                $x=0;
                               
                                while($x<sizeof($tableauNomType))
                                {
                                echo "<option class='type' value='".$tableauNomType[$x]."'>".$tableauNomType[$x+1]."</option>";
                                $x=$x+2;
                                }
                            ?>
                        </select>
                        </br>
                        </br>
                        <label for="nomEquipement">Nom de votre équipement:</label>
                        </br>
                        <input type="text" id="nomEquipement" name="nomEquipement" required/>
                        </br>
                        </br>
                        <input type="submit" value="Ajouter l'équipement" name="bouton_ajouter_equipement" />  
                    </p>
                </form>
            </div>
        </div>
        <?php include('vue/footer.php');?>


<script>
    var select = document.querySelector('#nomLogementPieceCemac');
    
    select.addEventListener('change', function() {
        var idLogement=select.value;
        var x=0;
        var opt = document.querySelectorAll('.piece');
        while(x<opt.length)
        {
            opt[x].style.display="none";
            x++;
        }
        x=0;
        while(x<opt.length)
        {
            if(opt[x].id==idLogement)
            {
                opt[x].style.display="inline";
            }
            x++;
        }
    });
    var sel = document.querySelector('#nomLogementPieceCemacEquipement');
    sel.addEventListener('change', function() {
        var idLogement=sel.value;
        var x=0;
        var opt = document.querySelectorAll('.piece2');
        while(x<opt.length)
        {
            opt[x].style.display="none";
            x++;
        }
        x=0;
        while(x<opt.length)
        {
            if(opt[x].id==idLogement)
            {
                opt[x].style.display="inline";
            }
            x++;
        }
    });
    var piec = document.querySelector('#nomPieceCemacEquipement');
    piec.addEventListener('change', function() {
        var idPiece=piec.value;
        var x=0;
        var opt = document.querySelectorAll('.cemac');
        while(x<opt.length)
        {
            opt[x].style.display="none";
            x++;
        }
        x=0;
        while(x<opt.length)
        {
            if(opt[x].id==idPiece)
            {
                opt[x].style.display="inline";
            }
            x++;
        }
    });
</script>
            
    </body>
</html>