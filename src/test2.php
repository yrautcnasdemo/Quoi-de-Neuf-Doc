<?php
session_start();
require_once "connexion.php";

// Verification si l'utilisateur médecin est connecté
if (isset($_SESSION['doctor_id'])) {
    $doctor_id = $_SESSION['doctor_id'];

    $query = $db->prepare("SELECT * FROM doctors WHERE id = :id");

    $query->bindValue(":id", $doctor_id, PDO::PARAM_INT);
    $query->execute();
    $doctor = $query->fetch();

} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: /index.php");
    exit();
}
?>