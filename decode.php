<?php
echo '<html><head><link rel="stylesheet" href="decode.css"></head><body><div class="container">';

$typeMetadata = isset($_GET['typeMetadata']) ? $_GET['typeMetadata'] : "";

$fileName = isset($_GET['file']) ? $_GET['file'] : "";
if ($typeMetadata !== "" && $fileName !== "") {

    switch ($typeMetadata) {
        case "descriptive":
            $fileName = 'D:\wamp64\www\TestSEDA\Descriptive_Metadata\\' . $fileName;
            break;
        case "management":
            $fileName = 'D:/wamp64/www/TestSEDA/Management_Metadata/' . $fileName;
            break;
        case "technical":
            $fileName = 'D:/wamp64/www/TestSEDA/Technical_Metadata/' . $fileName;
            break;
        case "transfer":
            $fileName = 'D:/wamp64/www/TestSEDA/Transfer_Metadata/' . $fileName;
            break;
        default:
            $fileName = "";
    }
}

if ($fileName !== "") {
    if (file_exists($fileName)) {
        $xmlContent = file_get_contents($fileName);
        $xml = new SimpleXMLElement($xmlContent);

        $metadataType = $xml->ArchiveUnit->metadataType;

        switch ($metadataType) {
            case "descriptive":
                echo "Titre : " . $xml->ArchiveUnit->Titre . "<br>";
                echo "Description : " . $xml->ArchiveUnit->Description . "<br>";
                echo "Couverture : " . $xml->ArchiveUnit->Couverture . "<br>";
                echo "Mot clé : " . $xml->ArchiveUnit->MotCleDescriptive . "<br>";
                echo "Nom de l'agent : " . $xml->ArchiveUnit->NomAgent . "<br>";
                echo "Type de document : " . $xml->ArchiveUnit->TypeDoc . "<br>";
                echo "Profil d'archive : " . $xml->ArchiveUnit->ProfileArchive . "<br>";
                echo "Type de référence : " . $xml->ArchiveUnit->TypeRef . "<br>";
                echo "Référence cible : " . $xml->ArchiveUnit->CibleRef . "<br>";
                break;
            case "management":
                echo "Code de la règle d'accès : " . $xml->ArchiveUnit->AccessRuleCode . "<br>";
                echo "Code de la règle d'évaluation : " . $xml->ArchiveUnit->AppraisalRuleCode . "<br>";
                echo "Niveau de classification : " . $xml->ArchiveUnit->NiveauClassification . "<br>";
                echo "Propriétaire de la classification : " . $xml->ArchiveUnit->ProprioClass . "<br>";
                echo "Code du profil d'archive : " . $xml->ArchiveUnit->ArchivalProfileCode . "<br>";
                echo "Code du niveau de service : " . $xml->ArchiveUnit->ServiceLevelCode . "<br>";
                echo "Code de la règle de diffusion : " . $xml->ArchiveUnit->DisseminationRuleCode . "<br>";
                echo "Code de la règle de stockage : " . $xml->ArchiveUnit->StorageRuleCode . "<br>";
                echo "Code de la règle de réutilisation : " . $xml->ArchiveUnit->ReuseRuleCode . "<br>";
                echo "Mot clé : " . $xml->ArchiveUnit->MotCleManagment . "<br>";
                break;
            case "technical":
                echo "Titre : " . $xml->ArchiveUnit->TitreTechn . "<br>";
                echo "Format du fichier : " . $xml->ArchiveUnit->FormatFichier . "<br>";
                echo "Taille du fichier : " . $xml->ArchiveUnit->TailleFichier . "<br>";
                echo "Date de création : " . $xml->ArchiveUnit->DateCreation . "<br>";
                echo "Mot clé : " . $xml->ArchiveUnit->MotCleTechnical . "<br>";
                break;
            case "transfer":
                echo "Agence de transfert : " . $xml->ArchiveUnit->AgenceTransfert . "<br>";
                echo "Accord d'archivage : " . $xml->ArchiveUnit->AccordArchivage . "<br>";
                echo "Version de la liste de codes : " . $xml->ArchiveUnit->CodeListVersions . "<br>";
                echo "Mot clé : " . $xml->ArchiveUnit->MotCle . "<br>";
                break;
            default:
                echo "Type de métadonnées inconnu: " . $metadataType;
        }
    } else {
        echo "Le fichier " . $fileName . " n'existe pas.";
    }
} else {
    echo "Aucun fichier spécifié.";
}
echo '<br><a href="index.php">Retour à la page d\'accueil</a>';

?>
