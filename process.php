<?php
session_start();
require_once 'ArchiveTransfer.php';

if(isset($_POST['submit']) && isset($_FILES['file'])) {
    // Votre logique d'authentification et d'autorisation ici

    $fileName = $_FILES['file']['name'];
    $fileTemp = $_FILES['file']['tmp_name'];

    // Génération du fichier XML SEDA
    $xml = generateSEDAFile($fileName, $fileTemp, $_POST['metadata']);

    // Enregistrement du fichier XML SEDA
    $archiveFileName = 'archive_message.xml';
    $xml->asXML($archiveFileName);

    // Stockage du message de réussite dans une variable de session
    $_SESSION['archive_message'] = "L'export au format SEDA a été effectué et le fichier XML a été créé.";

    // Redirection vers index.php avec les résultats affichés
    header('Location: index.php');
    exit();
}

function generateSEDAFile($fileName, $fileTemp, $selectedMetadata) {
    // Logique de génération du fichier XML SEDA
    // ...
    // Retourne l'objet SimpleXMLElement représentant le fichier XML SEDA
}
?>
