
<?php
if ($action === "accueilTechnicienSAV") {
    ?>
    <div class="container">
        <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center flex-wrap">
            <a href="index.php?action=nouveauDossier" class="lienCarte">
                <div class='card m-2 maCarte' style='width: 18rem;'>
                <img src='Images/nouveau-dossier.png' class='card-img-top m-auto mt-1 pt-3' style='width: 50%;' alt='nouveauDossier'>
                    <div class='card-body'>
                        <h4 class='card-title d-flex justify-content-center'>Créer un nouveau dossier</h4>
                    </div>
                </div>
            </a>
            <a href="index.php?action=rechercherDossier" class="lienCarte">
                <div class='card m-2 maCarte' style='width: 18rem;'>
                <img src='Images\rechercheDossier.png' class='card-img-top m-auto mt-1 pt-3' style='width: 50%;' alt='nouveauDossier'>
                    <div class='card-body'>
                        <h4 class='card-title d-flex justify-content-center'>Rechercher un dossier</h4>
                    </div>
                </div>
            </a>
            <a href="index.php?action=dossierTermine" class="lienCarte">
                <div class='card m-2 maCarte' style='width: 18rem;'>
                <img src='Images/verifie.png' class='card-img-top m-auto mt-1 pt-3' style='width: 50%;' alt='nouveauDossier'>
                    <div class='card-body'>
                        <h4 class='card-title d-flex justify-content-center'>Dossier terminés</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center flex-wrap">
            <a href="index.php?action=diagnostics" class="lienCarte">
                <div class='card m-2 maCarte' style='width: 18rem;'>
                <img src='Images/parametre.png' class='card-img-top m-auto mt-1 pt-3' style='width: 50%;' alt='nouveauDossier'>
                    <div class='card-body'>
                        <h4 class='card-title d-flex justify-content-center'>Diagnostics</h4>
                    </div>
                </div>
            </a>
            <a href="index.php?action=expedition" class="lienCarte">
                <div class='card m-2 maCarte' style='width: 18rem;'>
                <img src='Images\livraison-rapide.png' class='card-img-top m-auto mt-1 pt-3' style='width: 50%;' alt='nouveauDossier'>
                    <div class='card-body'>
                        <h4 class='card-title d-flex justify-content-center'>Expedition</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
<?php
}
?>
<?php
if ($action === "accueilTechnicienHOT") {
    ?>
    <div class="container">
        <div class="d-flex flex-lg-row flex-column justify-content-center align-items-center flex-wrap">
            <a href="index.php?action=nouveauDossier" class="lienCarte">
                <div class='card m-2 maCarte' style='width: 18rem;'>
                <img src='Images\nouveau-dossier.png' class='card-img-top m-auto mt-1 ' style='width: 50%;' alt='nouveauDossier'>
                    <div class='card-body'>
                        <h4 class='card-title d-flex justify-content-center'>Créer un nouveau dossier</h4>
                    </div>
                </div>
            </a>
            <a href="index.php?action=rechercherDossier" class="lienCarte">
                <div class='card m-2 maCarte' style='width: 18rem;'>
                <img src='Images\rechercheDossier.png' class='card-img-top m-auto mt-1' style='width: 50%;' alt='nouveauDossier'>
                    <div class='card-body'>
                        <h4 class='card-title d-flex justify-content-center'>Rechercher un dossier</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php
}
?>

<?php if($action === 'accueilAdmin')  { ?>

    
        <div class="contourAdmin container d-flex justify-content-center align-items-center flex-column rounded-3">
            <div class="container my-3">
                <form class="form-inline" action="index.php">
                    <div class="input-group col-auto maRecherche">
                        <input type="hidden" name="action" value="accueilAdminMAJ">
                        <input class="form-control form-control-sm espaceBouton rounded-5" type="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary bouton" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
            
        <table class="container table table-striped border rounded-3 maTableAdmin rounded-3 overflow-hidden alignTable">
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
                <?php foreach ($utilisateurs as $utilisateur) { ?>
                    <tr>
                        <th scope="row"><?= $utilisateur['idUtilisateur']; ?></th>
                        <td><?= $utilisateur['pseudoUtilisateur']; ?></td>
                        <td><?= $utilisateur['nomUtilisateur']; ?></td>
                        <td><?= $utilisateur['prenomUtilisateur']; ?></td>
                        <?php $role = $utilisateur['roleUtilisateur']; ?>
                        <td><?= afficheRoleUtilisateur($role); ?></td>
                        <td><a href=""><button class="btn bouton">Modifier</button></a><a href="#" onclick="confirmerSuppression(<?= $utilisateur['idUtilisateur']; ?>);"><button class="btn bouton">Supprimer</button></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <p class="d-flex justify-content-center text-white">Nombre d'utilisateurs trouvés : <?= count($utilisateurs); ?></p>
        </div>    


<?php   } ?>

