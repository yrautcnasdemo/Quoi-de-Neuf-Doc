<?php
session_start();
require_once "../connexion.php";

// Vérification si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM users WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(":id", $user_id, PDO::PARAM_INT);

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
