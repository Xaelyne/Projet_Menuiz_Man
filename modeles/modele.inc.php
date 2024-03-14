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

?>