<?php
session_start();
require_once "../connexion.php";

// On vérifie si l'utilisateur est connecté et si l'ID du rendez-vous est fourni
if ((isset($_SESSION['user_id']) || isset($_SESSION['doctor_id'])) && isset($_POST['appointment_id'])) {
    $appointment_id = $_POST['appointment_id'];

    // Vérification si l'utilisateur est un patient
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $delete_query = "DELETE FROM appointment WHERE id = :appointment_id AND user_id = :user_id";
        
        $query = $db->prepare($delete_query);
        $query->bindValue(":appointment_id", $appointment_id, PDO::PARAM_INT);
        $query->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        
        $redirect_page = "../profile-user.php"; // Redirection pour les patients
    
    // Vérification si l'utilisateur est un médecin
    } elseif (isset($_SESSION['doctor_id'])) {
        $doctor_id = $_SESSION['doctor_id'];
        $delete_query = "DELETE FROM appointment WHERE id = :appointment_id AND doctor_id = :doctor_id";
        
        $query = $db->prepare($delete_query);
        $query->bindValue(":appointment_id", $appointment_id, PDO::PARAM_INT);
        $query->bindValue(":doctor_id", $doctor_id, PDO::PARAM_INT);
        
        $redirect_page = "../profile-doctor.php"; // Redirection pour les médecins
    }

    // Exécution de la requête et redirection
    if ($query->execute()) {
        header("Location: $redirect_page?message=rdv_supprimé");
        exit();
    } else {
        echo "Erreur lors de la suppression du rendez-vous.";
    }
} else {
    // Redirection vers la page de connexion si non connecté ou si appointment_id manquant
    header("Location: ../index.php");
    exit();
}
?>
