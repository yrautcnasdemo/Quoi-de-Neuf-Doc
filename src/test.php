<?php
session_start();
require_once "connexion.php"; // Assurez-vous d'inclure votre connexion à la base de données ici

// Vérification si l'utilisateur médecin est connecté
if (isset($_SESSION['doctor_id'])) {
    $doctor_id = $_SESSION['doctor_id'];

    // Déboguer l'ID du médecin
    echo "Doctor ID from session: " . $doctor_id . "<br>";

    $query = $db->prepare("SELECT * FROM doctors WHERE id = :id");
    $query->execute([':id' => $doctor_id]);
    $doctor_info = $query->fetch();

    // Déboguer les informations du médecin
    echo "<pre>";
    print_r($doctor_info);
    echo "</pre>";

} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: /login.php");
    exit();
}
?>
