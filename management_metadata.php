<?php
require('db_connect.php');

function management_metadata($archiveUnit, $TitreManag, $AccessRuleCode, $AppraisalRuleCode, $ClassificationLevel, $ClassificationOwner, $ArchivalProfileCode, $ServiceLevelCode, $DisseminationRuleCode, $StorageRuleCode, $ReuseRuleCode, $MotCleManagment) {
global $conn;
    $xml = new SimpleXMLElement('<ArchiveTransfer></ArchiveTransfer>');
    $archiveUnit = $xml->addChild('ArchiveUnit');

    // Ajoutez-les ensuite au fichier XML
    $archiveUnit->addChild('TitreManag', $TitreManag);
    $archiveUnit->addChild('AccessRuleCode', $AccessRuleCode);
    $archiveUnit->addChild('AppraisalRuleCode', $AppraisalRuleCode);
    $archiveUnit->addChild('NiveauClassification', $ClassificationLevel);
    $archiveUnit->addChild('ProprioClass', $ClassificationOwner);
    $archiveUnit->addChild('ArchivalProfileCode', $ArchivalProfileCode);
    $archiveUnit->addChild('ServiceLevelCode', $ServiceLevelCode);
    $archiveUnit->addChild('DisseminationRuleCode', $DisseminationRuleCode);
    $archiveUnit->addChild('StorageRuleCode', $StorageRuleCode);
    $archiveUnit->addChild('ReuseRuleCode', $ReuseRuleCode);
    $archiveUnit->addChild('MotCleManagment', $MotCleManagment);
    $archiveUnit->addChild('metadataType', 'management');

    // Sauvegarder le fichier XML
    $xml->asXML("Management_Metadata/" . $TitreManag . "_management.xml");

    $stmt = $conn->prepare("INSERT INTO management_metadata (TitreManag, AccessRuleCode, AppraisalRuleCode, NiveauClassification, ProprioClass, ArchivalProfileCode , ServiceLevelCode ,DisseminationRuleCode , StorageRuleCode , ReuseRuleCode , MotCleManagment) VALUES (?, ?, ?, ?, ? ,? , ?,? ,? ,? ,? )");
    $stmt->bind_param("sssisssssss", $TitreManag, $AccessRuleCode, $AppraisalRuleCode, $ClassificationLevel, $ClassificationOwner , $ArchivalProfileCode, $ServiceLevelCode, $DisseminationRuleCode, $StorageRuleCode,$ReuseRuleCode , $MotCleManagment );
    $stmt->execute();
    echo ("Les données ont été correctement insérées dans la table <br/>");
}
?>
