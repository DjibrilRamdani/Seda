<?php
class ArchiveTransfer {
    private $xml;

    public function __construct() {
        $this->xml = new SimpleXMLElement('<ArchiveTransfer></ArchiveTransfer>');
    }

    public function addComment($comment) {
        $this->xml->addChild('Comment', $comment);
    }

    public function addDataObjectPackage() {
        $this->xml->addChild('DataObjectPackage');
    }

    public function addManagementMetadata($managementMetadata) {
        $managementMetadataElement = $this->xml->addChild('ManagementMetadata');
        foreach ($managementMetadata as $key => $value) {
            $managementMetadataElement->addChild($key, $value);
        }
    }

    public function addBinaryDataObject($fileName, $fileTemp) {
        $binaryDataObject = $this->xml->DataObjectPackage->addChild('BinaryDataObject');
        $binaryDataObject->addAttribute('filename', $fileName);
        $binaryDataObject->addChild('BinaryContent', base64_encode(file_get_contents($fileTemp)));
    }

    public function saveXmlFile($filePath) {
        $this->xml->asXML($filePath);
    }
}

if(isset($_POST['submit']) && isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $fileTemp = $_FILES['file']['tmp_name'];

    $archiveTransfer = new ArchiveTransfer();
    $archiveTransfer->addComment('Ceci est un test d\'archivage');
    $archiveTransfer->addDataObjectPackage();
    $archiveTransfer->addManagementMetadata([
        'ArchivalProfile' => 'PROFIL_001',
        'ServiceLevel' => 'LEVEL_001',
        'AcquisitionInformation' => 'versement',
        'LegalStatus' => 'Private Archive',
        'OriginatingAgencyIdentifier' => 'OAI_001',
        'SubmissionAgencyIdentifier' => 'SAI_001'
    ]);
    $archiveTransfer->addBinaryDataObject($fileName, $fileTemp);
    $archiveTransfer->saveXmlFile('archive_message.xml');

    echo "L'archive a été créée.";
}
