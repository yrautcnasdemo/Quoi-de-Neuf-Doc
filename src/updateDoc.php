<?php
session_start();
require_once "connexion.php"; 

// Section UPDATE = Mix CREAT & READ 

//CREAT modifié
if ($_POST) {
    if (isset($_POST['id'], $_POST['phone'], $_POST['department'], $_POST['gender'], $_POST['city'], $_POST['address'], $_POST['professional_type'], $_POST['specialization'], $_POST['Monday_schedules'], $_POST['Tuesday_schedules'], $_POST['Wednesday_schedules'], $_POST['Thursday_schedules'], $_POST['Friday_schedules'], $_POST['Saturday_schedules'], $_POST['Sunday_schedules'], $_POST['availability'], $_POST['payment_method']) && 
        !empty($_POST['id']) && !empty($_POST['phone']) && !empty($_POST['department']) && !empty($_POST['gender']) && !empty($_POST['city']) && !empty($_POST['address']) && !empty($_POST['professional_type']) && !empty($_POST['specialization']) && !empty($_POST['Monday_schedules']) && !empty($_POST['Tuesday_schedules']) && !empty($_POST['Wednesday_schedules']) && !empty($_POST['Thursday_schedules']) && !empty($_POST['Friday_schedules']) && !empty($_POST['Saturday_schedules']) && !empty($_POST['Sunday_schedules']) && !empty($_POST['availability'])) {
        
        // Connexion à la base de données
        $id = strip_tags($_POST['id']);
        $gender = strip_tags($_POST['gender']);
        $phone = strip_tags($_POST['phone']);
        $department = strip_tags($_POST['department']);
        $city = strip_tags($_POST['city']);
        $address = strip_tags($_POST['address']);
        $professional_type = strip_tags($_POST['professional_type']);
        $specialization = strip_tags($_POST['specialization']);
        $Monday_schedules = strip_tags($_POST['Monday_schedules']);
        $Tuesday_schedules = strip_tags($_POST['Tuesday_schedules']);
        $Wednesday_schedules = strip_tags($_POST['Wednesday_schedules']);
        $Thursday_schedules = strip_tags($_POST['Thursday_schedules']);
        $Friday_schedules = strip_tags($_POST['Friday_schedules']);
        $Saturday_schedules = strip_tags($_POST['Saturday_schedules']);
        $Sunday_schedules = strip_tags($_POST['Sunday_schedules']);
        $availability = strip_tags($_POST['availability']);

        // Gestion methode de paiement
        if (isset($_POST['payment_method'])) {
            $payment_methods = $_POST['payment_method'];
            $payment_methods_str = implode(',', $payment_methods); // Concatene les valeurs avec des virgules
        } else {
            $payment_methods_str = ''; // Aucune méthode sélectionnée
        }


        // Vérification si l'ID correspond à celui de la session
        if ($id != $_SESSION['doctor_id']) {
            echo "Accès non autorisé";
            exit();
        }




        // Gestion de l'image de profil
        $doctor_image = null;
        if (!empty($_FILES['profile_image_doc']['name'])) {
            // Limite de taille à 500 Ko
            if ($_FILES['profile_image_doc']['size'] > 500000) { // 500000 octets = 500 Ko
                $_SESSION['erreur'] = "L'image ne doit pas dépasser 500 Ko.";
                header("Location: updateDoc.php?id=$id"); // Redirection vers la page de mise à jour
                exit();
            }

            $upload_dir = 'assets/images/profiles_doctors/';
            // Obtenir l'extension du fichier
            $imageFileType = strtolower(pathinfo($_FILES['profile_image_doc']['name'], PATHINFO_EXTENSION));
            // Générez un nom de fichier unique
            $unique_name = uniqid("doc_", true) . "." . $imageFileType;

            // Vérifier le type d'image
            $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($imageFileType, $valid_extensions)) {
                // Déplacez le fichier téléchargé
                if (move_uploaded_file($_FILES['profile_image_doc']['tmp_name'], $upload_dir . $unique_name)) {
                    $doctor_image = $unique_name; // NE PAS METTRE LE CHEMIN COMPLET DE L'IMAGE UPLOADÉ
                } else {
                    $_SESSION['erreur'] = "Erreur lors de l'upload de l'image.";
                }
            } else {
                $_SESSION['erreur'] = "Type de fichier non valide. Veuillez télécharger une image.";
            }
        }




        // Requête SQL pour la mise à jour
        $sql = "UPDATE doctors SET phone = :phone, department = :department, gender = :gender, city = :city, address = :address, professional_type = :professional_type, specialization = :specialization, Monday_schedules = :Monday_schedules, Tuesday_schedules = :Tuesday_schedules, Wednesday_schedules = :Wednesday_schedules, Thursday_schedules = :Thursday_schedules, Friday_schedules = :Friday_schedules, Saturday_schedules = :Saturday_schedules, Sunday_schedules = :Sunday_schedules, availability = :availability, payment_method = :payment_method" . ($doctor_image ? ", doc_image = :doc_image" : "") . " WHERE id = :id";
        $query = $db->prepare($sql);
        
        // Bind des paramètres
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":gender", $gender, PDO::PARAM_STR);
        $query->bindValue(":phone", $phone, PDO::PARAM_STR);
        $query->bindValue(":department", $department, PDO::PARAM_INT);
        $query->bindValue(":city", $city, PDO::PARAM_STR);
        $query->bindValue(":address", $address, PDO::PARAM_STR);
        $query->bindValue(":professional_type", $professional_type, PDO::PARAM_STR);
        $query->bindValue(":specialization", $specialization, PDO::PARAM_STR);
        $query->bindValue(":Monday_schedules", $Monday_schedules, PDO::PARAM_STR);
        $query->bindValue(":Tuesday_schedules", $Tuesday_schedules, PDO::PARAM_STR);
        $query->bindValue(":Wednesday_schedules", $Wednesday_schedules, PDO::PARAM_STR);
        $query->bindValue(":Thursday_schedules", $Thursday_schedules, PDO::PARAM_STR);
        $query->bindValue(":Friday_schedules", $Friday_schedules, PDO::PARAM_STR);
        $query->bindValue(":Saturday_schedules", $Saturday_schedules, PDO::PARAM_STR);
        $query->bindValue(":Sunday_schedules", $Sunday_schedules, PDO::PARAM_STR);
        $query->bindValue(":availability", $availability, PDO::PARAM_STR);
        $query->bindValue(":payment_method", $payment_methods_str, PDO::PARAM_STR);
        if ($doctor_image) {
            $query->bindValue(":doc_image", $doctor_image, PDO::PARAM_STR);
        }



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
        <form class="form-update-user" method="POST" enctype="multipart/form-data">
            <figure class="user-card-update">
                <div class="img-box">
                    <img class="img-update" src="assets/images/profiles_doctors/<?= !empty($doctor['doc_image']) ? htmlspecialchars($doctor['doc_image']) : 'doctor-img-notfound.png' ?>" alt="My-Profil-pics">
                    <input type="file" name="profile_image_doc" class="upload-btn-img">
                </div>
            <figcaption>
                    <h1><?= $doctor['first_name'].' '.$doctor['last_name'] ?></h1>
                    <div class="selector-dispo">
                        <span>Genre :</span>
                        <select name="gender" id="gender">
                            <option value="H" <?= ($doctor['gender'] == 'H') ? 'selected' : '' ?>>Homme</option>
                            <option value="F" <?= ($doctor['gender'] == 'F') ? 'selected' : '' ?>>Femme</option>
                        </select>
                    </div>
                        <div class="adress-user">
                            <div>
                                <select name="professional_type" id="professional_type" class="pro-type-doc">
                                    <option value="Generaliste" <?= ($doctor['professional_type'] == 'Generaliste') ? 'selected' : '' ?>>Médecin généraliste</option>
                                    <option value="Specialiste" <?= ($doctor['professional_type'] == 'Specialiste') ? 'selected' : '' ?>>Spécialiste</option>
                                    <option value="Dentiste" <?= ($doctor['professional_type'] == 'Dentiste') ? 'selected' : '' ?>>Dentiste</option>
                                    <option value="Kinesitherapeute" <?= ($doctor['professional_type'] == 'Kinesitherapeute') ? 'selected' : '' ?>>Kinésithérapeute</option>
                                </select>
                                <span>Spécialisation / DIU :</span>
                                <input type="text" placeholder="ORL" name="specialization" id="specialization" value="<?= $doctor['specialization']?>">
                            </div>
                            <div class="input-hours">
                                <span></span>
                                <table class="doc-table">
                                    <caption class="caption-doc">
                                        Jours / Horraires:
                                    </caption>
                                    <tbody>
                                        <tr>
                                            <th class="doc-day">Lundi</th>
                                            <td class="doc-hour"><input type="text" id="Monday_schedules" name="Monday_schedules" value="<?= $doctor['Monday_schedules']?>"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Mardi</th>
                                            <td class="doc-hour"><input type="text" id="Tuesday_schedules" name="Tuesday_schedules" value="<?= $doctor['Tuesday_schedules']?>"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Mercredi</th>
                                            <td class="doc-hour"><input type="text" id="Wednesday_schedules" name="Wednesday_schedules" value="<?= $doctor['Wednesday_schedules']?>"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Jeudi</th>
                                            <td class="doc-hour"><input type="text" id="Thursday_schedules" name="Thursday_schedules" value="<?= $doctor['Thursday_schedules']?>"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Vendredi</th>
                                            <td class="doc-hour"><input type="text" id="Friday_schedules" name="Friday_schedules" value="<?= $doctor['Friday_schedules']?>"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Samedi</th>
                                            <td class="doc-hour"><input type="text" id="Saturday_schedules" name="Saturday_schedules" value="<?= $doctor['Saturday_schedules']?>"></td>
                                        </tr>
                                        <tr>
                                            <th class="doc-day">Dimanche</th>
                                            <td class="doc-hour"><input type="text" id="Sunday_schedules" name="Sunday_schedules" value="<?= $doctor['Sunday_schedules']?>"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <span>Adresse:</span>
                                <input type="text" placeholder="01 la chaume contant" id="address" name="address" value="<?= $doctor['address'] ?>">
                            </div>
                            <div>
                                <span>Mon code postal:</span>
                                <input type="text" placeholder="58470" id="department" name="department" value="<?= $doctor['department']?>"> <!--On rajoute valeur pour UPDATE-->
                            </div>
                            <div>
                                <span>Ma ville:</span>
                                <input type="text" placeholder="Magny-Cours" id="city" name="city" value="<?= $doctor['city'] ?>">
                            </div>
                            <div>
                                <span>Mon Telephone:</span>
                                <input type="text" placeholder="0620124574" id="phone" name="phone" value="<?= $doctor["phone"]?>"> <!--On rajoute valeur pour UPDATE-->
                            </div>
                            <div class="selector-dispo">
                                <span>Disponibilité:</span>
                                <select id="availability" name="availability">
                                    <option value="Oui" <?= ($doctor['availability'] == 'Oui') ? 'selected' : '' ?>>Oui</option>
                                    <option value="Non" <?= ($doctor['availability'] == 'Non') ? 'selected' : '' ?>>Non</option>
                                </select>
                            </div>
                            <div class="">
                                <p>Type de réglement</p>
                                <div class="doc-billing-update">
                                    <div>
                                    <input type="checkbox" id="carte-bancaire" name="payment_method[]" value="Carte_Bancaire" <?= (!empty($doctor['payment_method']) && strpos($doctor['payment_method'], 'Carte_Bancaire') !== false) ? 'checked' : '' ?>>
                                    <label for="carte-bancaire">Carte bancaire</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="cheque" name="payment_method[]" value="Cheque" <?= (!empty($doctor['payment_method']) && strpos($doctor['payment_method'], 'Cheque') !== false) ? 'checked' : '' ?>>
                                        <label for="cheque">Chèque</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="espece" name="payment_method[]" value="Especes" <?= (!empty($doctor['payment_method']) && strpos($doctor['payment_method'], 'Especes') !== false) ? 'checked' : '' ?>>
                                        <label for="espece">Espèces</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="tiers-payant" name="payment_method[]" value="Tiers_payant" <?= (!empty($doctor['payment_method']) && strpos($doctor['payment_method'], 'Tiers_payant') !== false) ? 'checked' : '' ?>>
                                        <label for="tiers-payant">Tiers payant</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" value="<?= $doctor["id"]?>" name="id">
                        <button type="submit" class="btn-mod-user">Valider</button>
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