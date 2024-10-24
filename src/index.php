<?php 
    //On vérifie si le formulaire a était envoyé
    if(!empty($_POST)) {
        //Le formulaire a été envoyé
        //On vérifie que TOUS les champs requis EXISTE et sont REMPLIS
        if(isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["role"], $_POST["pass1"], $_POST["pass2"])
        && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["role"]) && !empty($_POST["pass1"]) && !empty($_POST["pass2"])) {
            
            

            //On récupère les données en les protégeant (on empêche l'injection de code HTML ou JS dans les inputs)
            $nom = strip_tags($_POST["nom"]);
            $prenom = strip_tags($_POST["prenom"]);
            $email = strip_tags($_POST["email"]);



            //On vérifie si l'adresse email n'en ai pas une "!filter_var" (si ce n'est pas) si c'est le cas on redirige vers une page d'erreur
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                header("Location: /errors/errorsmail.php?error=invalid_email"); //redirection vers une page d'erreur
                exit(); //On quite le script
            }


            //On récupère les Mots de passes en les protégeant également
            $pass1 = strip_tags($_POST["pass1"]);
            $pass2 = strip_tags($_POST["pass2"]);

            //On vérifie si les 2 mots de passes correspondent
            if ($pass1 !== $pass2) {
                header("Location: /errors/errorspass.php?error=password_mismatch"); // redirection vers une page d'erreur
                exit();
            }


            //On va hasher le mot de passe pour le sécuriser dans la BDD
            $pass = password_hash($_POST["pass1"], PASSWORD_ARGON2I);
            
            
            
            
            //On se connecte a la BDD pour enregistrer nos données
            require_once "connexion.php";
            
            //on enregistre "role" dans une variable pour vérifier si nous n'avons pas de doublons dans les adresses mails dans... 
            //...la table doctors ET users
            $role = $_POST["role"];
            $requete_email = $db->prepare("SELECT COUNT(*) FROM doctors WHERE email = :email UNION SELECT COUNT(*) FROM users WHERE user_mail = :email");
            $requete_email->bindParam(':email', $email);
            $requete_email->execute();
            $counts = $requete_email->fetchAll(PDO::FETCH_COLUMN); // Récupérer le résultat sous forme de tableau

            // Vérification si l'email existe déjà
            if ($counts[0] > 0 || $counts[1] > 0) {
                header("Location: /errors/errorsmail.php?error=email_exists");
                exit();
            } else {
                // Insérer les données dans la base de données
                if ($role == 'professional') {
                    $sql = $db->prepare("INSERT INTO doctors (last_name, first_name, email, password) VALUES (:nom, :prenom, :email, :pass)");
                } else {
                    $sql = $db->prepare("INSERT INTO users (user_lastname, user_firstname, user_mail, user_password) VALUES (:nom, :prenom, :email, :pass)");
                }

                // On bind les paramètres
                $sql->bindParam(':nom', $nom);
                $sql->bindParam(':prenom', $prenom);
                $sql->bindParam(':email', $email);
                $sql->bindParam(':pass', $pass);

                // On exécute la requête d'insertion
                $sql->execute();
                
                // Redirection ou message de succès
                //header("Location: about.php"); // Redirection vers une page de succès
                exit(); // On quitte le script
            }



            //Vérification adresse mail unique dans mes tables "doctors" ET "users"



        //Le formulaire est complet , sinon => else
        } else {
            die ("Le formulaire est incomplet");
        }
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
    <title>Quoi de neuf Doc ?</title>
</head>
<body>
    
    <header>
        <!-- Header-with-burgerMenu -->
        <div class="header-s">
            <img class="logo-site" src="assets/images/logo/logoQDND.png" alt="Logo_quoi-de-neuf-doc">
            <div>
                <button class="btn-tr"><img class="menu-burger" src="assets/icones/burgermenu.png" height="40px" alt="burger-menu"></button>
            </div>
        </div>
        <!-- Burger navigation -->
        <div class="nav-burger">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="about.php">A propos</a></li>
                <li><a href="#">Contact</a></li>
                <li><a class="user-profile-btn" href="userProfil.php">Mon Profile</a></li>
                <!-- <li><a class="doc-profile-btn" href="docProfil.php">Mon Profile2</a></li> -->
                <li><a class="connexion-btn" href="#" role="button" data-target="#modal" data-toggle="modal"><div class="btn-style-bgm"><span>Connexion</span></div></a>
                <li><a class="connexion-btn" href="#" role="button" data-target="#modal" data-toggle="modal"><div class="btn-style-bgm"><span>Déconnexion</span></div></a>
                </li>
            </ul>
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
            <div class="login-pro">
                <a class="user-profile-btn" href="userProfil.php">Mon Profile</a>
                <a class="doc-profile-btn" href="docProfil.php">Mon Profile2</a>
                <a class="connexion-btn" href="#" role="button" data-target="#modal" data-toggle="modal"><div class="btn-style"><div class="btn-style-c"><div class="btn-style-c2"></div></div><span>Connexion</span></div></a>
                <a class="connexion-btn" href="#" role="button" data-target="#modal" data-toggle="modal"><div class="btn-style"><div class="btn-style-c"><div class="btn-style-c2"></div></div><span>Déconnexion</span></div></a>
            </div>
        </div>
    </header>

    <!-- MODAL Login-->
    <div class="modal" id="modal" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-close" data-dismiss="dialog"><button class="btn-close-modal">X</button></div>
            </div>
            <div class="modal-title">
                <p>Connexion</p>
            </div>
            <form action="" method="POST">
                <div class="section-form-register">
                    <div class="info-modal">
                        <span>eMail</span>
                        <input type="email" name="email" required>
                    </div>
                    <div class="info-modal">
                        <span>Mot de passe</span>
                        <input type="password" name="pass" required>
                    </div>
                    <button class="btn-log">Valider</button>
                    <div class="modal-footer">
                        <p>Pas de compte ? <a href="#" role="button" data-target="#modal2" data-dismiss="dialog" data-toggle="modal">Créer un compte</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL Register-->
    <div class="modal" id="modal2" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-close" data-dismiss="dialog"><button class="btn-close-modal">X</button></div>
            </div>
            <div class="modal-title">
                <p>Enregistrement</p>
            </div>
            <form method="POST">
                <div class="section-form-register">
                    <div class="info-modal">
                        <span>Nom</span>
                        <input type="text" name="nom" required>
                    </div>
                    <div class="info-modal">
                        <span>Prénom</span>
                        <input type="text" name="prenom" required>
                    </div>
                    <div class="info-modal">
                        <span>eMail</span>
                        <input type="email" name="email" required>
                    </div>
                </div>
                <div class="info-modal-select">
                    <label for="">Êtes vous :</label>
                    <select name="role" id="" required>
                        <option value="professional">Un profesionnel de la santé</option>
                        <option value="user">Un utilisateur</option>
                    </select>
                </div>
                <div class="section-form-register">
                    <div class="info-modal">
                        <span>Mot de passe</span>
                        <input type="password" name="pass1" required>
                    </div>
                    <div class="info-modal">
                        <span>Confirmation Mot de passe</span>
                        <input type="password" name="pass2" required>
                    </div>
                    <button class="btn-log" type="submit">Valider</button>
                    <div class="modal-footer">
                        <p>Vous possédez déjà un compte ? <a href="#" role="button" data-target="#modal" data-dismiss="dialog" data-toggle="modal">Se connecter</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>



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
                    <img class="img-gallery1" src="assets/images/slider1F.png" alt="img1-slider-genoux">
                    <img class="img-gallery2" src="assets/images/slider3F.png" alt="img1-slider-genoux">
                    <img class="img-gallery3" src="assets/images/slider2F.png" alt="img1-slider-genoux">
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

        <section class="homepage-search-L">
            <div class="interractive-intro">
                <h3>Selectionner votre <span class="red-span">région</span> :</h3>
                <p>En sélectionnant votre région sur notre carte interactive, vous aurez accès à une liste complète de tous les professionnels de santé à proximité de chez vous, incluant médecins, spécialistes, dentistes, et bien d'autres. Vous pourrez non seulement visualiser les praticiens disponibles dans votre région, mais aussi obtenir des informations précises sur leurs horaires, spécialités et jours de garde. De plus, pour répondre au mieux à vos besoins, vous aurez la possibilité d'affiner cette recherche en fonction de critères spécifiques, tels que la spécialisation recherchée ou la disponibilité des professionnels. Tout est conçu pour vous offrir une expérience simple et efficace, directement depuis votre écran.</p>
            </div>
            <form action="">
                <!-- Image Map Generated by http://www.image-map.net/ -->
                <img src="assets/images/carte-france-regions.png" usemap="#image-map">

                <map name="image-map">
                    <area target="_blank" alt="Bretagne" title="Bretagne" href="bretagne" coords="51,185,64,185,79,188,86,196,96,201,111,204,125,195,135,193,147,187,150,173,151,162,143,161,137,152,128,153,116,151,106,151,96,153,90,142,74,142,62,146,54,147,41,147,36,156,36,167,41,177" shape="poly">
                    <area target="_blank" alt="Normandie" title="Normandie" href="normandie" coords="146,104,154,124,179,124,196,120,194,110,205,102,223,95,231,90,243,103,240,112,240,127,233,141,231,150,220,151,211,155,213,162,210,169,211,176,199,170,195,162,185,167,179,158,162,164,150,160,143,160,137,153,140,145,138,132,135,121,130,117,130,106" shape="poly">
                    <area target="_blank" alt="Hauts-de-France" title="Hauts-de-France" href="hauts-de-france" coords="233,90,239,84,238,50,265,41,274,55,283,54,287,63,295,66,299,72,306,75,314,79,314,88,319,94,319,101,315,108,314,119,303,121,304,130,303,139,297,143,288,140,287,129,278,134,267,133,242,129,243,110,242,98" shape="poly">
                    <area target="_blank" alt="Grand-Est" title="Grand-Est" href="grand-est" coords="320,93,329,90,338,83,340,99,362,111,372,112,384,112,398,123,409,126,423,124,431,129,448,134,436,153,436,162,431,175,431,185,429,195,428,202,423,208,415,202,413,191,406,189,393,186,382,184,376,186,371,191,370,198,361,199,355,203,347,198,346,190,340,184,329,186,312,187,309,178,302,174,296,166,296,158,303,155,296,148,304,139,305,121,314,119,316,107" shape="poly">
                    <area target="_blank" alt="Ile-de-France" title="Ile-de-France" href="ile-de-france" coords="281,178,263,181,264,177,263,170,251,173,248,165,239,155,235,141,241,130,276,135,285,132,287,141,293,144,300,153,293,167,286,169" shape="poly">
                    <area target="_blank" alt="Pays-de-la-Loire" title="Pays-de-la-Loire" href="pays-de-la-loire" coords="166,262,157,233,166,232,172,227,181,229,188,226,193,206,203,202,213,190,212,178,199,171,196,164,188,167,178,160,164,164,154,162,152,184,146,194,140,192,132,196,126,197,119,199,120,204,104,210,108,217,116,225,119,232,116,238,124,254,135,261,144,266,159,265" shape="poly">
                    <area target="_blank" alt="Centre-val-de-Loire" title="Centre-val-de-Loire" href="centre-val-de-loire" coords="214,156,215,164,213,170,215,189,206,202,195,206,190,226,194,236,204,234,224,262,261,262,271,253,281,245,287,231,280,221,281,208,279,199,284,193,287,185,280,179,263,182,262,173,251,174,247,166,239,156,236,145,232,152,221,152" shape="poly">
                    <area target="_blank" alt="Nouvelle-Aquitaine" title="Nouvelle-Aquitaine" href="nouvelle-aquitaine" coords="145,267,147,280,142,292,157,314,146,306,140,338,147,345,138,348,130,396,120,407,132,412,129,420,135,420,148,425,154,431,163,434,172,422,177,415,177,402,170,395,171,383,179,378,195,377,207,374,210,364,215,351,226,340,230,331,237,330,243,334,253,331,262,312,266,295,262,290,269,285,260,265,225,264,203,237,193,238,189,229,160,234,168,260,168,266,157,268" shape="poly">
                    <area target="_blank" alt="Occitanie" title="Occitanie" href="occitanie" coords="167,432,174,440,183,439,198,440,204,432,220,437,233,442,240,446,246,453,260,454,270,456,285,451,283,429,292,416,301,414,322,398,327,404,339,392,343,381,342,375,338,366,330,362,325,363,318,360,312,341,305,338,299,338,295,333,288,335,281,345,274,336,265,347,256,346,252,335,242,334,234,330,229,335,226,340,220,346,215,350,216,358,212,362,210,368,210,374,201,376,194,377,186,378,181,380,173,383,173,391,176,397,179,405,180,411,173,420" shape="poly">
                    <area target="_blank" alt="Provence-alpes-cote-d-azur" title="Provence-alpes-cote-d-azur" href="provence-alpes-cote-d-azur" coords="343,365,346,374,349,380,345,384,342,391,337,402,345,404,355,404,367,407,376,414,392,416,409,412,413,402,426,395,441,385,447,366,434,368,423,362,416,353,416,346,420,338,411,330,407,322,396,320,398,335,383,335,378,343,370,356,377,363,372,369,361,362" shape="poly">
                    <area target="_blank" alt="Auvergne-rhone-alpes" title="Auvergne-rhone-alpes" href="auvergne-rhone-alpes" coords="285,244,263,264,271,286,265,289,267,298,255,332,256,340,266,341,275,331,282,338,296,329,310,336,316,347,321,357,328,359,337,359,350,359,359,358,372,368,375,362,368,354,379,338,391,334,397,332,394,320,405,318,423,312,419,297,412,288,418,280,409,271,408,262,395,264,389,272,378,273,386,261,375,265,368,266,358,258,349,258,344,270,337,267,329,268,324,274,314,268,318,259,309,255,307,247,299,251,291,249" shape="poly">
                    <area target="_blank" alt="Bourgogne-franche-comte" title="Bourgogne-franche-comte" href="bourgogne-franche-comte" coords="295,167,288,169,283,176,288,184,282,197,282,206,281,217,287,228,285,242,295,246,306,244,310,250,319,257,316,265,325,270,332,264,341,266,347,258,357,255,368,263,379,260,386,259,394,244,395,232,415,213,416,205,412,192,382,185,372,192,371,199,359,201,346,196,344,190,338,184,313,186,308,177" shape="poly">
                    <area target="_blank" alt="Corse" title="Corse" href="corse" coords="450,402,450,415,429,424,427,437,437,469,450,474,454,468,457,451,460,441,457,422" shape="poly">
                </map>
            </form>
        </section>
            

        <!-- /*CONTACT HOMEPAGE*/ -->
        <section class="homepage-form">
            <div class="title-form">
                <h4>Une idée à nous <span class="red-span">partager</span> ?</h4>
                <p>Écrivez-nous via le formulaire de contact ci-dessous :</p>
            </div>

            <form class="full-form" action="POST">
                <div class="part-all">
                    <div class="part1">
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
                    </div>
                    
                    <div class="part2">
                        <div class="form-input">
                            <span>Sujet :</span>
                            <input type="text" placeholder="Décriver votre sujet">
                        </div>
                        <div class="form-input">
                            <span>Nom :</span>
                            <textarea id="text-area" name="text-area" rows="10" placeholder="Entrer votre message..."></textarea>
                        </div>
                    </div>
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