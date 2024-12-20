<?php
    session_start();

    require_once("gestions/tools.php"); //Fonction qui permet au header de faire la différence entre un professionnel et un utilisateur
    require_once "connexion.php";

    // Vérification si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        //récuperation des données de l'utilisateur pour affichage
        $query = $db->prepare("SELECT * FROM users WHERE id = :id");

        $query->bindValue(":id", $user_id, PDO::PARAM_INT);
        $query->execute();
        $user_info = $query->fetch();


        //récuperation des données des favories de l'utilisateur pour affichage et jointure des tables doctor, favorites et users
        $sql = "SELECT doctors.* FROM doctors JOIN favorites ON doctors.id = favorites.doctor_id WHERE favorites.user_id = :user_id";
        $favoritesQuery = $db->prepare($sql);
        $favoritesQuery->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $favoritesQuery->execute();
        $favorites = $favoritesQuery->fetchAll();

        //JOINTURE DE TABLE 
        //récuperation des données de appoitment de l'utilisateur pour affichage (ici on ne récupère pas tout dans la table doctor, uniquement doctors.first_name, doctors.last_name, doctors.specialization, doctors.professional_type)
        $sqlAppointment = "SELECT appointment.*, doctors.first_name, doctors.last_name, doctors.specialization, doctors.professional_type FROM appointment JOIN doctors ON doctors.id = appointment.doctor_id WHERE appointment.user_id = :user_id";

        $appointmentQuery = $db->prepare($sqlAppointment);
        $appointmentQuery->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $appointmentQuery->execute();
        $appointmentResult = $appointmentQuery->fetchAll();

    } else {
        //redirection si utilisateur non connecté
        header("Location: /login.php");
        exit();
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
    <title>User - Quoi de neuf Doc ?</title>
</head>
<body>
    
    <!-- Header -->
<?php 
    require_once "gestions/header.php";
?>


<main class="profil-section">
    <!-- MY PROFIL -->
    <section>
        <figure class="user-card">
            <!-- Chemin de l'image depuis la BDD attention au path !! -->
            <img class="img-user" src="<?= !empty($user_info['user_image']) ? 'assets/images/profiles/' . htmlspecialchars($user_info['user_image']) : 'assets/images/profiles/userimgnotfound.png'; ?>" alt="user img">
            <figcaption>
                <h1><?= $user_info['user_firstname'].' '.$user_info['user_lastname'] ?></h1>
                <div>
                    <div class="adress-user-main">
                        <span>Adresse:</span>
                        <p><?= $user_info['user_address'] ?></p>
                        <p><?= $user_info['user_department'].' - '.$user_info['user_city'] ?></p>
                    </div>
                    <div class="pm-user">
                        <p>Telephone: <?= $user_info['user_phone'] ?></p>
                        <p>eMail: <?= $user_info['user_mail'] ?></p>
                    </div>
                </div>
                <a class="btn-mod-doctor" href="updateUser.php?id=<?= htmlspecialchars($user_info['id']) ?>">Modifier</a>
                <form action="gestions/deleteAccount-user.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                    <button type="submit" class="btn-delete-account">Supprimer mon compte</button>
                </form>
            </figcaption>
        </figure>
    </section>



    <!-- MY DOCTORS -->
    <section>
        <div class="user-doctor">
            <h2 class="title-spe">Mes professionnels de la santé</h2>

            <div class="doctor-cards">

            <?php if ($favorites): ?>
                <?php foreach ($favorites as $doctor): ?>
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
                                            <p>Nouveaux patients: <span><?= $doctor['availability'] ? 'Oui' : 'Non' ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="holder-btn-doc">
                                <form action="gestions/delete-favorites.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer se médecin de vos favoris ?');">
                                    <input type="hidden" name="doctor_id" value="<?= htmlspecialchars($doctor['id']) ?>">
                                    <button type="submit" class="btn-delete-account">Supprimer de mes favoris</button>
                                </form>
                            </div>
                        </figcaption>
                    </figure>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="add-pro">
                    <p>Vous n'avez aucun médecin en favori.</p>
                    <a href="search.php">Ajouter</a>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </section>



    <!-- MY APPOINTEMENTS -->
    <section>
        <div class="user-doctor-appt">
            <h2 class="title-spe">Mes Rendez-vous</h2>
            
            <div class="list-rdv">
                <!-- appointments cards -->
                
                <?php if ($appointmentResult): ?>
                    <?php foreach ($appointmentResult as $appointment): ?>
                        <div class="my-appt">
                            <div class="info-doctor">
                                <div>
                                    <p>Dr. <?= htmlspecialchars($appointment['first_name'].' '.$appointment['last_name']) ?></p>
                                </div>
                                <span><?= ($appointment['professional_type'].' '.$appointment['specialization']) ?></span> 
                            </div>
                            
                            <div class="info-appt">
                            <?php
                                // On crée une variable date pour stocker la date du rendez-vous
                                $date = new DateTime($appointment['appointment_datetime']);
                                // On modifie le format de la date pour avoir jour-mois-année 
                                $dateformat = $date->format('d-m-Y à H\hi');
                            ?>
                            <p><?= $dateformat ?></p>
                                <p class="all-info-doc">
                                    <span>Note:</span>
                                    <p class="info-doc"><?= $appointment['note_info'] ?></p>
                                </p>
                            </div>
                            <form action="gestions/delete-appointment.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');">
                                <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
                                <button type="submit" class="btn-supr-appt">Annuler RDV</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="add-pro">
                        <p>Vous n'avez aucun rendez-vous de prévu.</p>
                    </div>
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