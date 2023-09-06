<?php
$files = [
    'management_metadata.xml',
    'descriptive_metadata.xml',
    'technical_metadata.xml',
    'transfer_metadata.xml'
];

$file_to_load = $_GET['file']; // Get the filename from the URL

// Check if the provided file name is in the allowed list
if (!in_array($file_to_load, $files)) {
    exit('Fichier non autorisé.');
}

if (file_exists($file_to_load)) {
    $xml = simplexml_load_file($file_to_load);

    echo "<h2>Les détails de l'archive pour le fichier " . $file_to_load . "</h2>";

    // Iterate over the ArchiveUnit elements in the XML
    foreach($xml->ArchiveUnit as $metadata) {
        // Management metadata
        if ($file_to_load == 'management_metadata.xml') {
            // Display the metadata fields
            // (replace these with the actual fields in your XML)
            echo "<p><strong>Titre :</strong> " . $metadata->Titre . "</p>";
            echo "<p><strong>Description :</strong> " . $metadata->Description . "</p>";
            // Add more fields as needed
        }

        // Descriptive metadata
        elseif ($file_to_load == 'descriptive_metadata.xml') {
            // Display the metadata fields
            // (replace these with the actual fields in your XML)
            echo "<p><strong>Titre :</strong> " . $metadata->Titre . "</p>";
            echo "<p><strong>Description :</strong> " . $metadata->Description . "</p>";
            // Add more fields as needed
        }

        // Technical metadata
        elseif ($file_to_load == 'technical_metadata.xml') {
            // Display the metadata fields
            // (replace these with the actual fields in your XML)
            echo "<p><strong>Titre :</strong> " . $metadata->Titre . "</p>";
            echo "<p><strong>Description :</strong> " . $metadata->Description . "</p>";
            // Add more fields as needed
        }

        // Transfer metadata
        elseif ($file_to_load == 'transfer_metadata.xml') {
            // Display the metadata fields
            // (replace these with the actual fields in your XML)
            echo "<p><strong>Titre :</strong> " . $metadata->Titre . "</p>";
            echo "<p><strong>Description :</strong> " . $metadata->Description . "</p>";
            // Add more fields as needed
        }
    }
} else {
    exit('Échec lors de l\'ouverture du fichier ' . $file_to_load . '.');
}
?>
