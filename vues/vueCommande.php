<?php $dateCommande = date('d-m-Y', strtotime($commande[0]['dateCommande'])); ?>

<div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
    <div class="container my-3">

        <h4 style="color: white;">Client : <?= $commande[0]['prenomClient'] . " " . $commande[0]['nomClient']; ?></h4>
        <h4 style="color: white;">Numéro de commande : <?= $commande[0]['numCommande']; ?></h4>
        <h4 style="color: white;">Date de commande : <?= $dateCommande; ?></h4>
        <?php 
        $enCours = false;
            $dossierEnCours = getCommandeReclamation($commande[0]['numCommande']);
            //var_dump($dossierEnCours);
            
            if(count($dossierEnCours) > 0) { 
                $dateDossier = date('d-m-Y', strtotime($dossierEnCours[0]['dateDossier']));
                $utilisateurDossier = getUtilisateur($dossierEnCours[0]['idUtilisateur']);
                $typeDeDossier = afficherTypeDossier($dossierEnCours[0]['typeDossier']);
                $statutDuDossier = afficherStatutDossier($dossierEnCours[0]['statutDossier']);
                $enCours = true;
                ?>
            
                <h4 class="mt-4" style="color: white;">ATTENTION,</h4>
                <h4 style="color: white;">Dossier créé le <?=$dateDossier?> par <?=$utilisateurDossier['prenomUtilisateur'] . " " .$utilisateurDossier['nomUtilisateur']?></h4>
                <h4 style="color: white;">Type de dossier : <?=$typeDeDossier?></h4>
                <h4 style="color: white;">Statut du dossier : <?=$statutDuDossier?></h4>
               
            <?php
            }
        ?>
        <div class="table-responsive w-100">

            <form action="">
            <input type="hidden" name="action" value="creerNouveauDossier">
            <input type="hidden" name="commande" value="<?= $commande[0]['numCommande']; ?>">

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
                        <!-- a r articles selectionnés -->
                        <?php foreach ($commande as $article) {
                            $codeArticle = $article['codeArticle'];
                            $dureeGarantie = $article['garantieArticle'];
                            $finGarantie = date('d-m-Y', strtotime($article['dateCommande'] . " + $dureeGarantie year")) // $article['dateCommande'] + $article['dateCommande']
                        ?>
                            <tr>
                                
                                <td scope="row"><?= $codeArticle; ?></td>
                                <td><?= $article['libelleArticle']; ?></td>
                                <td><?= $article['garantieArticle']; ?></td>
                                <td><?= $finGarantie; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php if($enCours == false) { ?>
                    <div class="text-center">
                        <button type="submit" class="btn bouton">Créer un nouveau dossier</button>
                    </div>
                <?php } else { ?>
                    <div class="text-center">
                        <a href="index.php?action=voirDossier&numDossier=<?=$dossierEnCours[0]['numDossier']?>">
                            <button type="button" class="btn bouton">Voir le dossier</button>
                        </a>
                    </div>
                <?php } ?>
            </form>
            <a href=javascript:history.go(-1)><button class="btn bouton">Retour</button></a>
        </div>
    </div>
</div>