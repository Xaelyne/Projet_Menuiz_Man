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
            $titre = "Connexion<br><h2 class='text-center'>Pseudo ou Mot de passe incorrect</h2>";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            require "./vues/vueConnexion.php";
        } else if ($id == -1) { // mot de passe incorrect
            $titre = "Connexion<br><h2 class='text-center'>Pseudo ou Mot de passe incorrect</h2>";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            require "./vues/vueConnexion.php";
        } else { // connexion validée
            $role = getUtilisateur($id);
            $role = $role['roleUtilisateur'];

            // stocker en session
            $_SESSION['id'] = $id;
            $_SESSION['role'] = $role;

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

        $pseudoValide = true;
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pseudo = $_POST["pseudo"];
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $mot_de_passe = $_POST["mot_de_passe"];
            $confirmer_mot_de_passe = $_POST["confirmer_mot_de_passe"];
            $role_utilisateur = $_POST["role_utilisateur"];

            if (!pseudoUnique($pseudo)) {
                $pseudoValide = false; 
            } else {
                $pseudoValide = true;
            }

            if ($pseudoValide) {
                try {
                    $id_utilisateur = ajoutUtilisateur($pseudo, $nom, $prenom, $mot_de_passe, $role_utilisateur);
                } catch (ModeleException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
        }
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