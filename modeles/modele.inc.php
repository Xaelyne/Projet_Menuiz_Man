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

    function getDossier() : array{

        $connexion = getConnexion();

        $sql = "SELECT dr.*, c.nomClient, u.nomUtilisateur
        FROM dossier_reclamation dr 
        INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
        INNER JOIN client c ON cmd.idClient = c.idClient
        INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur";

        $resultat = $connexion->query($sql);

        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }

    function rechercheDossier()  {

        $resultats = [];

        if(isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $recherche = $_GET['search'];
        
            $connexion = getConnexion();

            $sql = "SELECT *
            FROM dossier_reclamation dr 
            INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
            INNER JOIN client c ON cmd.idClient = c.idClient
            INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur
            WHERE dr.numDossier LIKE :search_term OR dr.dateDossier LIKE :search_term 
            OR c.nomClient LIKE :search_term OR dr.idUtilisateur LIKE :search_term OR dr.statutDossier LIKE :search_term";

            $curseur = $connexion->prepare($sql);

            $curseur->execute(['search_term' => "%$recherche%"]);

            $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

            return $resultats;
        }
    }

    function rechercheDossierBis($recherche)  {
        
            $connexion = getConnexion();

            $sql = "SELECT *
            FROM dossier_reclamation dr 
            INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
            INNER JOIN client c ON cmd.idClient = c.idClient
            INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur
            WHERE dr.numDossier LIKE :search_term OR dr.dateDossier LIKE :search_term 
            OR c.nomClient LIKE :search_term OR dr.idUtilisateur LIKE :search_term OR dr.statutDossier LIKE :search_term";

            $curseur = $connexion->prepare($sql);

            $curseur->execute(['search_term' => "%$recherche%"]);

            $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

            return $resultats;
        
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
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $user = getUtilisateur($id);
            $role = $user['roleUtilisateur'];
//var_dump("fonction role : " . $role);
        }
        return $role;
    }

    function afficherTypeDossier($typeDossier){
        if($typeDossier == 1)return "NPAI";
        else if($typeDossier == 2)return "NP";
        else if ($typeDossier == 3)return "EC";
        else if ($typeDossier == 4)return "EP";
        else return "SAV";
    }
    function afficherStatutDossier($statutDossier){
        if($statutDossier == 1) return "En cours de traitement";
        else if ($statutDossier == 2) return "En cours de réexpedition";
        else return "Terminer";
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

    function getCommandes() {
        $connexion = getConnexion();

        $sql = "SELECT * FROM commande";

        $resultat = $connexion->query($sql);

        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }


    function getCommande($recherche) {
        $connexion = getConnexion();

        //$sql = "SELECT com.numCommande, DATE_FORMAT(com.dateCommande, '%d/%m/%Y') AS 'dateCommande', cont.codeArticle, libelleArticle, garantieArticle, idDiag, com.idClient, nomClient, prenomClient, codePostalClient, villeClient 
        $sql = "SELECT com.numCommande, com.dateCommande, cont.codeArticle, libelleArticle, garantieArticle, idDiag, com.idClient, nomClient, prenomClient, codePostalClient, villeClient 
        FROM commande com 
        JOIN client c ON c.idClient = com.idClient 
        JOIN contenir cont ON cont.numCommande = com.numCommande 
        JOIN article art ON art.codeArticle = cont.codeArticle 
        WHERE com.numCommande = :search_term";

        $curseur = $connexion->prepare($sql);

        $curseur->execute(['search_term' => $recherche]);

        $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);
//var_dump($resultats);
        return $resultats;
    }

    function rechercheClient($recherche)  {

        $resultats = [];
        
        $connexion = getConnexion();

        $sql = "SELECT * FROM client WHERE nomClient LIKE :search_term OR prenomClient LIKE :search_term";

        $curseur = $connexion->prepare($sql);

        $curseur->execute(['search_term' => "%$recherche%"]);

        $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;

    }

    function rechercheCommande($recherche)  {

        $resultats = [];
        
        $connexion = getConnexion();

        $sql = "SELECT * FROM commande WHERE numcommande LIKE :search_term";

        $curseur = $connexion->prepare($sql);

        $curseur->execute(['search_term' => "%$recherche%"]);

        $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;

    }

    function rechercheClientCommande($recherche)  {

        //$resultats = [];

        //$recherche = intval($recherche);
        
        $connexion = getConnexion();

        $sql = "SELECT * FROM commande com JOIN client c ON c.idClient = com.idClient WHERE com.numCommande = :search_term";

        //$sql = "SELECT * FROM client WHERE commande LIKE :search_term OR prenomClient LIKE :search_term";

        $curseur = $connexion->prepare($sql);

        $curseur->execute(['search_term' => $recherche]);

        $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;

    }



    function pseudoUnique(string $pseudo) {

        $connexion = getConnexion();

        $sql = "SELECT COUNT(*) AS count FROM utilisateurs WHERE pseudoUtilisateur = ?";

        $curseur = $connexion->prepare($sql);

        $curseur->execute([$pseudo]);

        $result = $curseur->fetch(PDO::FETCH_ASSOC);
    
        return $result['count'] == 0; 
    }

    function dossierTermine() {

        $connexion = getConnexion();

        $sql = "SELECT * FROM dossier_reclamation WHERE statutDossier = 0";

        $resultat = $connexion->query($sql);

        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }



?>