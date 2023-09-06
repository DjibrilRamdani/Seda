<?php
$file = 'archive_message.xml';

if (file_exists($file)) {
    // Désactivez la mise en cache du navigateur
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Spécifiez les entêtes pour le téléchargement du fichier
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Content-Length: ' . filesize($file));

    // Lisez et envoyez le contenu du fichier
    readfile($file);
    exit;
} else {
    echo "Le fichier n'existe pas.";
}
?>
