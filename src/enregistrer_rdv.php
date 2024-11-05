<?php
session_start();
require_once("connexion.php");

if (isset($_POST['submit_rdv'])) {
    // vérification de l'id du médecin dans la SESSION
    if (!isset($_SESSION['doctor_id'])) {
        $_SESSION['message'] = "Erreur: ID du médecin introuvable.";
        header("Location: search-user.php");
        exit();
    }

    // On récupere les données du formulaire présent dans search-user.php
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $hour = $_POST['hour'];
    $minutes = $_POST['minutes'];
    $note_info = $_POST['info'];
    $user_id = $_POST['user_id']; //l'ID de l'utilisateur est récuperer depuis le formulaire de rendez-vous sur search-user.php
    $doctor_id = $_SESSION['doctor_id'];  // On récupere l'ID du médecin depuis la session

    // Assemblage de la date et heure au format DATETIME
    $appointment_datetime = sprintf("%04d-%02d-%02d %02d:%02d:00", $year, $month, $day, $hour, $minutes);

    // ma requete
    $sql = "INSERT INTO appointment (user_id, doctor_id, appointment_datetime, note_info) VALUES (:user_id, :doctor_id, :appointment_datetime, :note_info)";
    $query = $db->prepare($sql);

    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
    $query->bindParam(':appointment_datetime', $appointment_datetime);
    $query->bindParam(':note_info', $note_info);

    if ($query->execute()) {
        $_SESSION['message'] = "Rendez-vous enregistré";
        header("Location: search-user.php");
        exit();
    } else {
        $_SESSION['message'] = "Erreur lors de l'enregistrement du rendez-vous.";
        header("Location: search-user.php");
        exit();
    }
}
?>
