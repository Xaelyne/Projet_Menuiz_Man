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
    case "testAnthony":
        $titre = "testAnthony";
        require "./vues/vueHeader.php";
        require "./vues/vueConnexion.php";
        break;
}

require "./vues/vueFooter.php";


