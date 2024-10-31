<?php
    session_start();
    require_once "connexion.php"; // Assurez-vous d'inclure votre connexion à la base de données ici

    if (isset($_SESSION['doctor_id'])) {
        $doctor_id = $_SESSION['doctor_id'];

        $sql = "SELECT * FROM doctors";
        $query = $db->prepare($sql);
        $query->execute();
        $doctor = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        die();
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
    <title>Update - Quoi de neuf Doc ?</title>
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
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="about.php">A propos</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <a class="connexion-btn" href=""><div class="btn-style"><div class="btn-style-c"><div class="btn-style-c2"></div></div><span>Connexion</span></div></a>
        </div>
    </header>

    <section class="update-user">
        <form class="form-update-user">
            <figure class="user-card-update">
                <div class="img-box">
                    <img class="img-update" src="assets/images/profiles/678885909dabe1baaaf1aef8f7a73102.png" alt="My-pics-Profil">
                    <button class="upload-btn-img">upload</button>
                </div>
            <figcaption>
                    <h1><?= $doctor['first_name']?></h1>
                    <div class="selector-dispo">
                        <span>Genre :</span>
                        <select name="" id="">
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                    </div>
                        <div class="adress-user">
                            <div>
                                <select name="pro-type" id="" class="pro-type-doc">
                                    <option value="">Médecin généraliste</option>
                                    <option value="">Spécialiste</option>
                                    <option value="">Dentiste</option>
                                    <option value="">Kinésithérapeute</option>
                                </select>
                                <span>Spécialisation / DIU :</span>
                                <input type="text" placeholder="ORL">
                            </div>
                            <div class="input-hours">
                                <span></span>
                                <table class="doc-table">
                                    <caption class="caption-doc">
                                        Jours / Horraires:
                                    </caption>
                                    <tbody class="rere">
                                        <tr>
                                            <th class="doc-day">Lundi</th>
                                            <td class="doc-hour"><input type="text"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Mardi</th>
                                            <td class="doc-hour"><input type="text"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Mercredi</th>
                                            <td class="doc-hour"><input type="text"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Jeudi</th>
                                            <td class="doc-hour"><input type="text"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Vendredi</th>
                                            <td class="doc-hour"><input type="text"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Samedi</th>
                                            <td class="doc-hour"><input type="text"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Dimanche</th>
                                            <td class="doc-hour"><input type="text"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <span>Adresse:</span>
                                <input type="text" placeholder="01 la chaume contant">
                            </div>
                            <div>
                                <span>Mon code postal:</span>
                                <input type="text" placeholder="58470">
                            </div>
                            <div>
                                <span>Ma ville:</span>
                                <input type="text" placeholder="Magny-Cours">
                            </div>
                            <div>
                                <span>Mon Telephone:</span>
                                <input type="text" placeholder="0620124574">
                            </div>
                            <div class="selector-dispo">
                                <span>Disponibilité:</span>
                                <select name="" id="">
                                    <option value="oui">oui</option>
                                    <option value="non">non</option>
                                </select>
                            </div>
                            <div class="">
                                <p>Type de réglement</p>
                                <div class="doc-billing-update">
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
                        </div>
                    <a class="btn-mod-user" href="updateUser.php">Valider</a>
                </figcaption>
            </figure>
        </form>
    </section>


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