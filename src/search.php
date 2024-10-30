<?php
require_once("connexion.php");

//Ma requete SQL
$sql= "SELECT * FROM doctors";

//on prépare la requete
$query = $db->prepare($sql);

//on execute la requete
$query->execute();

//on stock le résulta (le PDO::FETCH_ASSOC) permet de ne pas avoir les résulta en double
$result = $query->fetchAll(PDO::FETCH_ASSOC);

//On ferme la connexion
require_once("deconnexion.php")
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
    
    <header>
        <div class="header-s">
            <img class="logo-site" src="assets/images/logo/logoQDND.png" alt="Logo_quoi-de-neuf-doc">
            <img src="assets/icones/burgermenu.png" height="40px" alt="burger-menu">
        </div>
        <!-- Format header desktop -->
        <div class="header-xl">
            <img class="logo-site" src="assets/images/logo/logoQDND.png" alt="Logo_quoi-de-neuf-doc">
            <nav>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="about.php">A propos</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <a class="connexion-btn" href=""><div class="btn-style"><div class="btn-style-c"><div class="btn-style-c2"></div></div><span>Connexion</span></div></a>
        </div>
    </header>

    <main>
        <!-- SEARCH FILTER -->
        <section class="search-filter">
            <form class="search-doctor-form" action="GET">
                <div class="first-section">
                    <div class="style-search">
                        <p>Tappez votre département :</p>
                        <input type="number" placeholder="ex: 58470">
                    </div>
                    
                    <div class="style-search">
                        <p>Choisissez votre professionnel :</p>
                        <select name="search-spe" id="search-spe">
                            <option value="generaliste">Médecin généraliste</option>
                            <option value="specialiste">Médecin spécialiste </option>
                            <option value="dentiste">Dentiste</option>
                            <option value="pediatre">Pédiatre</option>
                            <option value="Kinesitherapeute">Kinésithérapeute</option>
                        </select>
                    </div>
                    
                    <div class="style-search">
                        <p>Tappez une spécialisation :</p>
                        <input type="text" placeholder="ex: Allergologue">
                    </div>
                </div>
                    
                <div class="billing">
                    <p>Type de réglement</p>
                    <div class="billing-method">
                        <div>
                            <input type="checkbox" id="carte-bancaire" name="" value="carte-bancaire">
                            <label for="carte-bancaire">Carte bancaire</label>
                        </div>
                        <div>
                            <input type="checkbox" id="cheque" name="" value="cheque">
                            <label for="cheque">Chèque</label>
                        </div>
                        <div>
                            <input type="checkbox" id="espece" name="" value="espece">
                            <label for="espece">Espèces</label>
                        </div>
                        <div>
                            <input type="checkbox" id="tiers-payant" name="" value="tiers-payant">
                            <label for="tiers-payant">Tiers payant</label>
                        </div>
                    </div>
                </div>

                <div class="last-section">
                    <div class="style-search">
                        <p>Nom :</p>
                        <input type="text" placeholder="ex: Doe">
                    </div>
                    
                    <div class="style-search">
                        <p>Prénom :</p>
                        <input type="text" placeholder="ex: Jane">
                    </div>
                </div>
                    

                <div class="billing">
                    <p>Choisissez votre médecin</p>
                    <div class="billing-method">
                        <div>
                            <input type="checkbox" id="male" name="" value="male">
                            <label for="male">Homme</label>
                        </div>
                        <div>
                            <input type="checkbox" id="female" name="" value="female">
                            <label for="female">Femme</label>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <!-- DOCOTR CARDS -->
        <section class="doctor-cards">

<!-- ////////////////////// -->
        <?php
            foreach($result as $doctor){
        ?>
            <figure class="doctor-card">
                <div class="doc-img-profil">
                    <img src="assets/images/profiles/profile06.png" alt="img-profil-doctor">
                </div>
                <figcaption>
                    <div class="doc-name">
                        <span>Profile</span>
                        <h1>Dr. <?= $doctor['first_name'].' '. $doctor['last_name']?></h1>
                        <h2><?= $doctor['professional_type'].'<br>'. $doctor['specialization']?></h2>
                    </div>

                    <div class="doc-adress">
                        <span class="underline">Adresse:</span>
                        <p class="complet-adress">
                            <span><?= $doctor['address']?></span>
                            <span><?= $doctor['department']?></span>
                            <span><?= $doctor['city']?></span>
                        </p>
                        <div>______________</div>
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
                                <div class="gender-doc">
                                    <p>Genre : <span>
                                        <?php 
                                            if ($doctor['gender'] === 'H') {
                                                echo 'Homme';
                                            } elseif ($doctor['gender'] === 'F') {
                                                echo 'Femme';
                                            } else {
                                                echo 'Non spécifié';
                                            }
                                        ?>
                                    </span></p>
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
                        <button class="btn-add-doc">Ajouter a mes favoris</button>
                    </div>
                </figcaption>
            </figure>
        <?php
            }
        ?>
            
        </section>
    </main>


    <footer>
    <div class="footer-content">
        <div class="footer-up">
            <div class="footer-about">
                <h3 class="red-span">À propos</h3>
                <p>Notre site vous offre des informations fiables et actualisées sur la santé, avec une équipe de professionnels dédiée à vous informer.</p>
            </div>
            
            <div class="footer-links">
                <h3 class="red-span">Liens utiles</h3>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">A propos</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                </ul>
            </div>
        </div>
            
        <div class="contact-us">
            <h3 class="red-span">Contactez-nous</h3>
            <p>Email : contact@quoi-de-neuf-doc.com</p>
            <p>Téléphone : +1 555-2368</p>
            <p>Adresse : Hook & Ladder 8, 14 North Moore Street, New York, NY 10013, États-Unis</p>
        </div>
    </div>

    <div class="all-right">
        <p>2024 Quoi de neuf Doc ? Tous droits réservés.</p>
    </div>
</footer>

    <script src="javascript/script.js"></script>
</body>
</html>