<?php
$tableau = getPseudos(); 
$tableau_json = json_encode($tableau);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    


    const boutons = document.querySelectorAll('.boutonPopup');
    const modalTitle = document.querySelector('#ajoutUtilisateurModalLabel');
    var tableauJS = <?php print $tableau_json; ?>;


    boutons.forEach(bouton => {
        bouton.addEventListener('click', () => {
            const title = bouton.dataset.title;
            const role = bouton.dataset.role;

            modalTitle.textContent = title;
            document.getElementById('role_utilisateur').value = role;
            const modal = new bootstrap.Modal(document.getElementById('ajoutUtilisateurModal'));
            modal.show();       
        });
    });

    const erreurMessage = document.getElementById('pseudoErreur');
    const inputPseudo = document.getElementById('pseudo');

    const enregistrerBtn = document.getElementById('enregistrerBtn');
    enregistrerBtn.addEventListener('click', function() {

        
        var valid = false;

        for (i = 0; i < tableauJS.length; i++) {
            var maValue = tableauJS[i].pseudoUtilisateur;

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

        }
    });   
    
    
    $('#ajoutUtilisateurModal').on('hide.bs.modal', function (e) {
        inputPseudo.value = "";
        erreurMessage.textContent = "";
    })


</script>