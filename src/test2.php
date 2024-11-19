<?php
    session_start();
// Gestion des compte pour le Header afin d'afficher le "btn" profile user OU docteur et le btn déconnexion
    function userLogin() {
        return isset($_SESSION['user_id']);
    }
    
    function doctorLogin() {
        return isset($_SESSION['doctor_id']);
    }



    //On se connecte a la BDD pour enregistrer nos données
    require_once "connexion.php";

    //On vérifie si le formulaire a était envoyé
    if(!empty($_POST)) {
        //Ici on selectionne le bon formulaire (le formulaire register) pour faire les vérifications d'usage
        if (isset($_POST['form_type']) && $_POST['form_type'] === 'register') {
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
            $pass = password_hash($_POST["pass1"], PASSWORD_ARGON2ID);





            
            //VERIFICATION DES ADRESSE MAIL EN DOUBLON DANS LES 2 TABLES USER ET DOCTORS
            //on enregistre "role" dans une variable pour vérifier si nous n'avons pas de doublons dans les adresses mails dans... 
            //...la table doctors ET users
            $role = $_POST["role"];
            // on verifie le nombre d'email dans chaque table
            $requete_doctor = $db->prepare("SELECT COUNT(*) FROM doctors WHERE email = :email");
            $requete_user = $db->prepare("SELECT COUNT(*) FROM users WHERE user_mail = :email");

            // on execute les 2 requetes
            $requete_doctor->execute([':email' => $email]);
            $requete_user->execute([':email' => $email]);

            // récupération des résultas
            $doctor_count = $requete_doctor->fetchColumn();
            $user_count = $requete_user->fetchColumn();

            // et ici on vérifie si le mail existe ou pas 
            if ($doctor_count > 0 || $user_count > 0) {
                header("Location: /errors/errorsmail2.php?error=email_exists");
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
                
            }
            

        //Le formulaire est complet , sinon => else
        } else {
            die ("Le formulaire est incomplet");
        }
    }

    // Ici on selectionne l'autre formulaire (le formulaire login)
    elseif (isset($_POST['form_type']) && $_POST['form_type'] === "login") {
    
    // On connecte l'utilisateur ou le médecin
    // On vérifie que tous les champs ont été remplis et on sécurise les injections HTML
        if (isset($_POST["email1"], $_POST['pass']) && !empty($_POST['email1']) && !empty($_POST["pass"])) {
            
            // On vérifie si le mail rentré est bien un email
            if (!filter_var($_POST['email1'], FILTER_VALIDATE_EMAIL)) {
                header("Location: /errors/errorsmail3.php?error=invalid_email");
                exit();
            }

            // Connexion à la base de données
            require_once "connexion.php";

            // Vérification dans la table doctors
            $query_doctor = $db->prepare("SELECT * FROM doctors WHERE email = :email1");
            $query_doctor->bindValue(":email1", $_POST["email1"], PDO::PARAM_STR);
            $query_doctor->execute();
            $doctor = $query_doctor->fetch();

            // Vérification dans la table users
            $query_user = $db->prepare("SELECT * FROM users WHERE user_mail = :email1");
            $query_user->bindValue(":email1", $_POST["email1"], PDO::PARAM_STR);
            $query_user->execute();
            $user = $query_user->fetch();

            // Vérification du mot de passe pour les médecins
            if ($doctor && password_verify($_POST['pass'], $doctor['password'])) {
                // Connexion réussie pour médecin

                $_SESSION['doctor_id'] = $doctor['id']; // Stocke l'ID du médecin dans la session
                // Redirection vers la page de profil ou tableau de bord
                header("Location: /profile-doctor.php");
                exit();
            } 
            // Vérification du mot de passe pour les utilisateurs
            elseif ($user && password_verify($_POST['pass'], $user['user_password'])) {
                // Connexion réussie pour utilisateur

                $_SESSION['user_id'] = $user['id']; // Stocke l'ID de l'utilisateur dans la session
                // Redirection vers la page de profil ou tableau de bord
                header("Location: /profile-user.php");
                exit();
            } else {
                header("Location: /errors/errorspass.php?error=invalid_credentials");
                exit();
            }

        } else {
            // Si les champs ne sont pas remplis
            header("Location: /errors/errorspass.php?error=empty_fields");
            exit();
        }
    }
}
?>