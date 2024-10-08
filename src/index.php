<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/fonts.css">
    <title>Quoi de neuf Doc ?</title>
</head>
<body>
    
    <header>
        <img class="logo-site" src="assets/images/logo/logoQDND.png" alt="Logo_quoi-de-neuf-doc">
        <img src="assets/icones/burgermenu.png" height="40px" alt="burger-menu">
    </header>

    <main>
        <!-- /* INTRO HOMEPAGE */ -->
        <article>
            <section class="homepage-intro">
                <img class="intro-model01" src="assets/images/medecins-model01.jpg" alt="img-medecins-model">
                <div class="line-tr1">
                    <div class="line-op1">
                        <h2>Mon professionnel de la santé. . .</h2>
                    </div>
                </div>

                <div class="line-tr2">
                    <div class="line-op2">
                        <h2>. . .près de chez moi ♥</h2>
                    </div>
                </div>
                <button>Chercher</button>
            </section>
            
            <!-- Format L-XL -->
            <section class="homepage-intro-L">
                    <div class="title-display">
                        <h2>Trouver un professionnel de la santé <br> près de chez soi</h2>
                        <button>Chercher</button>
                    </div>
            </section>


            <!-- /* PRESENTATION HOMEPAGE */ -->
            <section class="homepage-presentation">
                <div class="hp-text">
                    <div class="logo-title">
                        <h1>Quoi de neuf <span class="red-span">Doc ?</span></h1>
                        <img class="logo-doc" src="assets/images/logo/medecin-simple2.png" alt="logo-doctor">
                    </div>
                    <p>Bienvenue sur notre site, votre partenaire santé de proximité. Trouver un professionnel de santé peut être stressant, c'est pourquoi nous avons conçu un espace chaleureux et intuitif pour vous guider à chaque étape.</p>
                    <p>Que vous recherchiez un médecin, un spécialiste, un dentiste ou un autre professionnel de la santé, nous vous aidons à localiser rapidement les praticiens proches de chez vous, disponibles selon vos besoins, avec une attention particulière à leur spécialisation, leurs horaires et leur disponibilité.</p>
                    <p>Ici, la simplicité et la bienveillance sont au cœur de votre expérience.</p>
                </div>

                <div class="homepage-slider">
                    <img src="assets/images/slider1.jpg" alt="img1-slider-genoux">
                </div>
                <!-- Format L-XL -->
                <div class="homepage-gallery">
                    <img class="img-gallery1" src="assets/images/slider1.jpg" alt="img1-slider-genoux">
                    <img class="img-gallery2" src="assets/images/slider4.png" alt="img1-slider-genoux">
                    <img class="img-gallery3" src="assets/images/slider2-b.png" alt="img1-slider-genoux">
                </div>
            </section>
        </article>


        <!-- /* SEARCH HOMEPAGE */ -->
        <section class="homepage-search">
            <div class="intro-search">
                <h3> Ma <span class="red-span">Région</span> :</h3>
            </div>

            <form class="regions-form" action="" method="GET">
                <select name="regions" id="regions-select">
                    <option value="">Liste régions:</option>
                    <option value="auvergne-rhone-alpes">Auvergne-Rhône-Alpes</option>
                    <option value="bourgogne-franche-comte">Bourgogne-Franche-Comté</option>
                    <option value="bretagne">Bretagne</option>
                    <option value="centre-val-de-loire">Centre-Val de Loire</option>
                    <option value="corse">Corse</option>
                    <option value="grand est">Grand Est</option>
                    <option value="hauts-de-france">Hauts-de-France</option>
                    <option value="ile-de-france">Île-de-France</option>
                    <option value="normandie">Normandie</option>
                    <option value="nouvelle-aquitaine">Nouvelle-Aquitaine</option>
                    <option value="occitanie">Occitanie</option>
                    <option value="pays-de-la-loire">Pays de la Loire</option>
                    <option value="provence-alpes-cote-azur">Provence-Alpes-Côte d'Azur</option>
                </select>

                <button>Envoyer</button>
            </form>
        </section>


        <!-- /*CONTACT HOMEPAGE*/ -->
        <section class="homepage-form">
            <div class="title-form">
                <h4>Une idée à nous <span class="red-span">partager</span> ? Écrivez-nous via le formulaire de contact <br> ci-dessous :</h4>
            </div>

            <form class="full-form" action="">
                <div class="form-input">
                    <span>Nom :</span>
                    <input type="text" placeholder="Entrer votre nom">
                </div>
                <div class="form-input">
                    <span>Prénom :</span>
                    <input type="text" placeholder="Entrer votre prenom">
                </div>
                <div class="form-input">
                    <span>eMail :</span>
                    <input type="mail" placeholder="Entrer votre eMail">
                </div>
                <div class="form-input">
                    <span>Sujet :</span>
                    <input type="text" placeholder="Décriver votre sujet">
                </div>
                <div class="form-input">
                    <span>Nom :</span>
                    <textarea id="text-area" name="text-area" rows="10" placeholder="Entrer votre message..."></textarea>
                </div>

                <button>Envoyer votre message</button>
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