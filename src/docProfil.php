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


<main class="profil-section">
    <section>
        <figure class="doctor-card">
                <div class="doc-img-profil">
                    <img src="assets/images/profiles/profile06.png" alt="img-profil-doctor">
                </div>
                <figcaption>
                    <div class="doc-name">
                        <span>Profile</span>
                        <h1>Dr. Jane Doe</h1>
                        <h2>Spécialiste</h2>
                        
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
                    <div class="doc-bis2">
                        <p>Disponibilité pour de nouveaux patients: <span>Oui</span></p>
                    </div>
                    <a class="btn-mod-doctor" href="updateDoc.php">Modifier</a>
                </figcaption>
            </figure>
    </section>


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