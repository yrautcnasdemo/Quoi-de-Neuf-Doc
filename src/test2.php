<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Continuez avec votre logique pour récupérer les données de l'utilisateur
} else {
    header("Location: /login.php"); // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

    // Ici, vous pouvez effectuer des requêtes pour récupérer les informations basées sur l'ID
    var_dump($_SESSION);
?>