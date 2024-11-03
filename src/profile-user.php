<?php
    session_start();

    require_once("gestions/tools.php"); //Fonction qui permet au header de faire la différence entre un professionnel et un utilisateur
    require_once "connexion.php";

    // Vérification si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $query = $db->prepare("SELECT * FROM users WHERE id = :id");

        $query->bindValue(":id", $user_id, PDO::PARAM_INT);
        $query->execute();
        $user_info = $query->fetch();

    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
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
            <h2 class="title-spe">Mes Spécialistes</h2>

            <div class="doctor-cards">
                <form action="">
                    <figure class="doctor-card">
                        <div class="doc-img-profil">
                            <img src="assets/images/profiles/profile06.png" alt="img-profil-doctor">
                        </div>
                        <figcaption>
                            <div class="doc-name">
                                <span>Profile</span>
                                <h1>Dr. Jane Doe</h1>
                                <h2>ORL</h2>
                            </div>
                            <div class="doc-information">
                                <h3>Horraires et contact:</h3>
                                <p>Horraires d'ouverture</p>
                                <p>
                                    08h00-12h00 <br> 
                                    13h30-19h00 <br> 
                                    Du lundi au vendredi
                                </p>
                            </div>
                            <div class="doc-adress">
                                <span>Adresse:</span>
                                <p class="complet-adress">13 rue Crystal Lake, 58470 Magny-cours, 20eme étage porte 616-bis, près des doc</p>
                                <div class="doc-tel">Tel: <span>555-2368</span></div>
                            </div>
                            <div class="doc-bis">
                                <p>Disponibilité pour de nouveaux patients: <span>Oui</span></p>
                            </div>
                            <button class="btn-supr-doc">Retirer ce spécialiste de ma liste</button>
                        </figcaption>
                    </figure>
                </form>


                <form action="">
                    <figure class="doctor-card">
                        <div class="doc-img-profil">
                            <img src="assets/images/profiles/profile06.png" alt="img-profil-doctor">
                        </div>
                        <figcaption>
                            <div class="doc-name">
                                <span>Profile</span>
                                <h1>Dr. Jane Doe</h1>
                                <h2>ORL</h2>
                            </div>
                            <div class="doc-information">
                                <h3>Horraires et contact:</h3>
                                <p>Horraires d'ouverture</p>
                                <p>
                                    08h00-12h00 <br> 
                                    13h30-19h00 <br> 
                                    Du lundi au vendredi
                                </p>
                            </div>
                            <div class="doc-adress">
                                <span>Adresse:</span>
                                <p class="complet-adress">13 rue Crystal Lake, 58470 Magny-cours, 20eme étage porte 616-bis, près des doc</p>
                                <div class="doc-tel">Tel: <span>555-2368</span></div>
                            </div>
                            <div class="doc-bis">
                                <p>Disponibilité pour de nouveaux patients: <span>Oui</span></p>
                            </div>
                            <button class="btn-supr-doc">Retirer ce spécialiste de ma liste</button>
                        </figcaption>
                    </figure>
                </form>


                <form action="">
                    <figure class="doctor-card">
                        <div class="doc-img-profil">
                            <img src="assets/images/profiles/profile06.png" alt="img-profil-doctor">
                        </div>
                        <figcaption>
                            <div class="doc-name">
                                <span>Profile</span>
                                <h1>Dr. Jane Doe</h1>
                                <h2>ORL</h2>
                            </div>
                            <div class="doc-information">
                                <h3>Horraires et contact:</h3>
                                <p>Horraires d'ouverture</p>
                                <p>
                                    08h00-12h00 <br> 
                                    13h30-19h00 <br> 
                                    Du lundi au vendredi
                                </p>
                            </div>
                            <div class="doc-adress">
                                <span>Adresse:</span>
                                <p class="complet-adress">13 rue Crystal Lake, 58470 Magny-cours, 20eme étage porte 616-bis, près des doc</p>
                                <div class="doc-tel">Tel: <span>555-2368</span></div>
                            </div>
                            <div class="doc-bis">
                                <p>Disponibilité pour de nouveaux patients: <span>Oui</span></p>
                            </div>
                            <button class="btn-supr-doc">Retirer ce spécialiste de ma liste</button>
                        </figcaption>
                    </figure>
                </form>
            </div>
        </div>
    </section>



    <!-- MY APPOINTEMENTS -->
    <section>
        <div class="user-doctor-appt">
            <h2 class="title-spe">Mes Rendez-vous</h2>
            
            <div class="list-rdv">
                <!-- appointements card -->
                <form class="my-appt">
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
                </form>

                <form class="my-appt">
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
                </form>

                <form class="my-appt">
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
                </form>

                <form class="my-appt">
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
                </form>
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