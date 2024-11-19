<?php 
    const DBHOST = "db"; //correspond a db du fichier "Docker-compose.yml" 
    const DBNAME = "quoi_de_neuf_doc"; //correspond a MySQL DATABASE du fichier "Docker-compose.yml ATTENTION IL GERE TOUTES LES TABLES"
    const DBUSER = "test"; //correspond a MySQL USER du fichier "Docker-compose.yml"
    const DBPASS = "test"; //correspond a MySQL PASSWORD du fichier "Docker-compose.yml"

$dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

    //TRY connexion et si cela ne marche pas CATCH message d'erreur
    try {
        $db = new PDO($dsn, DBUSER, DBPASS);
        // echo "Connexion réussie"; // À éviter si header() est utilisé ailleurs dans le script
    } catch(PDOException $error) {
        echo "Echec de la connexion: " . $error->getMessage() . "<br>";
        die(); // Arrête le script en cas d'erreur critique
    }