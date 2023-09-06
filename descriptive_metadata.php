<?php
function descriptive_metadata($archiveUnit) {
    $titre = "Titre Descriptive";
    $description = "Description";
    $couverture = "Couverture";
    $motCleDescriptive = "Mot Clé Descriptive";
    $nomAgent = "Nom Agent";
    $typeDoc = ".pdf";
    $profileArchive = "Profile Archive";
    $typeRef = "Type Référence";
    $cibleRef = "Cible Référence";

    // Ajouter les informations à l'élément ArchiveUnit
    $archiveUnit->addChild('Titre', $titre);
    $archiveUnit->addChild('Description', $description);
    $archiveUnit->addChild('Couverture', $couverture);
    $archiveUnit->addChild('MotCleDescriptive', $motCleDescriptive);
    $archiveUnit->addChild('NomAgent', $nomAgent);
    $archiveUnit->addChild('TypeDoc', $typeDoc);
    $archiveUnit->addChild('ProfileArchive', $profileArchive);
    $archiveUnit->addChild('TypeRef', $typeRef);
    $archiveUnit->addChild('CibleRef', $cibleRef);
}
?>
