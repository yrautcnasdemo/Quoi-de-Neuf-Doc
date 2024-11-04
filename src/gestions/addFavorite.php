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


    // Utilisation de la variable $favorite pour inserer les infos dans la table SI $favorite n'existe pas déjà
    if ($favorite->rowCount() > 0) {
        $_SESSION['favorite_message'] = "Ce médecin est déjà dans vos favoris.";

    } else {
        //sinon ajout du médecin dans les favoris
        $add_pro = "INSERT INTO favorites (user_id, doctor_id) VALUES (:user_id, :doctor_id)"; // on rentre les valeurs

        $query = $db->prepare($add_pro);
        $query->bindValue(":user_id", $user_id);
        $query->bindValue(":doctor_id", $doctor_id);
        $query->execute();

        $_SESSION['favorite_message'] = "Médecin ajouté aux favoris.";
        }

} else {
    $_SESSION['favorite_message'] = "Erreur lors de l'ajout du favori.";
}

// On se redirige vers search.php
header("Location: ../search.php");
exit();
?>
