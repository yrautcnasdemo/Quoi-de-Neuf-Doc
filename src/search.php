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
        <section class="search-filter">
            <form class="search-doctor-form" action="GET">
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
                    <p>Choisisser une spécialisation :</p>
                    <input type="text" placeholder="ex: Allergologue">
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

                <div class="style-search">
                    <p>Nom :</p>
                    <input type="text" placeholder="ex: Ortega">
                </div>

                <div class="style-search">
                    <p>Prénom :</p>
                    <input type="text" placeholder="ex: Nicolas">
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