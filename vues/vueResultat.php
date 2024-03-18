<?php if($action === 'accueilAdminMAJ')  { ?>

        <div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
            <div class="container my-3">
                <form class="form-inline" action="index.php">
                    <div class="input-group col-auto maRecherche">
                        <input type="hidden" name="action" value="accueilAdminMAJ">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <input class="form-control form-control-sm espaceBouton rounded-5" type="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary bouton" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
                <?php if (!is_null($resultats_recherche) && count($resultats_recherche) > 0) { ?>
                <table class="container table table-striped border maTableAdmin rounded-3 overflow-hidden">
                    <thead>
                        <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Rôle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultats_recherche as $utilisateur) { ?>
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
                <?php } else { ?>
                    <p class="d-flex justify-content-center text-white">Aucun résultat trouvé.</p>
                <?php } ?>
                <?php if($resultats_recherche) { ?>      
                <p class="d-flex justify-content-center text-white">Nombre d'utilisateurs trouvés : <?= count($resultats_recherche); ?></p>
                <?php }  ?>  
        </div> 

<?php   } else if ($action === 'rechercherDossierMAJ')  {?>

    <div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
            <div class="container my-3">
                <form class="form-inline" action="index.php">
                    <div class="input-group col-auto maRecherche">
                        <input type="hidden" name="action" value="rechercherDossierMAJ">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <input class="form-control form-control-sm espaceBouton rounded-5" type="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary bouton" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php if (!is_null($resultats_recherche) && count($resultats_recherche) > 0) { ?>    
        <table class="container table table-striped border rounded-3 maTableAdmin rounded-3 overflow-hidden">
            <thead>
                <tr>
                <th scope="col">Numero de dossier</th>
                <th scope="col">Date de création du dossier</th>
                <th scope="col">Nom du client</th>
                <th scope="col">Gérant du dossier</th>
                <th scope="col">Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultats_recherche as $dossier) { ?>
                    <tr>
                        <th scope="row"><?= $dossier['numDossier']; ?></th>
                        <td><?= $dossier['dateDossier']; ?></td>
                        <td><?= $dossier['nomClient']; ?></td>
                        <td><?= $dossier['nomUtilisateur']; ?></td>
                        <td><?= afficherStatutDossier($dossier['statutDossier']); ?></td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php } else { ?>
                <p class="d-flex justify-content-center text-white">Aucun résultat trouvé.</p>
            <?php } ?>
            <?php if ($resultats_recherche) { ?>
                <p class="d-flex justify-content-center text-white">Nombre de dossiers trouvés : <?= count($resultats_recherche); ?></p>
            <?php }  ?>
        </div> 
        <?php }  ?>

