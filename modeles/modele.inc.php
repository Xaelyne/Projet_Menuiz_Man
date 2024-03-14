<?php
    require("ModeleException.php");

    function getConnexion() {
        if(file_exists("param.ini")) {
            $tParam = parse_ini_file("param.ini", true);
            extract($tParam['BDD']);
        } else {
            throw new ModeleException("Fichier param.ini absent");
        }
            
        $dsn = "mysql:host=$host;dbname=$bdd;";
        return new PDO($dsn, $login, $password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    function getUtilisateurs() : array {

        $connexion = getConnexion();

        $sql = "SELECT * FROM utilisateurs";

        $resultat = $connexion->query($sql);

        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }


    function rechercheUtilisateur()  {

        $resultats = [];

        if(isset($_POST['search']) && !empty(trim($_POST['search']))) {
            $recherche = $_POST['search'];
        
            $connexion = getConnexion();

            $sql = "SELECT * FROM utilisateurs WHERE nomUtilisateur LIKE :search_term OR prenomUtilisateur LIKE :search_term OR idUtilisateur LIKE :search_term OR roleUtilisateur LIKE :search_term";

            $curseur = $connexion->prepare($sql);

            $curseur->execute(['search_term' => "%$recherche%"]);

            $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

            return $resultats;
        }
    }

    function afficheRoleUtilisateur($role) {
        if ($role == 1) return "Administrateur";
        else if ($role == 2)  return "Technicien Hotline";
        else return "Technicien SAV";
    }

?>