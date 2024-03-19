<?php
$tableau = getPseudos(); 
$tableau_json = json_encode($tableau);
?>


<script>
    var tableauJS = <?php print $tableau_json; ?>;


    const erreurMessage = document.getElementById('pseudoErreur');

    const enregistrerBtn = document.getElementById('enregistrerBtn');
    enregistrerBtn.addEventListener('click', function() {

        
        var inputPseudo = document.getElementById('pseudo');
        var valid = false;

        for (i = 0; i < tableauJS.length; i++) {
            var maValue = tableauJS[i];

            if (maValue == inputPseudo.value) {
                valid = false;
                break;
            } else {
                valid = true; 
            }
        }

        // si tout est ok on ferme la popup
        if (valid == false) {
            erreurMessage.textContent = "ERREUR"
        } else {
            
            myForm = document.getElementById('ajoutUtilisateurForm');
            myForm.submit();

            $('#myModal').modal('hide')
            inputPseudo.value = "";
            erreurMessage.textContent = "";

        }

    });


</script>