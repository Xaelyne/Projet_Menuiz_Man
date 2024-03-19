
<div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
            <div class="container my-3">
                <form class="form-inline" action="index.php">
                    <div class="input-group col-auto maRecherche">
                        <input type="hidden" name="action" value="dossierTermineMaj">
                        <input class="form-control form-control-sm espaceBouton rounded-5" type="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary bouton" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
                <?php if (count($dossiers) > 0) { ?>
                <table class="container table table-striped border alignTable rounded-3 maTableAdmin overflow-hidden">
                    <thead>
                        <tr>
                        <th scope="col">Numéro</th>
                        <th scope="col">Date de création</th>
                        <th scope="col">Date de clôture</th>
                        <th scope="col">Type</th>
                        <th scope="col">Numéro de commande</th>
                        <th scope="col">Nom client</th>
                        <th scope="col">Géré par</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dossiers as $dossier) { 
                            $dateDossier = date('d-m-Y', strtotime($dossier['dateDossier']));

                            if(!$dossier['dateClotureDossier']) $dateCloture = "inconnu";
                            else $dateCloture = date('d-m-Y', strtotime($dossier['dateClotureDossier']));

                            $utilisateur = getUtilisateur($dossier['idUtilisateur']);
                            $typeDossier = afficherTypeDossier($dossier['typeDossier']);
                            $infoCommande = getCommande($dossier['numCommande']);
                            $nomClient = $infoCommande[0]['nomClient'];
                            ?>
                            <tr>
                                <td><?=$dossier['numDossier']?></td>
                                <td><?=$dateDossier?></td>
                                <td><?=$dateCloture?></td>
                                <td><?=$typeDossier?></td>
                                <td><?=$dossier['numCommande']?></td>
                                <td><?=$nomClient?></td>
                                <td><?=$utilisateur['nomUtilisateur']?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    <p class="d-flex justify-content-center text-white">Aucun résultat trouvé.</p>
                <?php } ?>
                <?php if($dossiers) { ?>      
                <p class="d-flex justify-content-center text-white">Nombre de dossiers terminés : <?= count($dossiers); ?></p>
                <?php }  ?>  
        </div> 