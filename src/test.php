<?php
session_start();
    // Vérifiez si l'utilisateur ou le médecin est connecté
    if (isset($_SESSION['doctor_id'])) {
        $doctor_id = $_SESSION['doctor_id'];
        // Utilisez $doctor_id pour récupérer des informations supplémentaires sur le médecin
    } elseif (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        // Utilisez $user_id pour récupérer des informations supplémentaires sur l'utilisateur
    } else {
        // Redirigez vers une page de connexion si l'utilisateur n'est pas connecté
        header("Location: /login.php");
        exit();
    }

    // Ici, vous pouvez effectuer des requêtes pour récupérer les informations basées sur l'ID
    var_dump($_SESSION);
?>