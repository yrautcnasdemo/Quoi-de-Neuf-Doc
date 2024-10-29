<?php
require_once("connexion.php");

//Ma requete SQL
$sql= "SELECT * FROM doctors";

//on prépare la requete
$query = $db->prepare($sql);

//on execute la requete
$query->execute();

//on stock le résulta
$result = $query->fetchAll();
var_dump($result);
?>