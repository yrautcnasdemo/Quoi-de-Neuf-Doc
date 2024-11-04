<?php
session_start();
require_once "../connexion.php";

// On vérifie si l'utilisateur est connecté
if (isset($_SESSION['user_id']) && isset($_POST['doctor_id'])) {
    $user_id = $_SESSION['user_id'];
    $doctor_id = $_POST['doctor_id'];

    // requete de suppression du favori de la base de données
    $suppr_doctor = "DELETE FROM favorites WHERE user_id = :user_id AND doctor_id = :doctor_id";

    $query = $db->prepare($suppr_doctor);
    
    $query->bindValue(":user_id", $user_id);
    $query->bindValue(":doctor_id", $doctor_id);
    
    $query->execute();

    header("Location: ../profile-user.php");
    exit();
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté ou si le doctor_id est manquant
    header("Location: ../index.php");
    exit();
}
?>
