<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonts.css">
    <title>Quoi de neuf Doc ?</title>
</head>
<body>
    
    <header>
        <img class="logo-site" src="assets/images/logo/logoQDND.png" alt="Logo_quoi-de-neuf-doc">
        <img src="assets/icones/burgermenu.png" height="40px" alt="burger-menu">
    </header>

    <main>
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

            <section class="homepage-presentation">
                <div class="logo-title">
                    <h1>Quoi de <br> neuf <span class="red-span">Doc ?</span></h1>
                    <img class="logo-doc" src="assets/images/logo/medecin-simple2.png" width="56px" alt="logo-doctor">
                </div>
                <p>Bienvenue sur notre site, votre partenaire santé de proximité. Trouver un professionnel de santé peut être stressant, c'est pourquoi nous avons conçu un espace chaleureux et intuitif pour vous guider à chaque étape.</p>
                <p>Que vous recherchiez un médecin, un spécialiste, un dentiste ou un autre professionnel de la santé, nous vous aidons à localiser rapidement les praticiens proches de chez vous, disponibles selon vos besoins, avec une attention particulière à leur spécialisation, leurs horaires et leur disponibilité.</p>
                <p>Ici, la simplicité et la bienveillance sont au cœur de votre expérience.</p>

                <div class="homepage-slider">
                    <img src="assets/images/slider1.jpg" alt="img1-slider-genoux">
                </div>
            </section>
        </article>

        <section class="homepage-search">
            <div class="intro-search">
                <h3> Ma <span class="red-span">Région</span> :</h3>
            </div>

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


        </section>
    </main>

    <script src="javascript/script.js"></script>
</body>
</html>