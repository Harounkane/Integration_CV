<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure PHPMailer
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    // Assurez-vous que les données sont valides
    if (!$email || !$nom || !$prenom || !$message) {
        echo "Veuillez remplir tous les champs correctement.";
        exit;
    }

    try {
        // Créer une instance de PHPMailer
        $mail = new PHPMailer(true);
        
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.mail.yahoo.com'; // Serveur SMTP Yahoo
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hkane532@@yahoo.com'; // Remplacez par votre adresse Yahoo
        $mail->Password   = 'fomlfldkwswisnpj'; // Utilisez un mot de passe d'application si nécessaire
        $mail->SMTPSecure = 'ssl'; // SSL pour Yahoo
        $mail->Port       = 465; // Port SMTP pour SSL

        // Configuration des destinataires
        $mail->setFrom('votreemail@yahoo.com', $nom . ' ' . $prenom); // Adresse de l'expéditeur
        $mail->addAddress('votreadresse@example.com'); // Adresse de réception des messages

        // Contenu de l'email
        $mail->isHTML(false); // Envoyer en texte brut
        $mail->Subject = 'Nouveau message de ' . $nom . ' ' . $prenom;
        $mail->Body    = "Nom: " . $nom . "\nPrénom: " . $prenom . "\nEmail: " . $email . "\n\nMessage:\n" . $message;

        // Envoi de l'email
        $mail->send();
        echo 'Le message a bien été envoyé';
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi du message : {$mail->ErrorInfo}";
    }
}
?>

