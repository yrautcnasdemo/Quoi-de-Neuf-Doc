<?php
session_start();
require_once "../connexion.php";

// On verifie si l'utilisateur est bien connecté 
if (isset($_SESSION['user_id']) && isset($_GET['doctor_id'])) {
    $user_id = $_SESSION['user_id'];
    $doctor_id = $_GET['doctor_id'];

    // Vérification de la présence du médecin déjà en favoris (donc récupération des données dans la table "favorites")
    $sql = "SELECT * FROM favorites WHERE user_id = :user_id AND doctor_id = :doctor_id";

    $query = $db->prepare($sql);
    $query->bindValue(":user_id", $user_id);
    $query->bindValue(":doctor_id", $doctor_id);
    $query->execute();
    $favorite = $query->fetch();

    if (!$favorite) {
        // Utilisation de la variable $favorite pour inserer les infos dans la table SI $favorite n'existe pas déjà

        $add_pro = "INSERT INTO favorites (user_id, doctor_id) VALUES (:user_id, :doctor_id)"; // Jointure de table a cette ligne

        $query = $db->prepare($add_pro);
        $query->bindValue(":user_id", $user_id);
        $query->bindValue(":doctor_id", $doctor_id);
        $query->execute();
        echo "Médecin ajouté aux favoris avec succès.";
    } else {
        echo "Ce médecin est déjà dans vos favoris.";
    }

    // Redirection vers la page de recherche
    header("Location: ../search.php");
    exit();
} else {
    echo "Erreur : Vous devez être connecté pour ajouter des favoris.";
    header("Location: ../index.php");
    exit();
}
?>
