<?php

$action = "accueil";

if (isset($_GET['action'])) $action = $_GET['action'];
if (!isset($_GET['action'])) $action = "connexion";

var_dump($action);

// switch sur si pas de connexion trouvé -> formulaire connexion
switch ($action) {
    case "connexion":
        $titre = "Connexion";
        require "./vues/vueHeader.php";
        require "./vues/vueConnexion.php";
        break;

    case "accueilTechnicienSAV":
        // $titre = "Bonjour $nom, vous êtes connecté en tant que $role";
        $titre = "Bonjour, vous êtes connecté en tant que";
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "accueilTechnicienHOT":
        // $titre = "Bonjour $nom, vous êtes connecté en tant que $role";
        $titre = "Bonjour, vous êtes connecté en tant que";
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "nouveauDossier":
        $titre = "Créer un nouveau dossier";
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "rechercherDossier":
        $titre = "Rechercher un dossier";
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "dossierTermine":
        $titre = "Dossier terminé";
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "diagnostics":
        $titre = "Diagnostics";
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "expedition":
        $titre = "Expedition";
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    
}

require "./vues/vueFooter.php";


