<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // L'utilisateur a soumis le formulaire, traitez ses sélections ici.
    $selectedMetadata = $_POST['metadata'];
    // $selectedMetadata est maintenant un tableau contenant les types de métadonnées que l'utilisateur a choisis.
    // Ici, vous pouvez ajouter le code pour effectuer l'exportation SEDA en utilisant les types de métadonnées sélectionnés.
}

echo '<h1>Interface de configuration SEDA</h1>';

echo '<h2>Configuration des données à exporter</h2>';

$metadataOptions = array(
    'DescriptiveMetadata' => 'Métadonnées descriptives',
    'ManagementMetadata' => 'Métadonnées de gestion',
    // Ajoutez ici tous les autres types de métadonnées SEDA...
);

echo '<form method="post">';

foreach($metadataOptions as $option => $label) {
    echo '<label><input type="checkbox" name="metadata[]" value="' . $option . '"> ' . $label . '</label><br>';
}

echo '<input type="submit" value="Exporter">';
echo '</form>';
?>
