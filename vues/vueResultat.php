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
                <table class="container table table-striped border maTableAdmin rounded-3 overflow-hidden alignTable">
                    <thead>
                        <tr>
                            <th scope="col">Identifiant</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Rôle</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultats_recherche as $utilisateur) { ?>
                            <tr>
                                <th scope="row"><?= $utilisateur['idUtilisateur']; ?></th>
                                <td><?= $utilisateur['pseudoUtilisateur']; ?></td>
                                <td><?= $utilisateur['nomUtilisateur']; ?></td>
                                <td><?= $utilisateur['prenomUtilisateur']; ?></td>
                                <?php $role = $utilisateur['roleUtilisateur']; ?>
                                <td><?= afficheRoleUtilisateur($role); ?></td>
                                <td><a href="#"><button class="btn bouton modifierBtn" data-id="<?= $utilisateur['idUtilisateur']; ?>">Modifier</button></a><a href="#" onclick="confirmerSuppression(<?= $utilisateur['idUtilisateur']; ?>);"><button class="btn bouton">Supprimer</button></a></td>
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
            <table class="container table table-striped border alignTable rounded-3 maTableAdmin overflow-hidden">
            <thead>
                <tr>
                <th scope="col">Numero de dossier</th>
                <th scope="col">Numéro de commande</th>
                <th scope="col">Date de création du dossier</th>
                <th scope="col">Nom du client</th>
                <th scope="col">Type de dossier</th>
                <th scope="col">Dossier géré par</th>
                <th scope="col">Statut du dossier</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultats_recherche as $dossier) { ?>
                    <tr>
                        <th scope="row"><?= $dossier['numDossier']; ?></th>
                        <td><?= $dossier['numCommande']; ?></td>
                        <td><?= $dossier['dateDossier']; ?></td>
                        <td><?= $dossier['nomClient']; ?></td>
                        <td><?= afficherTypeDossier ($dossier['typeDossier']); ?></td>
                        <td><?= $dossier['nomUtilisateur']; ?></td>
                        <td><?= afficherStatutDossier($dossier['statutDossier']); ?></td>
                        <td><a href="index.php?action=voirDossier&numDossier=<?= $dossier['numDossier']; ?>"><button class="btn bouton">Voir le dossier</button></a></td>
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

<?php   } else if ($action === 'diagnosticsMAJ')  {?>

    <div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
            <div class="container my-3">
                <form class="form-inline" action="index.php">
                    <div class="input-group col-auto maRecherche">
                        <input type="hidden" name="action" value="diagnosticsMAJ">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <input class="form-control form-control-sm espaceBouton rounded-5" type="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary bouton" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php if (!is_null($resultats_recherche) && count($resultats_recherche) > 0) { ?>    
            <table class="container table table-striped border alignTable rounded-3 maTableAdmin overflow-hidden">
            <thead>
                <tr>
                <th scope="col">Numero de dossier</th>
                <th scope="col">Numéro de commande</th>
                <th scope="col">Date de création du dossier</th>
                <th scope="col">Nom du client</th>
                <th scope="col">Type de dossier</th>
                <th scope="col">Dossier géré par</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultats_recherche as $dossier) { ?>
                    <tr>
                        <th scope="row"><?= $dossier['numDossier']; ?></th>
                        <td><?= $dossier['numCommande']; ?></td>
                        <td><?= $dossier['dateDossier']; ?></td>
                        <td><?= $dossier['nomClient']; ?></td>
                        <td><?= afficherTypeDossier ($dossier['typeDossier']); ?></td>
                        <td><?= $dossier['nomUtilisateur']; ?></td>
                        <td><a href="index.php?action=voirDossier&numDossier=<?= $dossier['numDossier']; ?>"><button class="btn bouton">Voir le dossier</button></a></td>
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

<?php   } else if ($action === 'dossierTermineMAJ')  {?>

<div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
        <div class="container my-3">
            <form class="form-inline" action="index.php">
                <div class="input-group col-auto maRecherche">
                    <input type="hidden" name="action" value="dossierTermineMAJ">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <input class="form-control form-control-sm espaceBouton rounded-5" type="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary bouton" type="submit">Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
    <?php if (!is_null($resultats_recherche) && count($resultats_recherche) > 0) { ?>    
        <table class="container table table-striped border alignTable rounded-3 maTableAdmin overflow-hidden">
        <thead>
            <tr>
            <th scope="col">Numéro de dossier</th>
            <th scope="col">Numéro de commande</th>
            <th scope="col">Date de création du dossier</th>
            <th scope="col">Date de clôture du dossier</th>
            <th scope="col">Nom du client</th>
            <th scope="col">Type de dossier</th>
            <th scope="col">Dossier géré par</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultats_recherche as $dossier) { ?>
                <tr>
                    <th scope="row"><?= $dossier['numDossier']; ?></th>
                    <td><?= $dossier['numCommande']; ?></td>
                    <td><?= $dossier['dateDossier']; ?></td>
                    <td><?= $dossier['dateClotureDossier']; ?></td>
                    <td><?= $dossier['nomClient']; ?></td>
                    <td><?= afficherTypeDossier ($dossier['typeDossier']); ?></td>
                    <td><?= $dossier['nomUtilisateur']; ?></td>
                    <td><a href="index.php?action=voirDossier&numDossier=<?= $dossier['numDossier']; ?>"><button class="btn bouton">Voir le dossier</button></a></td>
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

<?php   } else if ($action === 'expeditionMAJ')  {?>

<div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
        <div class="container my-3">
            <form class="form-inline" action="index.php">
                <div class="input-group col-auto maRecherche">
                    <input type="hidden" name="action" value="expeditionMAJ">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <input class="form-control form-control-sm espaceBouton rounded-5" type="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary bouton" type="submit">Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
    <?php if (!is_null($resultats_recherche) && count($resultats_recherche) > 0) { ?>    
        <table class="container table table-striped border alignTable rounded-3 maTableAdmin overflow-hidden">
        <thead>
        <tr>
            <th scope="col">Numéro de dossier</th>
            <th scope="col">Numéro de commande</th>
            <th scope="col">Date de création du dossier</th>
            <th scope="col">Nom du client</th>
            <th scope="col">Type de dossier</th>
            <th scope="col">Dossier géré par</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($resultats_recherche as $dossier) { ?>
            <tr>
                <th scope="row"><?= $dossier['numDossier']; ?></th>
                <td><?= $dossier['numCommande']; ?></td>
                <td><?= $dossier['dateDossier']; ?></td>
                <td><?= $dossier['nomClient']; ?></td>
                <td><?= afficherTypeDossier ($dossier['typeDossier']); ?></td>
                <td><?= $dossier['nomUtilisateur']; ?></td>
                <td><a href="index.php?action=voirDossier&numDossier=<?= $dossier['numDossier']; ?>"><button class="btn bouton">Voir le dossier</button></a></td>
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

        

