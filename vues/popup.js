document.addEventListener('DOMContentLoaded', function() {
    const boutons = document.querySelectorAll('.boutonPopup');
    const modalTitle = document.querySelector('#ajoutUtilisateurModalLabel');

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

    const form = document.getElementById('ajoutUtilisateurForm');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Soumettre le formulaire via AJAX
        fetch('index.php?action=accueilAdmin&id=1', {
            method: 'POST',
            body: new FormData(form)
        })
        .then(response => {
            if (response.ok) {
                // Afficher le modal de succès
                const successModal = new bootstrap.Modal(document.getElementById('succesModal'));
                successModal.show();
                form.reset();
                window.location.reload(); 
            } else {
                // Gérer les erreurs si le formulaire n'a pas pu être soumis avec succès
                console.error('Erreur lors de la soumission du formulaire');
            }
        })
        .catch(error => {
            console.error('Erreur lors de la soumission du formulaire : ', error);
        });
        
    });
});