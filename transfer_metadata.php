<?php
require('db_connect.php');

function transfer_metadata($archiveTransfer, $titreTransf, $transferringAgency, $archivalAgreement, $codeListVersions, $motCle) {

    global $conn;

    $transferMetadata = $archiveTransfer->addChild('TransferMetadata');

    $transferMetadata->addChild('TitreTransf', $titreTransf);
    $transferMetadata->addChild('TransferringAgency', $transferringAgency);
    $transferMetadata->addChild('ArchivalAgreement', $archivalAgreement);
    $transferMetadata->addChild('CodeListVersions', $codeListVersions);
    $transferMetadata->addChild('MotCle', $motCle);
    $transferMetadata->addChild('metadataType', 'transfer');  // ajout de metadataType

    // Preparation of SQL query
    $stmt = $conn->prepare("INSERT INTO transfer_metadata (TitreTransf, AgenceTransfert, AccordArchivage, CodeListVersions, MotCle) VALUES (?, ?, ?, ?, ?)");

    // Binding parameters and executing query
    $stmt->bind_param("sssii", $titreTransf, $transferringAgency, $archivalAgreement, $codeListVersions, $motCle);

    $stmt->execute();
}

?>
