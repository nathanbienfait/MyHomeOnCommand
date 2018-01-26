<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        <link rel="stylesheet" href="css/styleAjouterHabitation.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <title>MyHomeOnCommand</title>
    </head>

    <body>
        <script src="https://use.fontawesome.com/584565f215.js"></script>
        <?php include('vue/header.php');?>

        <div id='corps'>
        <?php include('vue/menuClient.php');?>
            <div id='corpsdroit'>
            <div id='partieBouton'>
                <!-- on crée chaque bouton qui permet d'afficher un formulaire associé!-->
            <div> <p id="tablogement" class="titre">Ajouter un Logement &nbsp&nbsp<i class="fa fa-chevron-right" aria-hidden="true"></i></p>




            </div>
            <div> <p id="tabpiece" class="titre">Ajouter une pièce&nbsp&nbsp<i class="fa fa-chevron-right" aria-hidden="true"></i></p>





            </div>
            <div> <p id="tabcemac" class="titre">Ajouter un CeMac&nbsp&nbsp<i class="fa fa-chevron-right" aria-hidden="true"></i></p>





            </div>
            <div> <p id="tabequipement" class="titre">Ajouter un équipement&nbsp&nbsp<i class="fa fa-chevron-right" aria-hidden="true"></i></p>





        </div>
        </div>
            <div id="partieForm">
                <!-- on crée chaque formulaire associé à chaque bouton !-->
                <form id="logement" method="post" action="index.php?page=ajouterHabitation" onsubmit="return verifForm(this)">

                    <p>
                        <label for="nomLogement">Nom de votre logement:</label>
                        </br>
                        <input type="text" id="nomLogement" name="nomLogement" onblur="verifNom(this)" required/>
                        </br>
                        </br>
                        <label for="rue">Rue:</label>
                        </br>
                        <input type="text" id="rue" name="rue" onblur="verifNom(this)" required/>
                        </br>
                        </br>
                        <label for="ville">Ville:</label>
                        </br>
                        <input type="text" id="ville" name="ville" onblur="verifNom(this)" required/>
                        </br>
                        </br>
                        <label for="cp">Code postal:</label>
                        </br>
                        <input type="text" id="cp" name="cp" onblur="verifNum(this)" required/>
                        </br>
                        </br>
                        <label for="pays">Pays:</label>
                        </br>
                        <input type="text" id="pays" name="pays" onblur="verifNom(this)" required/>
                        </br>
                        </br>
                        <input type="submit" value="Ajouter le logement" name="bouton_ajouter_logement" />
                    </p>
                </form>

                <form id="piece" method="post" action="index.php?page=ajouterHabitation">

                    <p>
                        <label for="nomLogementPiece">Nom de votre logement:</label>
                        </br>
                        <select type="text" id="nomLogementPiece" name="nomLogementPiece" required>
                            <option value="" disabled selected>Séléctionner le logement</option>
                            <?php
                                $x=0;
                                //on affiche les logement de la personne dans la liste déroulante du formulaire
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

                <form id="cemac" method="post" action="index.php?page=ajouterHabitation">

                    <p>
                        <label for="nomLogementPieceCemac">Nom de votre logement:</label>
                        </br>
                        <select type="text" id="nomLogementPieceCemac" name="nomLogementPieceCemac" required>
                            <option value="" disabled selected>Séléctionner le logement</option>
                             <?php
                                $x=0;
                                //on affiche les logement de la personne dans la liste déroulante du formulaire
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
                                //on affiche les pièces de la personne dans la liste déroulante du formulaire
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

<form id="equipement" method="post" action="index.php?page=ajouterHabitation">

                    <p>
                        <label for="nomLogementPieceCemacEquipement">Nom de votre logement:</label>
                        </br>
                        <select type="text" id="nomLogementPieceCemacEquipement" name="nomLogementPieceCemacEquipement" required>
                            <option value="" disabled selected>Séléctionner le logement</option>
                             <?php
                                $x=0;
                                //on affiche les logements de la personne dans la liste déroulante du formulaire
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
                                //on affiche les pièces de la personne dans la liste déroulante du formulaire
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
                            //on affiche les cemacs de la personne dans la liste déroulante du formulaire
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
                                //on affiche les types de'équipements dispo dans la liste déroulante du formulaire
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
        </div>
        <?php include('vue/footer.php');?>


<script>
    //les Quatres focntions si-dessous permettent de vérifier si les champs sont correctements remplis et sinon les surlignent en rouge
function surligne(champ, erreur)
    {
       if(erreur)
          champ.style.backgroundColor = "#fba";
       else
          champ.style.backgroundColor = "";
    }
    function verifNom(champ)
    {
        if(champ.value.length < 2 || champ.value.length >200)
       {
          surligne(champ, true);
          return false;
       }
       else
       {
          surligne(champ, false);
          return true;

       }

    }
    function verifNum(champ)
    {
       var num = parseInt(champ.value);
       if(isNaN(num))
       {
          surligne(champ, true);
          return false;
       }
       else
       {
          surligne(champ, false);
          return true;
       }
    }
function verifForm(f)
{
    var nomOk = verifNom(f.nomLogement);
    var rueOk = verifNom (f.rue);
    var villeOk = verifNom(f.ville);
    var cpOk = verifNum(f.cp);
    var paysOk = verifNom(f.pays);
    if(nomOk && rueOk && villeOk && cpOk && paysOk )
    {
        return true;
    }
    else
    {
        alert("Veuillez remplir correctement tous les champs");
        return false;
    }
}
  
    
//le code si dessous permet d'afficher le bon formulaire lorsque l'on clique sur un bouton et de cacher les autres   
var cas1 = document.querySelector('#logement');
cas1.style.display="none";
var cas2 = document.querySelector('#piece');
cas2.style.display="none";
var cas3 = document.querySelector('#cemac');
cas3.style.display="none";
var cas4 = document.querySelector('#equipement');
cas4.style.display="none";
var tab1 = document.querySelector('#tablogement');
var x1=0;
tab1.addEventListener('click', function() {
    if(x1==0)
    {
        cas1.style.display="";
        cas2.style.display="none";
        cas3.style.display="none";
        cas4.style.display="none";
        x1=1;
        x2=0;
        x3=0;
        x4=0;
    }
    else
    {
        cas1.style.display="none";
        x1=0;
    }
 });
var tab2 = document.querySelector('#tabpiece');
var x2=0;
tab2.addEventListener('click', function() {
    if(x2==0)
    {
        cas2.style.display="";
        cas1.style.display="none";
        cas3.style.display="none";
        cas4.style.display="none";
        x2=1;
        x1=0;
        x3=0;
        x4=0;
    }
    else
    {
        cas2.style.display="none";
        x2=0;
    }
 });
var tab3 = document.querySelector('#tabcemac');
var x3=0;
tab3.addEventListener('click', function() {
    if(x3==0)
    {
        cas3.style.display="";
        cas2.style.display="none";
        cas1.style.display="none";
        cas4.style.display="none";
        x3=1;
        x1=0;
        x2=0;
        x4=0;
    }
    else
    {
        cas3.style.display="none";
        x3=0;
    }
 });
var tab4 = document.querySelector('#tabequipement');
var x4=0;
tab4.addEventListener('click', function() {
    if(x4==0)
    {
        cas4.style.display="";
        cas2.style.display="none";
        cas3.style.display="none";
        cas1.style.display="none";
        x4=1;
        x1=0;
        x3=0;
        x2=0;
    }
    else
    {
        cas4.style.display="none";
        x4=0;
    }
 });


</script>

<script>
    //le code si-dessous permet d'afficher uniquement les options des listes déroulantes qui correspondent aux choix fait avant.
    //Par exemple uniquement les pièces associées au logement sélectionné seront proposées dans la liste déroulante des pièces.
    //Pareil pour les cemacs
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
                opt[x].style.display="block";
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
                opt[x].style.display="block";
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
                opt[x].style.display="block";
            }
            x++;
        }
    });
</script>

    </body>
</html>
