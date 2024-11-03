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
                    <h3>Horraires et contact:</h3>
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
            
            <!-- Carte rdv spécialiste -->
            <div class="list-rdv">
                <div class="my-appt">
                    <div class="info-doctor">
                        <div>
                            <p>Docteur: Dr. Jane Doe</p>
                        </div>
                        <span>Médecin généraliste</span> 
                    </div>
                    
                    <div class="info-appt">
                        <p><span>13/02/2025</span> a <span>14h00</span></p>
                        <p>
                            <span>Note:</span>
                            <p>Ne pas oublier de rapporter les radios de votre jambe droite ainsi que votre carte santé, et soyez bien a l'heure</p>
                        </p>
                    </div>
                    <button class="btn-supr-appt">Annuler RDV</button>
                </div>

                <div class="my-appt">
                    <div class="info-doctor">
                        <div>
                            <p>Docteur: Dr. Jane Doe</p>
                        </div>
                        <span>Médecin généraliste</span> 
                    </div>
                    
                    <div class="info-appt">
                        <p><span>13/02/2025</span> a <span>14h00</span></p>
                        <p>
                            <span>Note:</span>
                            <p>Ne pas oublier de rapporter les radios de votre jambe droite ainsi que votre carte santé, et soyez bien a l'heure</p>
                        </p>
                    </div>
                    <button class="btn-supr-appt">Annuler RDV</button>
                </div>

                <div class="my-appt">
                    <div class="info-doctor">
                        <div>
                            <p>Docteur: Dr. Jane Doe</p>
                        </div>
                        <span>Médecin généraliste</span> 
                    </div>
                    
                    <div class="info-appt">
                        <p><span>13/02/2025</span> a <span>14h00</span></p>
                        <p>
                            <span>Note:</span>
                            <p>Ne pas oublier de rapporter les radios de votre jambe droite ainsi que votre carte santé, et soyez bien a l'heure</p>
                        </p>
                    </div>
                    <button class="btn-supr-appt">Annuler RDV</button>
                </div>

                <div class="my-appt">
                    <div class="info-doctor">
                        <div>
                            <p>Docteur: Dr. Jane Doe</p>
                        </div>
                        <span>Médecin généraliste</span> 
                    </div>
                    
                    <div class="info-appt">
                        <p><span>13/02/2025</span> a <span>14h00</span></p>
                        <p>
                            <span>Note:</span>
                            <p>Ne pas oublier de rapporter les radios de votre jambe droite ainsi que votre carte santé, et soyez bien a l'heure</p>
                        </p>
                    </div>
                    <button class="btn-supr-appt">Annuler RDV</button>
                </div>
                
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