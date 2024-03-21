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

    function getRechercherDossier() : array{

        $connexion = getConnexion();

        $sql = "SELECT dr.*, c.nomClient, u.nomUtilisateur,c.prenomClient,cmd.dateCommande
        FROM dossier_reclamation dr 
        INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
        INNER JOIN client c ON cmd.idClient = c.idClient
        INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur";

        $resultat = $connexion->query($sql);

        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
    function getDossier($numDossier) {
        $connexion = getConnexion();
    
        $sql = "SELECT dr.*, c.nomClient, c.prenomClient, u.nomUtilisateur, cmd.dateCommande, 
        article.garantieArticle,article.libelleArticle, contenir.codeArticle
                FROM dossier_reclamation dr 
                INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
                INNER JOIN client c ON cmd.idClient = c.idClient
                INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur
                INNER JOIN contenir ON cmd.numCommande = contenir.numCommande
                INNER JOIN article ON contenir.codeArticle = article.codeArticle
                WHERE dr.numDossier = :numDossier";
    
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':numDossier', $numDossier, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    function getUtilisateurOnDossier() {

        $connexion = getConnexion();

        $sql = "SELECT dr.numDossier, dr.idUtilisateur, u.nomUtilisateur, u.prenomUtilisateur
        FROM dossier_reclamation dr 
        INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur";

        $curseur = $connexion->prepare($sql);

        $curseur->execute();

        $resultat = $curseur->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;

    }


        function modifierStatut($statutDossier, $numDossier){
       
        $connexion = getConnexion();

        $sql ="UPDATE dossier_reclamation SET statutDossier = $statutDossier WHERE numDossier = $numDossier";

        $connexion->query($sql);

        }

    function rechercheDossier($recherche)  {
        
            $connexion = getConnexion();

            $sql = "SELECT *
            FROM dossier_reclamation dr 
            INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
            INNER JOIN client c ON cmd.idClient = c.idClient
            INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur
            WHERE dr.numDossier LIKE :search_term OR dr.dateDossier LIKE :search_term OR dr.typeDossier LIKE :search_term OR dr.dateClotureDossier LIKE :search_term
            OR c.nomClient LIKE :search_term OR dr.idUtilisateur LIKE :search_term OR dr.statutDossier LIKE :search_term";

            $curseur = $connexion->prepare($sql);

            $curseur->execute(['search_term' => "%$recherche%"]);

            $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

            return $resultats;
    }
    

    function rechercheUtilisateur($recherche)  {
   
        $connexion = getConnexion();

        $sql = "SELECT * FROM utilisateurs WHERE nomUtilisateur LIKE :search_term OR prenomUtilisateur LIKE :search_term OR idUtilisateur LIKE :search_term OR roleUtilisateur LIKE :search_term OR pseudoUtilisateur LIKE :search_term";

        $curseur = $connexion->prepare($sql);

        $curseur->execute(['search_term' => "%$recherche%"]);

        $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
        
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
        else if ($typeDossier == 5)return "SAV";
    }

    function afficherStatutDossier($statutDossier){
        if($statutDossier == 1) return "En cours de diagnostics";
        else if ($statutDossier == 2) return "En cours de réexpedition";
        else if($statutDossier == 3) return "Terminer";

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



    function ajoutUtilisateur(string $pseudoUtilisateur, string $nom, string $prenom, string $mdpUtilisateur, int $role) {
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

    function getAdmins() {

        $connexion = getConnexion();
    
        $sql = "SELECT COUNT(*) AS count FROM utilisateurs WHERE roleUtilisateur = 1";

        $curseur = $connexion->prepare($sql);
    
        $curseur->execute();
    
        $resultat = $curseur->fetch(PDO::FETCH_ASSOC);
    
        return $resultat['count'];
    
    }

    function getRoleUtilisateur() {

        $connexion = getConnexion();

        $sql = "SELECT idUtilisateur, roleUtilisateur FROM utilisateurs";

        $curseur = $connexion->prepare($sql);

        $curseur->execute();

        $resultat = $curseur->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }


    function supprimerUtilisateur(int $id_utilisateur) {

        $connexion = getConnexion();

        $sql = "DELETE FROM utilisateurs WHERE idUtilisateur = :idUti";

        $curseur = $connexion->prepare($sql);

        $curseur->execute([':idUti' => $id_utilisateur]);

        $nbSuppr = $curseur->rowCount();

        return $nbSuppr;
    }

    
    function getClients() : array {

        $connexion = getConnexion();

        $sql = "SELECT * FROM client";

        $resultat = $connexion->query($sql);

        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }

    function getClient($idClient) {

        $connexion = getConnexion();

        $sql = "SELECT * FROM client WHERE idClient = :search_term";

        $curseur = $connexion->prepare($sql);

        $curseur->execute(['search_term' => $idClient]);

        $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
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
        $sql = "SELECT com.numCommande, com.dateCommande, cont.codeArticle, libelleArticle, art.prixUnitaire, garantieArticle, idDiag, com.idClient, nomClient, prenomClient, codePostalClient, villeClient 
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

    function rechercheCommandesClient($idClient) {
        $connexion = getConnexion();

        $sql = "SELECT * FROM commande WHERE idClient = :search_term";

        $curseur = $connexion->prepare($sql);

        $curseur->execute(['search_term' => $idClient]);

        $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    }


    function getPseudos() {
        $connexion = getConnexion();

        $sql = "SELECT pseudoUtilisateur FROM utilisateurs";

        $curseur = $connexion->prepare($sql);

        $curseur->execute();

        $resultat = $curseur->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultat;
    }

    function dossierTermine() {

        $connexion = getConnexion();

        $sql = "SELECT *
        FROM dossier_reclamation dr 
        INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
        INNER JOIN client c ON cmd.idClient = c.idClient
        INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur
        WHERE statutDossier = 3";

        $resultat = $connexion->query($sql);

        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
    function rechercheDossierTerm($recherche)  {
                
        $connexion = getConnexion();

        $sql = "SELECT *
        FROM dossier_reclamation dr 
        INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
        INNER JOIN client c ON cmd.idClient = c.idClient
        INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur
        WHERE dr.statutDossier = 3 AND (dr.numDossier LIKE :search_term OR dr.dateDossier LIKE :search_term OR dr.typeDossier LIKE :search_term 
        OR c.nomClient LIKE :search_term OR dr.idUtilisateur LIKE :search_term)";

        $curseur = $connexion->prepare($sql);

        $curseur->execute(['search_term' => "%$recherche%"]);

        $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
}

    function dossierDiagnostic() {

        $connexion = getConnexion();

        $sql = "SELECT *
        FROM dossier_reclamation dr 
        INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
        INNER JOIN client c ON cmd.idClient = c.idClient
        INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur
        WHERE statutDossier = 1";

        $resultat = $connexion->query($sql);

        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }

    function rechercheDossierDiag($recherche)  {
                
        $connexion = getConnexion();

        $sql = "SELECT *
        FROM dossier_reclamation dr 
        INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
        INNER JOIN client c ON cmd.idClient = c.idClient
        INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur
        WHERE dr.statutDossier = 1 AND (dr.numDossier LIKE :search_term OR dr.dateDossier LIKE :search_term OR dr.typeDossier LIKE :search_term 
        OR c.nomClient LIKE :search_term OR dr.idUtilisateur LIKE :search_term)";

        $curseur = $connexion->prepare($sql);

        $curseur->execute(['search_term' => "%$recherche%"]);

        $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
        }


    function dossierExpedition() {
        $connexion = getConnexion();

        $sql = "SELECT *
        FROM dossier_reclamation dr 
        INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
        INNER JOIN client c ON cmd.idClient = c.idClient
        INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur
        WHERE statutDossier = 2";

        $resultat = $connexion->query($sql);

        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
    function rechercheDossierExpe($recherche)  {
                
        $connexion = getConnexion();

        $sql = "SELECT *
        FROM dossier_reclamation dr 
        INNER JOIN commande cmd ON dr.numCommande = cmd.numCommande 
        INNER JOIN client c ON cmd.idClient = c.idClient
        INNER JOIN utilisateurs u ON dr.idUtilisateur = u.idUtilisateur
        WHERE dr.statutDossier = 2 AND (dr.numDossier LIKE :search_term OR dr.dateDossier LIKE :search_term OR dr.typeDossier LIKE :search_term 
        OR c.nomClient LIKE :search_term OR dr.idUtilisateur LIKE :search_term)";

        $curseur = $connexion->prepare($sql);

        $curseur->execute(['search_term' => "%$recherche%"]);

        $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
        }

        function ajoutDossier($typeDossier, $statutDossier, $numCom, $idUtilisateur, $commentaire) {

            try {
                $connexion = getConnexion();

                $sql = "INSERT INTO dossier_reclamation
                (dateDossier, typeDossier, statutDossier, numCommande, idUtilisateur, commentaireDossier) 
                VALUES (CURRENT_DATE(), :typeDossier, :statutDossier, :numCommande, :idUtilisateur, :commentaireDossier)";

                $requete = $connexion->prepare($sql);


                $requete->bindParam(':statutDossier', $statutDossier);
                $requete->bindParam(':typeDossier', $typeDossier);
                $requete->bindParam(':numCommande', $numCom);
                $requete->bindParam(':idUtilisateur', $idUtilisateur);
                $requete->bindParam(':commentaireDossier', $commentaire);
    
                $requete->execute();
             
            } catch (PDOException $e) {
                throw new ModeleException("Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage());
            }

            return $connexion->lastInsertId();
        }   
        
        function ajoutDossierArticle($codeArticle, $numDossier) {

            try {
                $connexion = getConnexion();

                $sql = "INSERT INTO concerner(codeArticle, numDossier) 
                VALUES (:codeArticle, :numDossier)";

                $requete = $connexion->prepare($sql);


                $requete->bindParam(':codeArticle', $codeArticle);
                $requete->bindParam(':numDossier', $numDossier);
    
                $requete->execute();
             
            } catch (PDOException $e) {
                throw new ModeleException("Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage());
            }
        }

        function getCommandeReclamation($idCommande) {
            $connexion = getConnexion();

            $sql = "SELECT * FROM dossier_reclamation WHERE numCommande = :search_term";

            $curseur = $connexion->prepare($sql);

            $curseur->execute(['search_term' => $idCommande]);

            $resultats = $curseur->fetchAll(PDO::FETCH_ASSOC);

            return $resultats;
        }

?>