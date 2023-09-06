<head>
    <link rel="stylesheet" href="archive.css">
</head>

<?php
session_start();

require('descriptive_metadata.php');
require('management_metadata.php');
require('technical_metadata.php');
require('transfer_metadata.php');

require('db_connect.php');

$archiveTransfer = new SimpleXMLElement('<ArchiveTransfer/>');

$xml = new SimpleXMLElement('<ArchiveTransfer></ArchiveTransfer>');
$archiveUnit = $xml->addChild('ArchiveUnit');

if (isset($_POST['submit'])) {
    $docId = uniqid();
    $transferringAgency = isset($_POST['transferringAgency']) ? $_POST['transferringAgency'] : '';
    $archivalAgreement = isset($_POST['archivalAgreement']) ? $_POST['archivalAgreement'] : '';
    $codeListVersions = isset($_POST['codeListVersions']) ? $_POST['codeListVersions'] : '';

    $archiveDirectory = 'D:\wamp64\www\TestSEDA\Fichierarchive';

    if ($_FILES['file']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['file']['tmp_name'])) {
        $archivePath = $archiveDirectory . '/' . $_FILES['file']['name'];
        if (move_uploaded_file($_FILES['file']['tmp_name'], $archivePath)) {
            echo 'Fichier correctement archivé à : ' . $archivePath . '<br>';
            $dataObjectElement = $archiveUnit->addChild('DataObject');
            $dataObjectElement->addChild('URI', $archivePath);
        } else {
            echo 'Erreur lors de l\'archivage du fichier.<br>';
        }
    } else {
        echo 'Erreur  pas de fichier importé.<br>';
    }
}
if ($_POST['metadata'] == 'descriptive') {
    // Récupérer les valeurs du formulaire
    $Titre = $_POST['Titre'];
    $Description = $_POST['Description'];
    $Couverture = $_POST['Couverture'];
    $MotCleDescriptive = $_POST['MotCleDescriptive'];
    $NomAgent = $_POST['NomAgent'];
    $TypeDoc = $_POST['TypeDoc'];
    $ProfileArchive = $_POST['ProfileArchive'];
    $TypeRef = $_POST['TypeRef'];
    $CibleRef = $_POST['CibleRef'];


    // Vérifier si le titre existe déjà
    $checkStmt = $conn->prepare("SELECT * FROM descriptive_metadata WHERE Titre = ?");
    $checkStmt->bind_param("s", $Titre);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    if ($checkResult->num_rows > 0) {
        echo('Ce titre est déja utilsé <br/>');
        echo '<br><a href="index.php">Retour à la page d\'accueil</a>';

        exit;
    }
    else{
        // Ensuite, ajoutez-les au fichier XML
        $archiveUnit->addChild('Titre', $Titre);
        $archiveUnit->addChild('Description', $Description);
        $archiveUnit->addChild('Couverture', $Couverture);
        $archiveUnit->addChild('MotCleDescriptive', $MotCleDescriptive);
        $archiveUnit->addChild('NomAgent', $NomAgent);
        $archiveUnit->addChild('TypeDoc', $TypeDoc);
        $archiveUnit->addChild('ProfileArchive', $ProfileArchive);
        $archiveUnit->addChild('TypeRef', $TypeRef);
        $archiveUnit->addChild('CibleRef', $CibleRef);
        $archiveUnit->addChild('metadataType', 'descriptive');
        echo 'Le fichier a été correctement archivé en XML conforme à SEDA 2.1. <br/>';
        $xml->asXML("Descriptive_Metadata/" . $Titre . "_descriptive.xml");
        $stmt = $conn->prepare("INSERT INTO descriptive_metadata (Titre, Description, Couverture , MotCleDescriptive, NomAgent, TypeDoc, ProfileArchive, TypeRef, CibleRef) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $Titre, $Description, $Couverture, $MotCleDescriptive, $NomAgent, $TypeDoc, $ProfileArchive, $TypeRef, $CibleRef);
        $stmt->execute();
        echo ("Les données ont été correctement insérées dans la table <br/>");}

} elseif ($_POST['metadata'] == 'technical') {

    // Récupérer les valeurs du formulaire pour les métadonnées de type 'technical'
    $TitreTechn = $_POST['TitreTechn'];
    $FormatFichier = $_POST['FormatFichier'];
    $TailleFichier = $_POST['TailleFichier'];
    $DateCreation = $_POST['DateCreation'];
    $MotCleTechnical = $_POST['MotCleTechnical'];
    // Vérifier si le titre existe déjà
    $checkStmt = $conn->prepare("SELECT * FROM technical_metadata WHERE TitreTechn = ?");
    $checkStmt->bind_param("s", $TitreTechn);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    if ($checkResult->num_rows > 0) {
        echo('Ce titre est déja utilsé <br/>');
        echo '<br><a href="index.php">Retour à la page d\'accueil</a>';

        exit;
    }
    else
        $archiveUnit->addChild('TitreTechn', $TitreTechn);
        $archiveUnit->addChild('FormatFichier', $FormatFichier);
        $archiveUnit->addChild('TailleFichier', $TailleFichier);
        $archiveUnit->addChild('DateCreation', $DateCreation);
        $archiveUnit->addChild('MotCleTechnical', $MotCleTechnical);
        $archiveUnit->addChild('metadataType', 'technical');

        $xml->asXML("Technical_Metadata/" . $TitreTechn . "_technical.xml");
        $stmt = $conn->prepare("INSERT INTO technical_metadata (TitreTechn, FormatFichier, TailleFichier, DateCreation, MotCleTechnical) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $TitreTechn, $FormatFichier, $TailleFichier, $DateCreation, $MotCleTechnical);
        $stmt->execute();
        echo ("Les données ont été correctement insérées dans la table <br/>");
        technical_metadata($archiveTransfer, $TitreTechn, $FormatFichier, $TailleFichier, $DateCreation, $MotCleTechnical);

} elseif ($_POST['metadata'] == 'transfer') {
    // Récupérer les valeurs du formulaire pour les métadonnées de type 'transfer'
    $titreTransf = $_POST['TitreTransf'];
    $transferringAgency = $_POST['AgenceTransfert'];
    $archivalAgreement = $_POST['AccordArchivage'];
    $codeListVersions = $_POST['CodeListVersions'];
    $MotCle = $_POST['MotCle'];
    // Vérifier si le titre existe déjà
    $checkStmt = $conn->prepare("SELECT * FROM transfer_metadata WHERE TitreTransf = ?");
    $checkStmt->bind_param("s", $TitreTransf);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    if ($checkResult->num_rows > 0) {
        echo('Ce titre est déja utilsé <br/>');
        echo '<br><a href="index.php">Retour à la page d\'accueil</a>';
        exit;
    }
    else
        $archiveUnit->addChild('TitreTransf', $titreTransf);
        $archiveUnit->addChild('AgenceTransfert', $transferringAgency);
        $archiveUnit->addChild('AccordArchivage', $archivalAgreement);
        $archiveUnit->addChild('CodeListVersions', $codeListVersions);
        $archiveUnit->addChild('MotCle', $MotCle);
        $archiveUnit->addChild('metadataType', 'transfer');
        // Sauvegarder le fichier XML et inserer dans table
        $xml->asXML("Transfer_Metadata/" . $titreTransf . "_transfer.xml");
        $stmt = $conn->prepare("INSERT INTO transfer_metadata (TitreTransf, AgenceTransfert, AccordArchivage, CodeListVersions, MotCle) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $titreTransf, $transferringAgency, $archivalAgreement, $codeListVersions, $MotCle);
        $stmt->execute();
        echo ("Les données ont été correctement insérées dans la table <br/>");
        transfer_metadata($archiveTransfer, $titreTransf, $transferringAgency, $archivalAgreement, $codeListVersions, $MotCle);

}elseif ($_POST['metadata'] == 'management') {
    // Récupérer les valeurs du formulaire pour les métadonnées de type 'management'
    $TitreManag = $_POST['TitreManag'];
    $AccessRuleCode = $_POST['AccessRuleCode'];
    $AppraisalRuleCode = $_POST['AppraisalRuleCode'];
    $ClassificationLevel = $_POST['NiveauClassification'];
    $ClassificationOwner = $_POST['ProprioClass'];
    $ArchivalProfileCode = $_POST['ArchivalProfileCode'];
    $ServiceLevelCode = $_POST['ServiceLevelCode'];
    $DisseminationRuleCode = $_POST['DisseminationRuleCode'];
    $StorageRuleCode = $_POST['StorageRuleCode'];
    $ReuseRuleCode = $_POST['ReuseRuleCode'];
    $MotCleManagment = $_POST['MotCleManagment'];

    // Vérifier si le titre existe déjà
    $checkStmt = $conn->prepare("SELECT * FROM management_metadata WHERE TitreManag = ?");
    $checkStmt->bind_param("s", $TitreManag);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo ('Ce titre est déja utilsé <br/>');
        echo '<br><a href="index.php">Retour à la page d\'accueil</a>';

        exit;
    } else {
         management_metadata($archiveUnit, $TitreManag, $AccessRuleCode, $AppraisalRuleCode, $ClassificationLevel, $ClassificationOwner, $ArchivalProfileCode, $ServiceLevelCode, $DisseminationRuleCode, $StorageRuleCode, $ReuseRuleCode, $MotCleManagment);


        }
}


echo '<br><a href="index.php">Retour à la page d\'accueil</a>';
exit;
?>