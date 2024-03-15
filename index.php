<?php

$action = "accueil";

if (isset($_GET['action'])) $action = $_GET['action'];
if (!isset($_GET['action'])) $action = "connexion";

require("./modeles/modele.inc.php");

var_dump("action -> ".$action);

// switch sur si pas de connexion trouvé -> formulaire connexion
switch ($action) {
    case "connexion":
        $titre = "Connexion";
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        require "./vues/vueConnexion.php";
        break;
    case "accueilTechnicienSAV":
        // récupération des infos utilisateurs
        $id = $_GET['id'];
        $utilisateur = getUtilisateur($id);
        $nom = $utilisateur['nomUtilisateur'];
        $prenom = $utilisateur['prenomUtilisateur'];
        $role = afficheRoleUtilisateur($utilisateur['roleUtilisateur']);

        $titre = "Bonjour $nom $prenom, vous êtes connecté en tant que $role";
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "accueilTechnicienHOT":
        // récupération des infos utilisateurs
        $id = $_GET['id'];
        $utilisateur = getUtilisateur($id);
        $nom = $utilisateur['nomUtilisateur'];
        $prenom = $utilisateur['prenomUtilisateur'];
        $role = afficheRoleUtilisateur($utilisateur['roleUtilisateur']);

        $titre = "Bonjour $nom $prenom, vous êtes connecté en tant que $role";
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "nouveauDossier":
        $id = $_GET['id'];
        $titre = "Créer un nouveau dossier"; // à modifier par une recherche client
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        $clients = getClients();
        require "./vues/vueCreerDossier.php";
        break;
    case "nouveauDossierRechercheClient":
        $id = $_GET['id'];
        $titre = "Créer un nouveau dossier"; // à modifier par une recherche client
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        $clients = getClients();
        if(isset($_GET['search'])) {
            $recherche = rechercheClient();
        }
        require "./vues/vueCreerDossier.php";
        break;
    case "rechercherDossier": 
        $titre = "Rechercher un dossier";
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "dossierTermine":
        $titre = "Dossier terminé";
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "diagnostics":
        $titre = "Diagnostics";
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "expedition":
        $titre = "Expedition";
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        require "./vues/vueAccueil.php";
        break;
    case "connexionMaj":
        $pseudoUtilisateur = $_GET['user'];
        $mdpUtilisateur = $_GET['pass'];
        
        $users = getUtilisateurs();// liste des utilisateurs

        $id = controleConnexion($pseudoUtilisateur, $mdpUtilisateur, $users);

        if ($id == 0) { // utilisateur introuvable
            $titre = "Connexion<br><h2 class='text-center'>Utilisateur introuvable</h2>";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            require "./vues/vueConnexion.php";
        } else if ($id == -1) { // mot de passe incorrect
            $titre = "Connexion<br><h2 class='text-center'>Mot de passe incorrect</h2>";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            require "./vues/vueConnexion.php";
        } else { // connexion validée
            $role = getUtilisateur($id);
            $role = $role['roleUtilisateur'];

            if($role == 1) {
                $action = "accueilAdmin";
            } else if ($role == 2) {
                $action = "accueilTechnicienHOT";
            } else {
                $action = "accueilTechnicienSAV";   
            }

            header("Location: index.php?action=$action&id=$id");
        }
        break;
    case "accueilAdmin":
        // récupération des infos utilisateurs
        $id = $_GET['id'];
        $utilisateur = getUtilisateur($id);
        $nom = $utilisateur['nomUtilisateur'];
        $prenom = $utilisateur['prenomUtilisateur'];
        $role = afficheRoleUtilisateur($utilisateur['roleUtilisateur']);

        $titre = "Bonjour $nom $prenom, vous êtes connecté en tant que $role";
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        $utilisateurs = getUtilisateurs();
        require "./vues/vueAccueil.php";
        break;
    case "accueilAdminMAJ":
        $id = $_GET['id'];
        $titre = "Résultat de votre recherche";
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        if(isset($_GET['search'])) {
            $resultats_recherche = rechercheUtilisateur();
        }
        require "./vues/vueResultat.php";
        break;

}

require "./vues/vueFooter.php";