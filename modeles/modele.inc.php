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

        if(isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $recherche = $_GET['search'];
        
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

    function afficheHeader () {
        $role = 0;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = getUtilisateur($id);
            $role = $user['roleUtilisateur'];
var_dump("fonction role : " . $role);
        }
        return $role;
    }


    function controleConnexion($pseudoUtilisateur, $mdpUtilisateur, $users) {
        $idUser = 0;

        foreach ($users as $utilisateur) {
            if ($utilisateur['pseudoUtilisateur'] == $pseudoUtilisateur) { // si pseudo correct
                if ($utilisateur['mdpUtilisateur'] == $mdpUtilisateur) { // si mot de passe correct
                    $idUser = $utilisateur['idUtilisateur']; 
                    return $idUser; // retourne l'id utilisateur
                } else {
                    $idUser = -1; // mot de passe incorrect
                    return $idUser;
                }
            } 
        }
        return $idUser; //idUser = 0 -> Utilisateur introuvable
    }

    function getUtilisateur($id) {
        $bdd = getConnexion();

        // requête SQL
        $sql = "SELECT * FROM utilisateurs WHERE idUtilisateur = :id";

        // Préparation de la requête SQL
        $requete = $bdd->prepare($sql);

        // Liaison des paramètres
        $requete->bindParam(':id', $id);

        // Exécution de la requête
        $requete->execute();

        $result = $requete->fetch(PDO::FETCH_ASSOC);

        return $result;
    }



    function ajoutUtilisateur($pseudoUtilisateur, $nom, $prenom, $mdpUtilisateur, $role) {
        try {
            
            $connexion = getConnexion();
    

            $sql = "INSERT INTO utilisateurs (pseudoUtilisateur, nomUtilisateur, prenomUtilisateur, mdpUtilisateur, roleUtilisateur) 
                    VALUES (:pseudo, :nom, :prenom, :motDePasse, :role)";
    
            $requete = $connexion->prepare($sql);
    
            
            $requete->bindParam(':pseudo', $pseudoUtilisateur);
            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':prenom', $prenom);
            $requete->bindParam(':motDePasse', $mdpUtilisateur);
            $requete->bindParam(':role', $role);
    
            $requete->execute();
    
            
            return $connexion->lastInsertId();

        } catch (PDOException $e) {
            
            throw new ModeleException("Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage());
        }
    }

    function getClients() : array {

        $connexion = getConnexion();

        $sql = "SELECT * FROM client";

        $resultat = $connexion->query($sql);

        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }

    function rechercheClient()  {

        $resultats = [];

        if(isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $recherche = $_GET['search'];
        
            $connexion = getConnexion();

            $sql = "SELECT * FROM client WHERE nomClient LIKE :search_term OR prenomClient LIKE :search_term";

            $curseur = $connexion->prepare($sql);

            $curseur->execute(['search_term' => "%$recherche%"]);

            $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

            return $resultats;

        }
    }

    function connexionSession() {
        session_start();
        $id = $_GET['id'];
        $_SESSION['id'] = $id;
    }


    function pseudoUnique(string $pseudo) {

        $connexion = getConnexion();

        $sql = "SELECT COUNT(*) AS count FROM utilisateurs WHERE pseudoUtilisateur = ?";

        $curseur = $connexion->prepare($sql);

        $curseur->execute([$pseudo]);

        $result = $curseur->fetch(PDO::FETCH_ASSOC);
    
        return $result['count'] == 0; 
    }

?>