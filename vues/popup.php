<?php
$tableau = getPseudos(); 
$tableau_json = json_encode($tableau);

$tableau_role = getRoleUtilisateur();
$tableau_json2 =json_encode($tableau_role);

$tableau_dossier = getUtilisateurOnDossier();
$tableau_json3 = json_encode($tableau_dossier);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.4/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.4/sweetalert2.min.js"></script>
<script>

    // Alert SUPPRESSION
    function confirmerSuppression(idUtilisateur) {
    // Effectuer une requête AJAX pour obtenir le nombre d'administrateurs restants
    $.ajax({
        url: 'index.php?action=accueilAdmin',
        type: 'GET',
        success: function(response) {
            var tableauRole = <?php print $tableau_json2; ?>;            
            var nbAdmins = <?=getAdmins()?>;
            var tableauDossier = <?php print $tableau_json3; ?>;  

            var roleUtilisateur = tableauRole.find(user => user.idUtilisateur === idUtilisateur).roleUtilisateur;
            var dossierUtilisateur = tableauDossier.find(function(utilisateur) {
                return utilisateur.idUtilisateur === idUtilisateur;
            });


            if (nbAdmins === 1 && roleUtilisateur === 1) {
                // Il ne reste qu'un seul administrateur, afficher un message d'erreur
                Swal.fire('Erreur', 'Impossible de supprimer l\'utilisateur. Il ne peut pas rester moins d\'un administrateur.', 'error');
                
            } else if (dossierUtilisateur) {
                Swal.fire('Erreur', 'Impossible de supprimer l\'utilisateur. Il est associé à un dossier.', 'error');
            } else {

                    // Il y a plus d'un administrateur, demander confirmation pour la suppression
                    Swal.fire({
                        title: 'Êtes-vous sûr ?',
                        text: "Vous ne pourrez pas revenir en arrière !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, supprimer !'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Effectuer la suppression de l'utilisateur
                            $.ajax({
                                url: 'index.php?action=accueilAdmin',
                                type: 'GET',
                                data: {id: idUtilisateur},
                                success: function(response) {
                                    // Afficher un message de succès
                                    Swal.fire({
                                        title: 'Supprimé !',
                                        text: 'L\'utilisateur a été supprimé.',
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Actualiser la page
                                            location.reload();
                                        }
                                    });
                                },
                                error: function(xhr, status, error) {
                                    // Gérer les erreurs
                                    Swal.fire('Erreur', 'Une erreur s\'est produite lors de la suppression de l\'utilisateur.', 'error');
                                }
                            });
                        } else {
                            // L'utilisateur a annulé la suppression
                            Swal.fire('Annulé', 'L\'utilisateur n\'a pas été supprimé.', 'info');
                        }
                    });
                
            }
        },
        error: function(xhr, status, error) {
            // Gérer les erreurs
            Swal.fire('Erreur', 'Une erreur s\'est produite lors de la récupération du nombre d\'administrateurs.', 'error');
        }
    });
}





    // Partie AJOUT
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




    const erreurPseudo = document.getElementById('pseudoErreur');
    const erreurNom = document.getElementById('nomErreur');
    const erreurPrenom = document.getElementById('prenomErreur');
    const erreurMdp = document.getElementById('mdpErreur');
    const erreurConfirmMdp = document.getElementById('confirmMdpErreur');

    const inputPseudo = document.getElementById('pseudo');
    const inputNom = document.getElementById('nom');
    const inputPrenom = document.getElementById('prenom');
    const inputMdp = document.getElementById('mot_de_passe');
    const inputConfirmMdp = document.getElementById('confirmer_mot_de_passe');

    const regex = /^[A-Za-z éè'-]*$/;

    const enregistrerBtn = document.getElementById('enregistrerBtn');
    enregistrerBtn.addEventListener('click', function() {

        var pseudo = inputPseudo.value.trim();
        var nom = inputNom.value.trim();
        var prenom = inputPrenom.value.trim();
        var mdp = inputMdp.value.trim();
        var confirmMdp = inputConfirmMdp.value.trim();
        
        var valid = false;

        for (i = 0; i < tableauJS.length; i++) {
            var maValue = tableauJS[i].pseudoUtilisateur;

            if (maValue == inputPseudo.value) {
                valid = false;
                erreurPseudo.textContent = "Pseudo déjà pris ! Veuillez en choisir un autre."
                break;
            } else {
                erreurPseudo.textContent = ""
                valid = true; 
            }
        }

        if (!regex.test(inputNom.value)) {
            valid = false;
            erreurNom.textContent = "Le nom n'est pas valide !";
        } else {
            erreurNom.textContent = "";
        }

        if (!regex.test(inputPrenom.value)) {
            valid = false;
            erreurPrenom.textContent = "Le prénom n'est pas valide !";
        } else {
            erreurPrenom.textContent = "";
        }
        

        var mdp1 = inputMdp.value;
        var mdp2 = inputConfirmMdp.value;
        if (mdp1 !== mdp2) {
            valid = false;
            erreurConfirmMdp.textContent = "Les mots de passe ne correspondent pas !";
        } else {
            erreurConfirmMdp.textContent = ""; 
        }


        // Vérification du pseudo
        if (pseudo === '') {
            valid = false;
            erreurPseudo.textContent = "Veuillez saisir un pseudo.";
        }

        // Vérification du nom
        if (nom === '') {
            valid = false;
            erreurNom.textContent = "Veuillez saisir un nom.";
        }

        // Vérification du prénom
        if (prenom === '') {
            valid = false;
            erreurPrenom.textContent = "Veuillez saisir un prénom.";
        }

        // Vérification du mot de passe
        if (mdp === '') {
            valid = false;
            erreurMdp.textContent = "Veuillez saisir un mot de passe.";
        } else {
            erreurMdp.textContent = "";
        }

        // Vérification de la confirmation du mot de passe
        if (confirmMdp === '') {
            valid = false;
            erreurConfirmMdp.textContent = "Veuillez confirmer le mot de passe.";
        }
        

        

        // si tout est ok on ferme la popup
        // if (valid == false) {
        //     erreurPseudo.textContent = "Pseudo déjà pris ! Veuillez en choisir un autre."
        // } else {
            
        //     myForm = document.getElementById('ajoutUtilisateurForm');
        //     myForm.submit();

        // }
        if (valid) {
        myForm = document.getElementById('ajoutUtilisateurForm');
        myForm.submit();
        }

    });   
    
    
    $('#ajoutUtilisateurModal').on('hide.bs.modal', function (e) {
        inputPseudo.value = "";
    inputNom.value = "";
    inputPrenom.value = "";
    inputMdp.value = "";
    inputConfirmMdp.value = "";
    erreurPseudo.textContent = "";
    erreurNom.textContent = "";
    erreurPrenom.textContent = "";
    erreurMdp.textContent = "";
    erreurConfirmMdp.textContent = "";
    })

    $(document).ready(function() {
        $('.modal-content').css('background', '#3C4FA0');
        $('.modal-content').css('color', 'white');
        $('#enregistrerBtn').css('background', '#4488C5');
        $('#enregistrerBtn').css('color', 'white');
        $('#enregistrerBtn').css('border', 'solid 3px white');

        $('#enregistrerBtn').hover(
        function() {
            // Au survol
            $(this).css('background', '#8FC1E6');
        },
        function() {
            // Lorsque le survol se termine
            $(this).css('background', '#4488C5');
        }
    );
         
});


</script>