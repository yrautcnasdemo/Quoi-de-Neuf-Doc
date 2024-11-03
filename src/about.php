<?php
session_start();
require_once("gestions/tools.php"); //Fonction qui permet au header de faire la différence entre un professionnel et un utilisateur
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/fonts.css">
    <title>A propos - Quoi de neuf Doc ?</title>
</head>
<body>
    
    <!-- Header -->
<?php 
    require_once "gestions/header.php";
?>

    <article>
        <figure class="about-zen">
            <img src="assets/images/Yoga.jpg" alt="img-yoga-girl">
            <figcaption>
                <h2>À propos de <br> "Quoi de neuf <span class="red-span">doc ?</span>"</h2>
                <p>"Quoi de neuf <span class="red-span">doc ?</span>" est né de l'idée de faciliter la recherche de professionnels de santé à proximité. En tant que développeur Web et Web mobile en formation, j'ai eu l'opportunité de travailler sur ce projet dans le cadre de mon stage, avec l'aide précieuse de mon tuteur, un médecin généraliste. Nous avons constaté qu'il était souvent difficile pour les patients de savoir quels médecins ou spécialistes acceptaient encore de nouveaux patients. C'est pourquoi nous avons décidé de créer ce site, qui offre une solution simple et efficace pour trouver un professionnel de santé en fonction de sa localisation, sa spécialisation, ses horaires, et surtout, sa disponibilité. Notre objectif est de rendre la santé plus accessible en offrant une plateforme claire, intuitive, chaleureuse et <span class="red-span">Zen</span> pour nos utilisateurs.</p>
            </figcaption>
        </figure>
    </article>


<!-- FOOTER -->
<?php 
    include_once "gestions/footer.php";
?>

    <script src="javascript/script.js"></script>
</body>
</html>