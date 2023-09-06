<?php
require('db_connect.php');

function technical_metadata($dataObjectPackage, $TitreTechn, $FormatFichier, $TailleFichier, $DateCreation, $MotCleTechnical) {
    global $conn;

    // SEDA 2.1 specific elements
    $binaryDataObject = $dataObjectPackage->addChild('BinaryDataObject');
    $binaryDataObject->addAttribute('TitreTechn', $TitreTechn);

    $technicalMetadata = $binaryDataObject->addChild('TechnicalMetadata');
    $technicalMetadata->addChild('TailleFichier', $TailleFichier);
    $technicalMetadata->addChild('FormatFichier', $FormatFichier);
    $technicalMetadata->addChild('CreatingApplicationName', 'Your Application Name');
    $technicalMetadata->addChild('CreatingApplicationVersion', 'Your Application Version');
    $technicalMetadata->addChild('DateCreation', $DateCreation);
    $technicalMetadata->addChild('MotCleTechnical', $MotCleTechnical);

    $binaryDataObject->addChild('Metadata', 'Additional Metadata');
}
?>
