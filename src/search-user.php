<?php
session_start();

require_once("gestions/tools.php"); // Fonction qui permet au header de faire la différence entre un professionnel et un utilisateur
require_once("connexion.php");


if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']);
}



// Gestion des messages d'erreurs des favoris
if (isset($_SESSION['favorite_message'])) {
    echo "<script>alert('" . $_SESSION['favorite_message'] . "');</script>";
    unset($_SESSION['favorite_message']);
}

// Requête de base
$sql = "SELECT * FROM users";
$conditions = [];
$params = [];

// Vérifie chaque champ et ajoute des conditions selon les besoins
if (!empty($_GET['id'])) {
    $conditions[] = "id = :id";
    $params[':id'] = $_GET['id'];
}

if (!empty($_GET['user_mail'])) {
    $conditions[] = "user_mail = :user_mail";
    $params[':user_mail'] = $_GET['user_mail'];
}

// Ajoute les conditions à la requête si nécessaire
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Exécute la requête
$query = $db->prepare($sql);
$query->execute($params);
$user_info = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/fonts.css">
    <title>Recherche</title>
</head>
<body>

<!-- Header -->
<?php 
    require_once "gestions/header.php";
?>

<main>
    <!-- SEARCH FILTER -->
    <section class="search-filter">
        <form class="search-doctor-form" method="GET" action="search-user.php">
            <div class="first-section">
                <div class="style-search">
                    <p>Tapez l'id de votre patient:</p>
                    <input type="number" name="id">
                </div>

                <span>Ou</span>

                <div class="style-search">
                    <p>Tapez le mail de votre patient:</p>
                    <input type="email" name="user_mail">
                </div>
            </div>
            <button type="submit" name="envoyer">Rechercher</button>
        </form>
    </section>

    <!-- USER CARDS -->
    <section class="doctor-cards">
    <?php if (!empty($user_info)): ?>
        <?php foreach ($user_info as $user): ?>
            <figure class="user-card">
                <!-- Chemin de l'image depuis la BDD attention au path !! -->
                <img class="img-user" src="<?= !empty($user['user_image']) ? 'assets/images/profiles/' . htmlspecialchars($user['user_image']) : 'assets/images/profiles/userimgnotfound.png'; ?>" alt="user img">
                <figcaption>
                    <h1><?= htmlspecialchars($user['user_firstname']) . ' ' . htmlspecialchars($user['user_lastname']) ?></h1>
                    <div>
                        <div>
                            <span>id: <?= $user['id']?></span>
                        </div>
                        <div class="adress-user-main">
                            <span>Adresse:</span>
                            <p><?= !empty($user['user_address']) ? htmlspecialchars($user['user_address']) : 'Address: non-renseigné' ?></p>
                            <p><?= !empty($user['user_department']) ? htmlspecialchars($user['user_department']) : 'CP: N/A' ?> - <?= !empty($user['user_city']) ? htmlspecialchars($user['user_city']) : 'Ville: N/A' ?></p>
                        </div>
                        <div class="pm-user">
                            <p>Telephone: <?= !empty($user['user_phone']) ? htmlspecialchars($user['user_phone']) : 'non-renseigné' ?></p>
                            <p>eMail: <?= htmlspecialchars($user['user_mail']) ?></p>
                        </div>
                    </div>
                    <form action="enregistrer_rdv.php" method="POST">
                        <h4>Enregistrer un Rendez-vous:</h4>
                        <p>
                            <input name="day" class="input-rdv" type="number" min="1" max="31" placeholder="jour">
                            <input name="month" class="input-rdv" type="number" min="1" max="12" placeholder="mois">
                            <input name="year" class="input-rdv" type="number" min="2024" max="9990" placeholder="année">
                        </p>
                        <p>
                            <p>Horaire:</p>
                            <input name="hour" class="input-rdv" type="number" min="0" max="23" placeholder="14">
                            <span>h</span>
                            <input name="minutes" class="input-rdv" type="number" min="0" max="59" placeholder="30">
                        </p>
                        <span>Note:</span>
                        <textarea class="note-info-area" name="info" rows="5" cols="33" placeholder="Entrez une note (facultatif)"></textarea>
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <input type="hidden" name="doctor_id" value="<?= $doctor_id ?>"> <!-- Remplace par l'ID du médecin courant -->
                        <button type="submit" name="submit_rdv">Enregistrer</button>
                    </form>

                </figcaption>
            </figure>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun utilisateur trouvé avec ces informations.</p>
    <?php endif; ?>
    </section>
</main>

<!-- FOOTER -->
<?php 
    include_once "gestions/footer.php";
?>

<script src="javascript/script.js"></script>
</body>
</html>
