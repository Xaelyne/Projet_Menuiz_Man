<?php

$action = "accueil";

if (isset ($_GET['action']))
    $action = $_GET['action'];
if (!isset ($_GET['action']))
    $action = "connexion";

require ("./modeles/modele.inc.php");


var_dump("action -> " . $action);

// switch sur si pas de connexion trouvé -> formulaire connexion
switch ($action) {
    case "connexion":
        session_start();
        $titre = "Connexion";
        $roleHeader = afficheHeader();
        require "./vues/vueHeader.php";
        require "./vues/vueConnexion.php";
        break;
    case "accueilTechnicienSAV":
        // récupération ID et ROLE
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            // récupération des infos utilisateurs
            $utilisateur = getUtilisateur($id);
            $nom = $utilisateur['nomUtilisateur'];
            $prenom = $utilisateur['prenomUtilisateur'];
            $role = afficheRoleUtilisateur($utilisateur['roleUtilisateur']);

            $titre = "Bonjour $nom $prenom, vous êtes connecté en tant que $role";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            require "./vues/vueAccueil.php";
        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;
    case "accueilTechnicienHOT":
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            // récupération des infos utilisateurs
            $utilisateur = getUtilisateur($id);
            $nom = $utilisateur['nomUtilisateur'];
            $prenom = $utilisateur['prenomUtilisateur'];
            $role = afficheRoleUtilisateur($utilisateur['roleUtilisateur']);

            $titre = "Bonjour $nom $prenom, vous êtes connecté en tant que $role";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            require "./vues/vueAccueil.php";
        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;
    case "nouveauDossier":
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "Rechercher une commande"; // à modifier par une recherche client
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            $clients = getClients();
            require "./vues/vueCreerDossier.php";
        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;
    case "nouveauDossierRechercheClient":
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "Créer un nouveau dossier"; // à modifier par une recherche client
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";

            if ($_GET['optionRechercheNouveauDossier'] == 'nom') {
                $clients = getClients();
                if (isset ($_GET['search'])) {
                    $search = $_GET['search'];
                    $recherche = rechercheClient($search);
                }
            } else if ($_GET['optionRechercheNouveauDossier'] == 'com') {
                $commandes = getCommandes();
                if (isset ($_GET['search'])) {
                    $search = $_GET['search'];
                    //$recherche = rechercheCommande($search);
                    $recherche = rechercheClientCommande($search);
                }
            }
            require "./vues/vueCreerDossier.php";
            break;
        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
    case "rechercherDossier":
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "Rechercher un dossier";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            $dossiers = getDossier();
            require "./vues/vueRechercherDossier.php";
            if (isset ($_GET['search'])) {
                $resultats_recherche = rechercheDossier($recherche);
            }

           
        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;
    case "rechercherDossierMAJ":
        
        session_start();
        if (isset ($_SESSION['id'])) {

            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "Résultat de votre recherche";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            if (isset ($_GET['search'])) {
                $recherche = $_GET['search'];
                $resultats_recherche = rechercheDossier($recherche);
            }
            require "./vues/vueResultat.php";
        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;
    case "voirDossier":
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "Dossier";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";

            require "vues/vueDossier.php";
        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;  
    case "dossierTermine":
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "Dossiers terminés";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";

            $dossiers = dossierTermine();

            require "./vues/vueDossierTermine.php";

        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;

    case "dossierTermineMaj":
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "Dossiers terminés";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";

            if(isset($_GET['search'])) {
                $recherche = $_GET['search'];
                $result = rechercheDossierBis($recherche);
            }

            require "./vues/vueDossierTermine.php";

        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;

    case "diagnostics":
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "Diagnostics";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            require "./vues/vueAccueil.php";
        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;
    case "expedition":
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "Expedition";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            require "./vues/vueAccueil.php";
        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;
    case "connexionMaj":
        $pseudoUtilisateur = $_GET['user'];
        $mdpUtilisateur = $_GET['pass'];

        $users = getUtilisateurs(); // liste des utilisateurs

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
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['role'] = $role;

            if ($role == 1) {
                $action = "accueilAdmin";
            } else if ($role == 2) {
                $action = "accueilTechnicienHOT";
            } else {
                $action = "accueilTechnicienSAV";
            }

            header("Location: index.php?action=$action");
        }
        break;
    case "accueilAdmin":
        session_start();

        if (isset ($_SESSION['id'])) {

            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            // infos utilisateur
            $utilisateur = getUtilisateur($id);
            $nom = $utilisateur['nomUtilisateur'];
            $prenom = $utilisateur['prenomUtilisateur'];
            $role = afficheRoleUtilisateur($utilisateur['roleUtilisateur']);

            $pseudoValide = true;


            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $pseudo = $_POST["pseudo"];
                $nomForm = $_POST["nom"];
                $prenomForm = $_POST["prenom"];
                $mot_de_passe = $_POST["mot_de_passe"];
                $confirmer_mot_de_passe = $_POST["confirmer_mot_de_passe"];
                $role_utilisateur = $_POST["role_utilisateur"];

                try {
                    $id_utilisateur = ajoutUtilisateur($pseudo, $nomForm, $prenomForm, $mot_de_passe, $role_utilisateur);
                    header("Location: index.php?action=accueilAdmin");
                } catch (ModeleException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }


            $titre = "Bonjour $nom $prenom, vous êtes connecté en tant que $role";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            require ("./vues/popup.php");
            $utilisateurs = getUtilisateurs();
            require "./vues/vueAccueil.php";

            

            } else {
                $roleHeader = 0;
                $titre = "Erreur";
                $action = "erreur";
                require "./vues/vueHeader.php";
                require "vues/vueErreur.php";
            }
        
        break;

    case "accueilAdminMAJ":
        session_start();
        if (isset ($_SESSION['id'])) {

            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "Résultat de votre recherche";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";
            if (isset ($_GET['search'])) {
                $recherche = $_GET['search'];
                $resultats_recherche = rechercheUtilisateur($recherche);
            }
            require "./vues/vueResultat.php";
        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;

    case "voirCommande":
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "Commande";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";

            $numCom = $_GET['commande'];
            $commande = getCommande($numCom);

            require "vues/vueCommande.php";
        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
        break;

    case "deconnexion":
        session_start();
        session_destroy();
        header("Location: index.php");
        break;


    // Exemple a copier pour les actions
    case "EXEMPLE BASE ACTION":
        session_start();
        if (isset ($_SESSION['id'])) {
            // récupération ID et ROLE
            $id = $_SESSION['id'];
            $roleUser = $_SESSION['role'];

            $titre = "A MODIFIER";
            $roleHeader = afficheHeader();
            require "./vues/vueHeader.php";

            //affichage

        } else {
            $roleHeader = 0;
            $titre = "Erreur";
            $action = "erreur";
            require "./vues/vueHeader.php";
            require "vues/vueErreur.php";
        }
}

require "./vues/vueFooter.php";
