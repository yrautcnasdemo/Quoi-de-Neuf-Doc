<?php
session_start();
require_once "../connexion.php";

// Vérification si l'utilisateur médecin est connecté
if (isset($_SESSION['doctor_id'])) {
    $doctor_id = $_SESSION['doctor_id'];

    $sql = "DELETE FROM doctors WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(":id", $doctor_id, PDO::PARAM_INT);

    if ($query->execute()) {
        // Suppression réussie, on détruit la session et on redirige
        session_unset();
        session_destroy();
        header("Location: /index.php?deleted=1");
        exit();
    } else {
        echo "Une erreur est survenue lors de la suppression de votre compte.";
    }
} else {
    // Redirection si l'utilisateur n'est pas connecté
    header("Location: /index.php");
    exit();
}
?>
