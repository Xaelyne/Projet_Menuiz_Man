
<div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
    <div class="container my-3">
        <div class="table-responsive w-100">

            <table class="container table table-striped border alignTable rounded-3 maTableAdmin overflow-hidden">
                <thead>
                    <tr>
                        <th scope="col">Numéro de commande</th>
                        <th scope="col">Date</th>
                        <th scope="col">Nombre d'articles</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //var_dump($commandes);
                    foreach ($commandes as $client) {
                        $dateCommande = date('d-m-Y', strtotime($client['dateCommande']));
                        $nbrArticles = getCommande($client['numCommande']);
                        $nbrArticles = count($nbrArticles);
                        ?>
                        <tr>
                            <th scope="row"><?= $client['numCommande']; ?></th>
                            <td><?= $dateCommande; ?></td>
                            <td><?= $nbrArticles; ?></td>
                            <td><a href="index.php?action=voirCommande&commande=<?=$client['numCommande']?>"><button class="btn bouton">Voir la commande</button></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href=javascript:history.go(-1)><button class="btn bouton">Retour</button></a>
        </div>
    </div>
</div>