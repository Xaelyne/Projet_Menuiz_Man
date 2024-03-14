<?php if($action === 'accueilAdmin')  {?>
            
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
                    <td><?= getRoleUtilisateur($role); ?></td>
                </tr>
            <?php } ?>
        </tbody>
        </table>
<?php   } ?>