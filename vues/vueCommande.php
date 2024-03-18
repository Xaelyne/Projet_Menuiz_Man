<div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
    <div class="container my-3">

        <h4 style="color: white;">Numéro de commande : <?= $commande[0]['numCommande']; ?></h4>
        <h4 style="color: white;">Date de commande : <?= $commande[0]['dateCommande']; ?></h4>
        <div class="table-responsive w-100">

            <table class="container table table-striped border alignTable">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">Article</th>
                        <th scope="col">Nom de l'article</th>
                        <th scope="col">Durée de garantie</th>
                        <th scope="col">Date fin de garantie</th>
                        
                        
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commande as $article) {
                        $codeArticle = $article['codeArticle'];
                        $dureeGarantie = $article['garantieArticle'];
                        $finGarantie = date('Y-m-d', strtotime($article['dateCommande']. " + $dureeGarantie year"))// $article['dateCommande'] + $article['dateCommande']
                         ?>
                    <tr>
                        <th>
                            <input type="checkbox" name="<?=$codeArticle;?>" id="<?=$codeArticle;?>">
                        </th>
                        <th scope="row"><?= $codeArticle; ?></th>
                        <td><?= $article['libelleArticle']; ?></td>
                        <td><?= $article['garantieArticle']; ?></td>
                        <td><?= $finGarantie; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
                        <div class="text-center">
                            <a href="index.php?action=voirCommande&commande=<?= $recherche[0]['numCommande']; ?>"><button class="btn bouton">Créer nouveau dossier</button></a></td>
                        </div>
            <a href=javascript:history.go(-1)><button class="btn bouton">Retour</button></a>
        </div>
    </div>
</div>