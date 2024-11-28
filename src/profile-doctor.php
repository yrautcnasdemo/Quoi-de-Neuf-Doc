<?php
session_start();

require_once("gestions/tools.php"); //Fonction qui permet au header de faire la différence entre un professionnel et un utilisateur
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




// @-ChatGPT
if (isset($_POST['day']) || isset($_POST['month']) || isset($_POST['year'])) {
    // Initialisation des variables de filtre
    $day = !empty($_POST['day']) ? str_pad($_POST['day'], 2, '0', STR_PAD_LEFT) : null;
    $month = !empty($_POST['month']) ? str_pad($_POST['month'], 2, '0', STR_PAD_LEFT) : null;
    $year = !empty($_POST['year']) ? $_POST['year'] : null;

    // Construire la date en fonction des valeurs fournies
    $dateFilter = "";
    if ($year) {
        $dateFilter .= $year;
    }
    if ($month) {
        $dateFilter .= ($dateFilter ? '-' : '') . $month;
    }
    if ($day) {
        $dateFilter .= ($dateFilter ? '-' : '') . $day;
    }

    // Préparer la requête SQL en tenant compte des filtres de date
    $sqlAppointment = "SELECT appointment.*, users.user_firstname, users.user_lastname 
    FROM appointment JOIN users ON users.id = appointment.user_id WHERE appointment.doctor_id = :doctor_id";

    if ($dateFilter) {
        $sqlAppointment .= " AND DATE(appointment.appointment_datetime) LIKE :dateFilter";
    }

    $queryAppointment = $db->prepare($sqlAppointment);
    $queryAppointment->bindValue(':doctor_id', $doctor_id, PDO::PARAM_INT);

    if ($dateFilter) {
        $queryAppointment->bindValue(':dateFilter', "$dateFilter%", PDO::PARAM_STR);
    }

    $queryAppointment->execute();
    $appointments = $queryAppointment->fetchAll();
} else {
    // Requête sans filtre si aucun champ n'est rempli
    $sqlAppointment = "SELECT appointment.*, users.user_firstname, users.user_lastname 
    FROM appointment JOIN users ON users.id = appointment.user_id WHERE appointment.doctor_id = :doctor_id";

    $queryAppointment = $db->prepare($sqlAppointment);
    $queryAppointment->bindValue(':doctor_id', $doctor_id, PDO::PARAM_INT);
    $queryAppointment->execute();
    $appointments = $queryAppointment->fetchAll();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/fonts.css">
    <title>Doctor - Quoi de neuf Doc ?</title>
</head>
<body>
    
    <!-- Header -->
<?php 
    require_once "gestions/header.php";
?>


<main class="profil-section">
    <section>

<!-- CARTE PROFIL DOCTEUR -->
        <figure class="doctor-card">
            <div class="doc-img-profil">
                <img class="img-doc" src="<?= !empty($doctor['doc_image']) ? 'assets/images/profiles_doctors/' . htmlspecialchars($doctor['doc_image']) : 'assets/images/profiles_doctors/doctor-img-notfound.png'; ?>" alt="doc img">
            </div>
            <figcaption>
                <div class="doc-name">
                    <span>Profile</span>
                    <h1>Dr. <?= $doctor['first_name'].' '. $doctor['last_name']?></h1>
                    <h2><?= $doctor['professional_type'].'<br>'. $doctor['specialization']?></h2>

                    <div class="gender-doc">
                        <p>Genre :
                            <?php 
                                if ($doctor['gender'] === 'H') {
                                    echo 'Homme';
                                } elseif ($doctor['gender'] === 'F') {
                                    echo 'Femme';
                                } else {
                                    echo 'Non spécifié';
                                }
                            ?>
                        </p>
                        <div>______________</div>
                    </div>
                </div>


                <div class="doc-information">
                    <h3>Horaires et contact:</h3>
                    <div class="infosup-doc">
                        <table class="doc-table-read">
                            <tbody>
                                <tr>
                                    <th class="doc-day-read">Lundi</th>
                                    <td class="doc-hour-read"><?= $doctor['Monday_schedules']?></td>
                                </tr>
                                <tr>
                                    <th class="doc-day-read">Mardi</th>
                                    <td class="doc-hour-read"><?= $doctor['Tuesday_schedules']?></td>
                                </tr>
                                <tr>
                                    <th class="doc-day-read">Mercredi</th>
                                    <td class="doc-hour-read"><?= $doctor['Wednesday_schedules']?></td>
                                </tr>
                                <tr>
                                    <th class="doc-day-read">Jeudi</th>
                                    <td class="doc-hour-read"><?= $doctor['Thursday_schedules']?></td>
                                </tr>
                                <tr>
                                    <th class="doc-day-read">Vendredi</th>
                                    <td class="doc-hour-read"><?= $doctor['Friday_schedules']?></td>
                                </tr>
                                <tr>
                                    <th class="doc-day-read">Samedi</th>
                                    <td class="doc-hour-read"><?= $doctor['Saturday_schedules']?></td>
                                </tr>
                                <tr>
                                    <th class="doc-day-read">Dimanche</th>
                                    <td class="doc-hour-read"><?= $doctor['Sunday_schedules']?></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="infospecial">
                            <!-- GENDER -->
                            <div class="doc-adress">
                                <span class="underline">Adresse:</span>
                                <p class="complet-adress">
                                    <span><?= $doctor['address']?></span>
                                    <span><?= $doctor['department']?></span>
                                    <span><?= $doctor['city']?></span>
                                </p>
                            </div>


                            <!-- PAYMENT METHOD -->
                            <div>
                                <p class="doc-method">mode paiement accepté</p>
                                <span><?php
                                    // Vérifiez si payment_method n'est pas null ou vide
                                    if (!empty($doctor['payment_method'])) {
                                        // Convertir le SET en tableau
                                        $payment_methods = explode(',', $doctor['payment_method']);
                                        
                                        // Parcourir chaque payement_méthode et les afficher sur une nouvelle ligne
                                        foreach ($payment_methods as $method) {
                                            // Remplacer les underscores par des espaces
                                            $formatted_method = str_replace('_', ' ', $method);
                                            echo "<div>$formatted_method</div>";
                                        }
                                    } else {
                                        echo "<div>Aucune information de paiement disponible.</div>"; // Message alternatif si aucune info
                                    }
                                ?></span>
                            </div>

                            <!-- PHONE -->
                            <div class="doc-tel">
                                <p>Tel: <span><?= $doctor['phone']?></span></p>
                            </div>

                            <!-- AVAIBILITY -->
                            <div class="doc-bis">
                                <p>Nouveaux patients: <span><?= ($doctor['availability'] === 'Oui') ? 'Oui' : 'Non' ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="holder-btn-doc">
                    <a class="btn-mod-doctor" href="updateDoc.php?id=<?= htmlspecialchars($doctor['id']) ?>">Modifier</a>
                    <!-- Supprimer son compte / ce mini formulaire gère le message de confirmation + la redirection vers la page de suppressions qui contient la requete DELETE -->
                    <form action="gestions/deleteAccount-pro.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
                        <input type="hidden" name="doctor_id" value="<?= htmlspecialchars($doctor['id']) ?>">
                        <button type="submit" class="btn-delete-account">Supprimer mon compte</button>
                    </form>
                </div>
            </figcaption>
        </figure>
<!-- FIN CARTE PROFIL DOCTEUR -->
</section>


<!-- Alerte de mise a jour réussie -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert success">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>


    <section>
        <div class="user-doctor-appt">
            <h2 class="title-spe">Mes Rendez-vous</h2>
            <div>
            <form method="POST">
                <p class="select-rdv">Filtre:
                    <input class="input-rdv" type="number" min='1' max='31' name="day" placeholder="jour"> 
                    <input class="input-rdv" type="number" min='1' max='12' name="month" placeholder="mois"> 
                    <input class="input-rdv" type="number" min='2024' max='9990' name="year" placeholder="année">
                    <button type="submit">Chercher</button>
                </p>
            </form>
                <a href="search-user.php">Donner un RDV</a>
            </div>
            
            <!-- Carte rdv spécialiste -->
            <div class="list-rdv">
                <?php if (count($appointments) === 0): ?>
                    <p class="no-appointment">Aucun rendez-vous pour la date du <?= htmlspecialchars($dateFilter) ?>.</p>
                <?php else: ?>
                <?php foreach ($appointments as $appointment): ?>
                    <div class="my-appt">
                        <div class="info-doctor">
                            <div>
                                <p>Patient : <?= htmlspecialchars($appointment['user_firstname'] . ' ' . $appointment['user_lastname']) ?></p>
                            </div>
                            <span>Rendez-vous</span>
                        </div>

                        <div class="info-appt">
                            <p><span><?= date('d-m-Y', strtotime($appointment['appointment_datetime'])) ?></span> à <span><?= date('H:i', strtotime($appointment['appointment_datetime'])) ?></span></p>
                            <p class="all-info-doc">
                                <span>Note:</span>
                                <p class="info-doc"><?= htmlspecialchars($appointment['note_info']) ?></p>
                            </p>
                        </div>
                        <form action="gestions/delete-appointment.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');">
                            <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
                            <button type="submit" class="btn-supr-appt">Annuler RDV</button>
                        </form>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </section>


</main>


    


<!-- FOOTER -->
<?php 
    include_once "gestions/footer.php";
?>

    <script src="javascript/script.js"></script>
</body>
</html>