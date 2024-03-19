<div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
    <div class="container my-3">
        <form class="form-inline" action="index.php">
            <div class="input-group col-auto maRecherche">
                <input type="hidden" name="action" value="nouveauDossierRechercheClient">
                <input type="hidden" name="id" value="<?= $id ?>">
                <select name="optionRechercheNouveauDossier" class="rounded-5 me-1">
                    <option value="com">Numéro Commande</option>
                    <option value="nom">Nom Prénom</option>
                </select>
                <input class="form-control form-control-sm espaceBouton rounded-5" type="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-primary bouton" type="submit">Rechercher</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    if ($action === 'nouveauDossierRechercheClient') {
        if ($_GET['optionRechercheNouveauDossier'] == 'nom') { ?>


            <?php if (!is_null($recherche) && count($recherche) > 0) { ?>
                <div class="table-responsive w-100">

                    <table class="container table table-striped border alignTable rounded-3 maTableAdmin overflow-hidden">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Code Postal</th>
                                <th scope="col">Ville</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recherche as $client) { ?>
                                <tr>
                                    <th scope="row"><?= $client['nomClient']; ?></th>
                                    <td><?= $client['prenomClient']; ?></td>
                                    <td><?= $client['codePostalClient']; ?></td>
                                    <td><?= $client['villeClient']; ?></td>
                                    <td><a href=""><button class="btn bouton">Voir les commandes</button></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <p class="d-flex justify-content-center text-white">Aucun résultat trouvé.</p>
            <?php } ?>
            <?php if ($recherche) { ?>
                <p class="d-flex justify-content-center text-white">Nombre de clients trouvés : <?= count($recherche); ?></p>
            <?php }  ?>

    <?php
        } if ($_GET['optionRechercheNouveauDossier'] == 'com') { ?>


            <?php if (!is_null($recherche) && count($recherche) > 0) { ?>
                <?php $dateCommande = date('d-m-Y', strtotime($recherche[0]['dateCommande'])); ?>
                <div class="table-responsive w-100">

                    <table class="container table table-striped border alignTable rounded-3 maTableAdmin overflow-hidden">
                        <thead>
                            <tr>
                                <th scope="col">Numéro</th>
                                <th scope="col">Date</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Code Postal</th>
                                <th scope="col">Ville</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <th scope="row"><?= $recherche[0]['numCommande']; ?></th>
                                    <td><?= $dateCommande; ?></td>
                                    <td><?= $recherche[0]['nomClient']; ?></td>
                                    <td><?= $recherche[0]['prenomClient']; ?></td>
                                    <td><?= $recherche[0]['codePostalClient']; ?></td>
                                    <td><?= $recherche[0]['villeClient']; ?></td>
                                    <td><a href="index.php?action=voirCommande&commande=<?= $recherche[0]['numCommande']; ?>"><button class="btn bouton">Voir la commande</button></a></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <p class="d-flex justify-content-center text-white">Aucun résultat trouvé.</p>
            <?php } ?>
            

    <?php
        }
    } ?>

</div>