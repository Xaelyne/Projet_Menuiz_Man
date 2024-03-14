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
    case "connexionMaj":
        $nomUtilisateur = $_GET['user'];
        $mdpUtilisateur = $_GET['pass'];
var_dump($nomUtilisateur, $mdpUtilisateur);
        require "./modeles/modele.inc.php";
        //getUtilisateurs();

        $titre = "Connexion";
        require "./vues/vueHeader.php";
        require "./vues/vueConnexion.php";
        break;
    case "accueilAdmin":
        $titre = "Bonjour $nom, vous êtes connecté en tant qu'$role";
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
}

require "./vues/vueFooter.php";


