<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL' crossorigin='anonymous'></script>
    <link rel='stylesheet' href='style/style.css' defer>
    <title><?= $titre ?></title>
</head>

<body>

    <!-- Les alerts -->
    <div class="col-12 alert alert-danger d-block d-sm-none text-center" role="alert">Screen X-Small</div>
    <div class="col-sm-12 alert alert-info d-none d-sm-block d-md-none text-center" role="alert">Screen Small ≥576px</div>
    <div class="col-md-12 alert alert-success d-none d-md-block d-lg-none text-center" role="alert">Screen Medium ≥768px</div>
    <div class="col-lg-12 alert alert-warning d-none d-lg-block d-xl-none text-center" role="alert">Screen Large ≥992px</div>
    <div class="col-xl-12 alert alert-dark d-none d-xl-block d-xxl-none text-center" role="alert">Screen X-Large ≥1200px</div>
    <div class="col-xxl-12 alert alert-secondary d-none d-xxl-block text-center" role="alert">Screen XX-Large ≥1400px</div>

    <!-- Nav Barre Admin-->
    <?php
    if ($roleHeader == 1) {
    ?>
<!-- DEBUG -->
<p>HEADER ADMIN</p>
        <nav class="navbar navbar-expand-lg maNav">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <img src="../Images/Menuiz Man.png" alt="Logo" class="logonav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <a class="nav-link mx-3" aria-current="page" href="index.php">
                        <img src="../Images/Menuiz Man.png" alt="Logo" class="logonav d-none d-lg-block">
                    </a>
                    <div class="d-flex flex-grow-1 justify-content-center">
                        <button type="button" class="btn btn-primary mx-2 boutonPopup" data-role="1" data-title="Ajouter un nouvel administrateur">Ajouter un nouvel administrateur</button>
                        <button type="button" class="btn btn-primary mx-2 boutonPopup" data-role="3" data-title="Ajouter un nouveau technicien SAV">Ajouter un nouveau technicien SAV</button>
                        <button type="button" class="btn btn-primary mx-2 boutonPopup" data-role="2" data-title="Ajouter un nouveau technicien Hotline">Ajouter un nouveau technicien Hotline</button>
                    </div>
                    <div class="modal fade" id="ajoutUtilisateurModal" tabindex="-1" aria-labelledby="ajoutUtilisateurModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ajoutUtilisateurModalLabel">Ajouter un nouvel utilisateur</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="ajoutUtilisateurForm" method="POST">
                                        <input type="hidden" name="action" value="accueilAdmin">
                                        <input type="hidden" name="id" value="<?=$id?>">
                                        <div class="mb-3">
                                            <label for="pseudo" class="form-label">Pseudo</label>
                                            <input type="text" class="form-control" id="pseudo" name="pseudo">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="nom" name="nom">
                                        </div>
                                        <div class="mb-3">
                                            <label for="prenom" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" id="prenom" name="prenom">
                                        </div>
                                        <div class="mb-3">
                                            <label for="mot_de_passe" class="form-label">Mot de passe</label>
                                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe">
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirmer_mot_de_passe" class="form-label">Confirmer le mot de passe</label>
                                            <input type="password" class="form-control" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe">
                                        </div>
                                        <!-- Champ caché pour stocker le rôle -->
                                        <input type="hidden" id="role_utilisateur" name="role_utilisateur">
                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Enregistrer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="succesModal" tabindex="-1" aria-labelledby="succesModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="succesModalLabel">Succès</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Utilisateur ajouté avec succès.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- BOUTON DECONNEXION -->
                    <?php if ($action != "connexion") {
                    ?>
                        <a href="index.php?action=connexion" class="d-flex ms-auto align-items-center btnDeconnexion">
                            <h4 class="mt-1 me-1 ">Déconnexion</h4>
                            <img src="../Images/se-deconnecter.png" alt="imgDeconnexion" class="imgDeconnexion ">
                        </a>
                    <?php } ?>
                </div>
            </div>
        </nav>

    <?php
    } else {
    ?>
<!-- DEBUG -->
<p>HEADER AUTRE</p>
        <!-- Nav Barre Autre Utilisateurs et Accueil -->
        <nav class="navbar navbar-expand-lg maNav">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <img src="../Images/Menuiz Man.png" alt="Logo" class="logonav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <a class="nav-link mx-3" aria-current="page" href="index.php">
                        <img src="../Images/Menuiz Man.png" alt="Logo" class="logonav d-none d-lg-block">
                    </a>
                    <!-- BOUTON DECONNEXION -->
                    <?php if ($action != "connexion") {
                    ?>
                        <a href="index.php?action=connexion" class="d-flex ms-auto align-items-center btnDeconnexion">
                            <h4 class="mt-1 me-1 ">Déconnexion</h4>
                            <img src="../Images/se-deconnecter.png" alt="imgDeconnexion" class="imgDeconnexion ">
                        </a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    <?php
    }
    ?>

    <h1 class="my-5 text-center"><?= $titre ?></h1>