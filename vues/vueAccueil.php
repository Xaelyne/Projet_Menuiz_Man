
<?php
if ($action === "accueilTechnicienSAV") {
    ?>
    <!-- <div class="row row-cols-1 row-cols-md-5 g-5 my-2 mx-2 justify-content-center">
        <div></div>
        <a href="index.php?action=nouveauDossier" class="lienCarte">
            <div class="card h-100 maCarte">
                <img src="../Images/nouveau-dossier.png" class="card-img-top" alt="nouveau-dossier">
                <div class="card-body">
                    <h5 class="card-title">Créer un nouveau dossier</h5>
                </div>
            </div>
        </a>
        
        <a href="index.php?action=rechercherDossier" class="lienCarte">
            <div class="card h-100 maCarte">
                <img src="../Images/rechercheDossier.png" class="card-img-top" alt="rechercheDossier">
                <div class="card-body">
                    <h5 class="card-title">Rechercher un dossier</h5>
                </div>
            </div>
        </a>
        <a href="index.php?action=dossierTermine" class="lienCarte">
            <div class="card h-100 maCarte">
                <img src="../Images/verifie.png" class="card-img-top" alt="verifie">
                <div class="card-body">
                    <h5 class="card-title">Dossier terminé</h5>
                </div>
            </div>
        </a>
        <div></div>
        <a href="index.php?action=diagnostics" class="lienCarte">
            <div class="card h-100 maCarte">
                <img src="../Images/parametre.png" class="card-img-top" alt="parametre">
                <div class="card-body">
                    <h5 class="card-title">Diagnostics</h5>
                </div>
            </div>
        </a>
        <a href="index.php?action=expedition" class="lienCarte">
            <div class="card h-100 maCarte">
                <img src="../Images/livraison-rapide.png" class="card-img-top" alt="livraison-rapide">
                <div class="card-body">
                    <h5 class="card-title">Expedition</h5>
                </div>
            </div>
        </a>
    </div> -->
    <div class="container">
        <div class="d-flex flex-lg-row flex-md-column my-auto justify-content-center flex-wrap">
            <div class="" id="carteCache">
                <div class='card m-2' style='width: 18rem;'>
                    <img src='../ressources/albums/" + cheminImg + ".jpg' class='card-img-top m-auto mt-1'
                        style='width: 95%;' alt='...'>
                    <div class='card-body'>
                        <h4 class='card-title'>MONTITRE</h4>
                    </div>
                </div>
            </div>
            <div class="" id="carteCache">
                <div class='card m-2' style='width: 18rem;'>
                    <img src='../ressources/albums/" + cheminImg + ".jpg' class='card-img-top m-auto mt-1'
                        style='width: 95%;' alt='...'>
                    <div class='card-body'>
                        <h4 class='card-title'>MONTITRE</h4>
                    </div>
                </div>
            </div>
            <div class="" id="carteCache">
                <div class='card m-2' style='width: 18rem;'>
                    <img src='../ressources/albums/" + cheminImg + ".jpg' class='card-img-top m-auto mt-1'
                        style='width: 95%;' alt='...'>
                    <div class='card-body'>
                        <h4 class='card-title'>MONTITRE</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if ($action === "accueilTechnicienHOT") {
    ?>
    <div class="row row-cols-1 row-cols-md-3 g-5 my-2 mx-2 justify-content-center">
        <a href="index.php?action=nouveauDossier">
            <div class="col">
                <div class="card h-100 maCarte">
                    <img src="../Images/nouveau-dossier.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Créer un nouveau dossier</h5>
                    </div>
                </div>
            </div>
        </a>
        <a href="index.php?action=rechercherDossier">
            <div class="col">
                <div class="card h-100 maCarte">
                    <img src="../Images/rechercheDossier.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rechercher un dossier</h5>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php
}
?>

<?php if($action === 'accueilAdmin')  {?>

    <div class="contourAdmin container d-flex justify-content-center align-items-center" >
        <div class="col-md-6">
            <div class="container my-3">
                <form class="form-inline" action="index.php?action=accueilAdminMAJ" method="post">
                    <div class="input-group col-auto maRecherche">
                        <input class="form-control form-control-sm espaceBouton" type="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
            
    <table class="container table table-striped border maTableAdmin">
        <thead>
            <tr>
            <th scope="col">Identifiant</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Rôle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur) { ?>
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

        <p class="d-flex justify-content-center text-white">Nombre d'utilisateurs trouvés : <?= count($utilisateurs); ?></p>

<?php   } ?>

