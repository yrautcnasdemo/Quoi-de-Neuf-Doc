<?php
session_start();

require_once("gestions/tools.php"); //Fonction qui permet au header de faire la différence entre un professionnel et un utilisateur
require_once "connexion.php"; 

// Section UPDATE = Mix CREAT & READ 

// CREAT modifié
if ($_POST) {
    if (isset($_POST['id'], $_POST['user_phone'], $_POST['user_department'], $_POST['user_city'], $_POST['user_address'], $_POST['user_mail']) && 
        !empty($_POST['id']) && !empty($_POST['user_phone']) && !empty($_POST['user_department']) && !empty($_POST['user_city']) && !empty($_POST['user_address']) && !empty($_POST['user_mail'])) {
        
        // Connexion à la base de données
        $id = strip_tags($_POST['id']);
        $user_phone = strip_tags($_POST['user_phone']);
        $user_department = strip_tags($_POST['user_department']);
        $user_city = strip_tags($_POST['user_city']);
        $user_address = strip_tags($_POST['user_address']);
        $user_mail = strip_tags($_POST['user_mail']);

        
        // Vérification si l'ID correspond à celui de la session
        if ($id != $_SESSION['user_id']) {
            echo "Accès non autorisé";
            exit();
        }


        // Gestion de l'image de profil
        $user_image = null;
        if (!empty($_FILES['profile_image']['name'])) {
            // Limite de taille à 500 Ko
            if ($_FILES['profile_image']['size'] > 500000) { // 500000 octets = 500 Ko
                $_SESSION['erreur'] = "L'image ne doit pas dépasser 500 Ko.";
                header("Location: updateUser.php?id=$id"); // Redirection vers la page de mise à jour
                exit();
            }

            $upload_dir = 'assets/images/profiles/';
            // Obtenez l'extension du fichier
            $imageFileType = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            // Générez un nom de fichier unique
            $unique_name = uniqid("user_", true) . "." . $imageFileType;

            // Vérifier le type d'image
            $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($imageFileType, $valid_extensions)) {
                // Déplacez le fichier téléchargé
                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_dir . $unique_name)) {
                    $user_image = $unique_name; // Chemin de l'image uploadée
                } else {
                    $_SESSION['erreur'] = "Erreur lors de l'upload de l'image.";
                }
            } else {
                $_SESSION['erreur'] = "Type de fichier non valide. Veuillez télécharger une image.";
            }
        }


        // Requête SQL pour la mise à jour
        $sql = "UPDATE users SET user_phone = :user_phone, user_department = :user_department, user_city = :user_city, user_address = :user_address, user_mail = :user_mail" . ($user_image ? ", user_image = :user_image" : "") . " WHERE id = :id";
        $query = $db->prepare($sql);
        
        
        // Bind des paramètres
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":user_phone", $user_phone, PDO::PARAM_STR);
        $query->bindValue(":user_department", $user_department, PDO::PARAM_INT);
        $query->bindValue(":user_city", $user_city, PDO::PARAM_STR);
        $query->bindValue(":user_address", $user_address, PDO::PARAM_STR);
        $query->bindValue(":user_mail", $user_mail, PDO::PARAM_STR);
        if ($user_image) {
            $query->bindValue(":user_image", $user_image, PDO::PARAM_STR);
        }


        // Exécution de la requête
        if ($query->execute()) {
            // Message de succes et redirection
            $_SESSION['success'] = "Mise à jour réussie";
            header("Location: profile-user.php?id=$id"); // Redirection vers le profile
            exit();
        } else {
            $_SESSION['erreur'] = "Erreur lors de la mise à jour. Veuillez réessayer.";
        }
    } else {
        $_SESSION['erreur'] = "Formulaire incomplet.";
    }
}



// Section READ
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Vérifier si l'ID dans l'URL correspond à l'ID dans la session
    if (!isset($_GET['id']) || $_GET['id'] != $user_id) {
        echo "Accès non autorisé";
        exit();
    }

    $sql = "SELECT * FROM users WHERE id = :id";

    $query = $db->prepare($sql);
    $query->bindValue(":id", $user_id, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    
    // Vérifier si l'utilisateur existe
    if (!$user) {
        echo "Aucun utilisateur trouvé pour cet ID.";
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
    
    <!-- Header -->
    <?php 
        require_once "gestions/header.php";
    ?>


    <section class="update-user">
    
    <!-- UPDATE CARD USER -->
        <form class="form-update-user" method="POST" enctype="multipart/form-data"> <!-- Le enctype="multipart/form-data" permet l'ajout de fichier image -->
            <figure class="user-card-update">
                <div class="img-box">
                    <img class="img-update" src="assets/images/profiles/<?= !empty($user['user_image']) ? htmlspecialchars($user['user_image']) : 'user-img-notfound.png' ?>" alt="My-pics-Profil">
                    <input type="file" name="profile_image" class="upload-btn-img">
                </div>
            <figcaption>
                    <h1><?= $user["user_firstname"].' '.$user["user_lastname"] ?></h1>
                        <div class="adress-user">
                            <div>
                                <span>Adresse:</span>
                                <input type="text" placeholder="01 la chaume contant" id="user_address" name="user_address" value="<?=$user["user_address"]?>">
                            </div>
                            <div>
                                <span>Mon code postal:</span>
                                <input type="text" placeholder="58470" id="user_department" name="user_department" value="<?=$user["user_department"]?>">
                            </div>
                            <div>
                                <span>Ma ville:</span>
                                <input type="text" placeholder="Magny-Cours" id="user_city" name="user_city" value="<?=$user["user_city"]?>">
                            </div>
                            <div>
                                <span>Mon Telephone:</span>
                                <input type="text" placeholder="0620124574" id="user_phone" name="user_phone" value="<?=$user["user_phone"]?>">
                            </div>
                            <div>
                                <span>eMail:</span>
                                <input type="text" placeholder="user@mail.com" id="user_mail" name="user_mail" value="<?=$user["user_mail"]?>">
                            </div>
                        </div>
                        <input type="hidden" value="<?= $user["id"]?>" name="id">
                        <button type="submit" class="btn-mod-user">Valider</button>
                </figcaption>
            </figure>
        </form>
    <!-- END -->

    </section>


<!-- FOOTER -->
<?php 
    include_once "gestions/footer.php";
?>

    <script src="javascript/script.js"></script>
</body>
</html>