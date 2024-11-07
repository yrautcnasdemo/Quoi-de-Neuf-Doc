<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $sujet = htmlspecialchars($_POST['sujet']);
    $message = htmlspecialchars($_POST['message']);
    
    // Vérification de l'adresse e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse e-mail invalide.";
        exit;
    }
    
    // Destinataire (adresse e-mail de l'administrateur)
    $to = "quoideneuf@admin.com";
    $subject = "Contact : " . $sujet;
    $body = "Nom : $nom\n";
    $body .= "Prénom : $prenom\n";
    $body .= "Email : $email\n\n";
    $body .= "Message :\n$message";
    $headers = "From: $email";

    // Envoi de l'email
    if (mail($to, $subject, $body, $headers)) {
        echo "Votre message a été envoyé avec succès.";
        // Redirection après l'envoi du message
        header("Location: index.php?message=envoye");
        exit();
    } else {
        echo "Erreur lors de l'envoi du message. Veuillez réessayer plus tard.";
    }
} else {
    // Redirection si la page est accédée sans soumission du formulaire
    header("Location: index.php");
    exit();
}
?>
