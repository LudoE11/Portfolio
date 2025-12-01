<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone'] ?? 'Non fourni');
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Destinataire
    $to = "ludovic.ertzer@orange.fr";
    
    // Sujet de l'email
    $email_subject = "Portfolio Contact: " . $subject;
    
    // Corps de l'email
    $email_body = "Nom: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Téléphone: $phone\n";
    $email_body .= "Sujet: $subject\n\n";
    $email_body .= "Message:\n$message\n\n";
    $email_body .= "---\nEnvoyé depuis le portfolio le " . date('d/m/Y H:i');
    
    // En-têtes
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Envoi de l'email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo json_encode(['success' => true, 'message' => 'Message envoyé avec succès !']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'envoi.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
}
?>