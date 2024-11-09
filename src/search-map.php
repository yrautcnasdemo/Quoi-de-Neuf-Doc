<?php
// fetch_doctors.php

// Connexion à la base de données
require_once("connexion.php");

$doctors = [];

if (isset($_GET['region'])) {
    $region = $_GET['region'];
    $stmt = $db->prepare("SELECT * FROM doctors WHERE region = :region");
    $stmt->bindParam(':region', $region);
    $stmt->execute();
    $doctors = $stmt->fetchAll();
}
?>
