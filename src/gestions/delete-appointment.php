<?php
session_start();
require_once "../connexion.php";

//On vérifie si l'utilisateur est connecté et l'id du RDV
if (isset($_SESSION['user_id']) && isset($_POST['appointment_id'])) {
    $user_id = $_SESSION['user_id'];
    $appointment_id = $_POST['appointment_id'];

    $suppr_rdv = "DELETE FROM appointment WHERE id = :appointment_id AND user_id = :user_id";

    $query = $db->prepare($suppr_rdv);
    
    $query->bindValue(":appointment_id", $appointment_id, PDO::PARAM_INT);
    $query->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    
    if ($query->execute()) {
        // On redirige vers la page profile-user.php apres la suppression du RDV
        header("Location: ../profile-user.php?message=rdv_supprimé");
        exit();
    } else {
        echo "Erreur lors de la suppression du rendez-vous.";
    }
} else {
    // On redirige vers la page de connexion si l'utilisateur n'est pas connecté ou si l'appointment_id est manquant
    header("Location: ../index.php");
    exit();
}
?>
