<?php
session_start();
require_once "connexion.php"; 

// Section UPDATE
if ($_POST) {
    if (isset($_POST['id'], $_POST['phone'], $_POST['department']) && 
        !empty($_POST['id']) && !empty($_POST['phone']) && !empty($_POST['department'])) {
        
        // Connexion à la base de données
        $id = strip_tags($_POST['id']);
        $phone = strip_tags($_POST['phone']);
        $department = strip_tags($_POST['department']);

        // Vérification si l'ID correspond à celui de la session
        if ($id != $_SESSION['doctor_id']) {
            echo "Accès non autorisé";
            exit();
        }

        // Requête SQL pour la mise à jour
        $sql = "UPDATE doctors SET phone = :phone, department = :department WHERE id = :id";
        $query = $db->prepare($sql);
        
        // Bind des paramètres
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":phone", $phone, PDO::PARAM_STR);
        $query->bindValue(":department", $department, PDO::PARAM_STR);

        // Exécution de la requête
        if ($query->execute()) {
            // Message de succès, redirection ou autre action
            $_SESSION['success'] = "Mise à jour réussie";
            header("Location: docProfil.php?id=$id"); // Redirection vers le profil
            exit();
        } else {
            $_SESSION['erreur'] = "Erreur lors de la mise à jour. Veuillez réessayer.";
        }
    } else {
        $_SESSION['erreur'] = "Formulaire incomplet.";
    }
}

// Section READ
if (isset($_SESSION['doctor_id'])) {
    $doctor_id = $_SESSION['doctor_id'];

    // Vérifier si l'ID dans l'URL correspond à l'ID dans la session
    if (!isset($_GET['id']) || $_GET['id'] != $doctor_id) {
        echo "Accès non autorisé";
        exit();
    }

    $sql = "SELECT * FROM doctors WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(":id", $doctor_id, PDO::PARAM_INT);
    $query->execute();
    $doctor = $query->fetch(PDO::FETCH_ASSOC);
    
    // Vérifier si le docteur existe
    if (!$doctor) {
        echo "Aucun médecin trouvé pour cet ID.";
        exit();
    }
} else {
    // Si la session de la personne a expiré ou si elle a fermé son compte
    header("Location: index.php");
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
                    <h1><?= $doctor['first_name'].' // '.$doctor['last_name'] ?></h1>
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
                                <input type="text" placeholder="58470" id="department" name="department" value="<?= $doctor['department']?>"> <!--On rajoute valeur pour UPDATE-->
                            </div>
                            <div>
                                <span>Ma ville:</span>
                                <input type="text" placeholder="Magny-Cours">
                            </div>
                            <div>
                                <span>Mon Telephone:</span>
                                <input type="text" placeholder="0620124574" id="phone" name="phone" value="<?= $doctor["phone"]?>"> <!--On rajoute valeur pour UPDATE-->
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
                        <input type="hidden" value="<?= $doctor["id"]?>" name="id">
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