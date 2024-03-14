<?php

$action = "accueil";

if (isset($_GET['action'])) $action = $_GET['action'];
if (!isset($_GET['action'])) $action = "connexion";

require("./modeles/modele.inc.php");

var_dump($action);

// switch sur si pas de connexion trouvé -> formulaire connexion
switch ($action) {
    case "connexion":
        $titre = "Connexion";
        require "./vues/vueHeader.php";
        require "./vues/vueConnexion.php";
        break;
    case "connexionMaj":
        $pseudoUtilisateur = $_GET['user'];
        $mdpUtilisateur = $_GET['pass'];
        
        $users = getUtilisateurs();// liste des utilisateurs

        $id = controleConnexion($pseudoUtilisateur, $mdpUtilisateur, $users);

        if ($id == 0) { // utilisateur introuvable
            $titre = "Connexion<br><h2 class='text-center'>Utilisateur introuvable</h2>";
            require "./vues/vueHeader.php";
            require "./vues/vueConnexion.php";
        } else if ($id == -1) { // mot de passe incorrect
            $titre = "Connexion<br><h2 class='text-center'>Mot de passe incorrect</h2>";
            require "./vues/vueHeader.php";
            require "./vues/vueConnexion.php";
        } else { // connexion validée
            $role = getUtilisateur($id);
            $role = $role['roleUtilisateur'];

            if($role == 1) {
                $action = "accueilAdmin";
            } else if ($role == 2) {
                $action = "accueilHotline";
            } else {
                $action = "accueilSAV";   
            }

            header("Location: index.php?action=$action&id=$id");
        }
        break;
    case "accueilAdmin":
        $id = $_GET['id'];
        $utilisateur = getUtilisateur($id);
        $nom = $utilisateur['nomUtilisateur'];
        $prenom = $utilisateur['prenomUtilisateur'];
        $role = afficheRoleUtilisateur($utilisateur['roleUtilisateur']);

        $titre = "Bonjour $nom $prenom, vous êtes connecté en tant que $role";
        require "./vues/vueHeader.php";
        $utilisateurs = getUtilisateurs();
        require "./vues/vueAccueil.php";
}

require "./vues/vueFooter.php";


