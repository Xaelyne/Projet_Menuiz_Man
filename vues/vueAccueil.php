<?php if($action === 'accueilAdmin')  {?>

    <div class="contourAdmin container d-flex justify-content-center align-items-center" >
        <div class="col-md-6">
            <div class="container my-3">
                <form class="form-inline" action="index.php?action=accueilAdminMAJ" method="post">
                    <div class="input-group col-auto maRecherche">
                        <input class="form-control form-control-sm espaceBouton" type="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
            
    <table class="container table table-striped border maTableAdmin">
        <thead>
            <tr>
            <th scope="col">Identifiant</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Rôle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur) { ?>
                <tr>
                    <th scope="row"><?= $utilisateur['idUtilisateur']; ?></th>
                    <td><?= $utilisateur['nomUtilisateur']; ?></td>
                    <td><?= $utilisateur['prenomUtilisateur']; ?></td>
                    <?php $role = $utilisateur['roleUtilisateur']; ?>
                    <td><?= afficheRoleUtilisateur($role); ?></td>
                </tr>
            <?php } ?>
        </tbody>
        </table>

        <p class="d-flex justify-content-center text-white">Nombre d'utilisateurs trouvés : <?= count($utilisateurs); ?></p>

<?php   } ?>