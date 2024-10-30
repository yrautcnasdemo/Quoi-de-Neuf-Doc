<?php
    session_start();
    require_once "connexion.php";

    // Vérification si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Déboguer l'ID de l'utilisateur
        echo "User ID from session: " . $user_id . "<br>";

        $query = $db->prepare("SELECT * FROM users WHERE ID = :id");
        $query->execute([':id' => $user_id]);
        $user_info = $query->fetch();

    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: /login.php");
        exit();
    }
?>
