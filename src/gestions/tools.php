<?php 
//Fonction qui permet au header de faire la différence entre un professionnel et un utilisateur
function userLogin() {
    return isset($_SESSION['user_id']);
}
function doctorLogin() {
    return isset($_SESSION['doctor_id']);
}
?>