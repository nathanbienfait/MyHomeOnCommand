<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/styleGeneral.css" />
        <link rel="stylesheet" href="css/styleSupportAdmin.css" />
        <link rel="stylesheet" href="css/styleMenu.css" />
        <link rel="stylesheet" href="css/styleHeaderFooter.css" />
        
        <title>MyHomeOnCommand</title>
        
    </head>
    <?php include('vue/header.php');?>
    <body>
        
    

    <div id="flex">

           <?php include('vue/menuAdmin.php');?>
           
            <div id="CorpTexte">

                    <div class="qrBouton">
<!-- Boucle permettant d'afficher les questions réponses récupérés dans un objet PDO -->
                    <?php foreach($tableauqr as $truc): ?>   
                        <div class="groupeq"><strong>QUESTION: </strong><br><?php echo nl2br($truc['contenu_q']);?></br></div>
                        <div class="grouper"><strong>REPONSE: </strong><br><?php echo nl2br($truc['contenu_r']); ?></div>
<!-- Formulaire permettant de supprimer une question/réponse -->                                  
                <div class="boutons">        
                <form action="index.php?page=supportAdmin" method="Post" name="supprimer" >
                                <input class="png" onclick="return show(2); " type="image" src="images/delete.png" value="<?php echo $truc['id_qr']; ?>" name="boutton_supprimer" required/></form>
                <!-- Bonton contenant le formulaire de modification d'une question. Le formulaire est caché grace au JavaScript en bas de la page -->        
                <input class="png2" type="image" src="images/edit.png" name="edit" data-modal="modal2<?php echo $truc['id_qr'];?>" required/>
                            <div class='modal' id="modal2<?php echo $truc['id_qr'];?>">
                                <div class='modal-content'>
                                    <span class='close' >&times;</span>
                                        <form class="bouton" action="index.php?page=supportAdmin" method="Post" name="edit" >
                                            <strong>Question :</strong><textarea name="modifq" ><?php echo nl2br($truc['contenu_q']) ; ?></textarea><br>
                                            <strong>Réponse :</strong><textarea name="modifr"><?php echo nl2br($truc['contenu_r']) ; ?></textarea><br>
                                            <input type="image" class="png2" name="edit2" onclick="return show(1);" src="images/edit.png" value="<?php echo $truc['id_qr']; ?>">
                                        </form>
                                </div>
                            </div>
                        </div>

                            
                    <?php endforeach;  ?>
                    </div>
        <!-- Bonton contenant le formulaire d'ajout d'une question. Le formulaire est caché grace au JavaScript en bas de la page -->
                            <button class="bouton_aff_modal" data-modal="modal1">Ajouter</button>
                <div class='modal' id="modal1">
                    <div class='modal-content'>
                        <span class='close' >&times;</span>
                           <form class="ajout" method="Post" action="index.php?page=supportAdmin" >
                                <strong>Question :</strong><textarea class="ajoutqr" name="ajoutQ"></textarea><br>
                                <strong>Réponse :</strong><textarea class="ajoutqr" name="ajoutR"></textarea><br>
                                <strong>Date de la question :</strong><input type="date" name="dateQ" classe="inputAjout"><br>
                                <strong>Date de la réponse :</strong><input type="date" name="dateR" classe="inputAjout">
                                <input type="submit" name="envoitAjout" onclick="return show(3)" class="envoie">
                            </form>
                    </div>
                </div>    
                   
           </div>

    </div>

<script>
            function show($x)
            {
                switch($x)
                {
                    case 2:
                        return confirm('Voulez-vous supprimer cette question ?');
                    break;

                    case 1:
                        return confirm('Voulez-vous modifier cette question ?');
                    break;

                    case 3:
                        return confirm('Voulez-vous ajouter cette question ?');
                    break;
                }
            }
        var boutonsAffModal=document.querySelectorAll(".bouton_aff_modal");
            boutonsAffModal.forEach(function(bouton){
                bouton.onclick=function(){
                    var modal=bouton.getAttribute('data-modal');
                    document.getElementById(modal).style.display='block';
                }
            })
        var boutonsAffModal=document.querySelectorAll(".png2");
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
    <?php include('vue/footer.php');?>
</html>
