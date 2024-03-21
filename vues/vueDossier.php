<?php if ($action == "voirDossier") { ?>

<?php $dateCommande = date('d-m-Y', strtotime($dossiers [0]['dateCommande'])); ?>

<div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
    <div class="container my-3">

        <h4 style="color: white;">Client : <?= $dossiers [0]['prenomClient'] . " " . $dossiers [0]['nomClient']; ?></h4>
        <h4 style="color: white;">Statut du dossier : <?= afficherStatutDossier($dossiers[0]['statutDossier']); ?></h4>
        <h4 style="color: white;">Numéro de dossier : <?= $dossiers [0]['numDossier']; ?></h4>
        <h4 style="color: white;">Numéro de commande : <?= $dossiers [0]['numCommande']; ?></h4>
        <h4 style="color: white;">Date de commande : <?= $dateCommande; ?></h4>
        <h4 style="color: white;">Dossier géré par : <?= $dossiers [0]['nomUtilisateur']; ?></h4>
        <div class="table-responsive w-100">



            <table class="container table table-striped border alignTable rounded-3 maTableAdmin overflow-hidden">
                <thead>
                    <tr>
                        <th scope="col">Article</th>
                        <th scope="col">Nom de l'article</th>
                        <th scope="col">Durée de garantie</th>
                        <th scope="col">Date fin de garantie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dossiers as $dossier) {
                        
                        $dureeGarantie = $dossier['garantieArticle'];
                        $finGarantie = date('d-m-Y', strtotime($dossier['dateCommande'] . " + $dureeGarantie year"))
                    ?>
                        <tr>
                            <td scope="row"><?= $dossier['codeArticle'];?></td>
                            <td><?= $dossier['libelleArticle']; ?></td>
                            <td><?= $dossier['garantieArticle']; ?></td>
                            <td><?= $finGarantie; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="container my-3 d-flex">       
                <h4 style="color: white;">Commentaire : <?= $dossiers [0]['commentaireDossier']; ?></h4>
            </div>

            <?php if ($dossiers[0]['statutDossier'] == 1) {?>
                    <div class="text-center">
                        <a href="index.php?action=voirDossierMAJ&modifDossier=Expe&numDossier=<?=$numDossier?>">
                            <button type="button">Passer le dossier en expédition</button>
                        </a>
                    </div>
            <?php } ?>  
            <?php if ($dossiers[0]['statutDossier'] == 2) {?>
                    <div class="text-center">
                    <a href="index.php?action=voirDossierMAJ&modifDossier=Terminer&numDossier=<?=$numDossier?>">
                            <button type="button">Passer le dossier en Terminer</button>
                        </a>
                    </div>
            <?php } ?>    

            <a href=javascript:history.go(-1)><button class="btn bouton">Retour</button></a>
        </div>
    </div>
</div>
<?php } ?>   



