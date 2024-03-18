<?php
if ($action === "rechercherDossier") {
?>

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
            
        <table class="container table table-striped border rounded-3 maTableAdmin rounded-3 overflow-hidden">
            <thead>
                <tr>
                <th scope="col">Numero de dossier</th>
                <th scope="col">Date de création du dossier</th>
                <th scope="col">Nom du client</th>
                <th scope="col">Gérant du dossier</th>
                <th scope="col">Statut</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dossiers as $dossier) { ?>
                    <tr>
                        <th scope="row"><?= $dossier['numDossier']; ?></th>
                        <td><?= $dossier['dateDossier']; ?></td>
                        <td><?= $dossier['nomClient']; ?></td>
                        <td><?= $dossier['nomUtilisateur']; ?></td>
                        <td><?= afficherStatutDossier($dossier['statutDossier']); ?></td>
                        <td><a href="index.php?action=voirDossier=<?= $dossier['numDossier']; ?>"><button class="btn bouton">Voir le dossier</button></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <p class="d-flex justify-content-center text-white">Nombre de dossier trouvés : <?= count($dossiers); ?></p>
        </div> 

<?php
}
?>