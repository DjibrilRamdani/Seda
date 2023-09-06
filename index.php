<?php
$metadataOptions = array(
    'descriptive' => 'Métadonnées descriptives',
    'management' => 'Métadonnées de gestion',
    'technical' => 'Métadonnées techniques',
    'transfer' => 'Métadonnées de transfert',
);
?>

<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="styles.css">
<!-- Ajout du formulaire de recherche -->
<h2>Recherche par mot clé</h2>
<form action="search.php" method="get" id="searchForm">
    <input type="text" name="MotCle" placeholder="Entrez un mot clé">
    <input type="submit" value="Rechercher">
</form>


<script>
    function validateForm() {
        var Titre = document.forms["myForm"]["Titre"].value;
        var description = document.forms["myForm"]["description"].value;
        var coverage = document.forms["myForm"]["coverage"].value;
        var keyword = document.forms["myForm"]["keyword"].value;
        var date = document.forms["myForm"]["date"].value;
        var agentName = document.forms["myForm"]["agentName"].value;
        var docType = document.forms["myForm"]["docType"].value;
        var docId = document.forms["myForm"]["docId"].value;
        var sendingOrg = document.forms["myForm"]["sendingOrg"].value;
        var receivingArchives = document.forms["myForm"]["receivingArchives"].value;
        var creationDate = document.forms["myForm"]["creationDate"].value;
        var producer = document.forms["myForm"]["producer"].value;
        var accessRights = document.forms["myForm"]["accessRights"].value;
        var transferringAgency = document.forms["myForm"]["transferringAgency"].value;
        var archivalAgreement = document.forms["myForm"]["archivalAgreement"].value;
        var codeListVersions = document.forms["myForm"]["codeListVersions"].value;
        var archiveUnitProfile = document.forms["myForm"]["archiveUnitProfile"].value;
        var relatedObjectReferenceType = document.forms["myForm"]["relatedObjectReferenceType"].value;
        var relatedObjectReferenceTarget = document.forms["myForm"]["relatedObjectReferenceTarget"].value;

        if (Titre == "" || description == "" || coverage == "" || keyword == "" || date == "" || agentName == "" || docId == "" || sendingOrg == "" || receivingArchives == "" || creationDate == "" || producer == "" || accessRights == "" || transferringAgency == "" || archivalAgreement == "" || codeListVersions == "" || archiveUnitProfile == "" || relatedObjectReferenceType == "" || relatedObjectReferenceTarget == "") {
            alert("Aucun champ ne doit être vide");
            return false;
        }

        return true;
    }
</script>

<form action="archive.php" method="post" enctype="multipart/form-data" name="myForm" onsubmit="return validateForm()" id="archiveForm">
    Choisissez un fichier à archiver :
    <input type="file" name="file"><br>

    <!-- Ajout du formulaire de sélection des métadonnées -->
    <h2>Configuration des données à exporter</h2>
    <?php
    foreach($metadataOptions as $option => $label) {
        echo '<input type="radio" id="'.$option.'" name="metadata" value="' . $option . '"> <label for="'.$option.'">' . $label . '</label><br>';
    }
    ?>

    <div id="descriptiveForm" style="display: none;">
        <h3>Informations descriptives</h3>
        Titre : <input type="text" name="Titre" maxlength="15"><br>
        Description : <textarea name="Description"></textarea><br>
        Couverture : <input type="text" name="Couverture" maxlength="15"><br>
        Mot Clé : <input type="text" name="MotCleDescriptive" maxlength="10" ><br>
        Nom d'agent : <textarea name="NomAgent"></textarea><br>
        Type de document :
        <select name="TypeDoc">
            <option value=".pdf">.pdf</option>
            <option value=".txt">.txt</option>
            <option value=".doc">.doc</option>
            <option value=".img">.img</option>
        </select><br>
        Profil d'archivage : <input type="text" name="ProfileArchive" maxlength="15"><br>
        Type de référence : <input type="text" name="TypeRef" maxlength="15"><br>
        Référence cible : <input type="text" name="CibleRef" maxlength="15"><br>
    </div>
    <div id="technicalForm" style="display: none;">
        <h3>Informations techniques</h3>
        Titre du Fichier : <input type="text" name="TitreTechn"><br>
        Format de fichier :
        <select name="FormatFichier">
            <option value=".pdf">.pdf</option>
            <option value=".txt">.txt</option>
            <option value=".docx">.docx</option>
            <option value=".jpeg">.jpeg</option>
        </select><br>

        Taille du fichier : <input type="number" name="TailleFichier"><br>
        Date de création : <input type="date" name="DateCreation"><br>
        Mot Clé : <input type="text" name="MotCleTechnical" maxlength="10"><br>
    </div>




    <div id="managementForm" style="display: none;">
        <h3>Informations de gestion</h3>

        Titre de gestion : <input type="text" name="TitreManag" id="TitreManag" maxlength="15"><br>

        Code de règle d'accès : <input type="text" name="AccessRuleCode" id="AccessRuleCode"><br>

        Code de règle d'évaluation : <input type="text" name="AppraisalRuleCode" id="AppraisalRuleCode"><br>

        Niveau de classification : <input type="number" name="NiveauClassification" id="NiveauClassification"><br>

        Propriétaire de la classification : <input type="text" name="ProprioClass" id="ProprioClass"><br>

        Code de profil d'archivage : <input type="text" name="ArchivalProfileCode" id="ArchivalProfileCode"><br>

        Code de niveau de service : <input type="text" name="ServiceLevelCode" id="ServiceLevelCode"><br>

        Code de règle de diffusion : <input type="text" name="DisseminationRuleCode" id="DisseminationRuleCode"><br>

        Code de règle de stockage : <input type="text" name="StorageRuleCode" id="StorageRuleCode"><br>

        Code de règle de réutilisation : <input type="text" name="ReuseRuleCode" id="ReuseRuleCode"><br>

        Mot Clé : <input type="text" name="MotCleManagment" maxlength="10"><br>
    </div>



    <div id="transferForm" style="display: none;">
        <h3>Informations de transfert</h3>
        Titre de transfert : <input type="text" name="TitreTransf" maxlength="15"><br>
        Agence de transfert : <input type="text" name="AgenceTransfert" maxlength="15"><br>
        Accord d'archivage : <input type="text" name="AccordArchivage" maxlength="20"><br>
        Versions de liste de codes : <input type="number" name="CodeListVersions" min="0"><br>
        Mot Clé : <input type="text" name="MotCle" maxlength="15"><br>
    </div>




    <input type="submit" value="Archiver" name="submit">
</form>


<script>
    document.getElementsByName('metadata').forEach((elem) => {
        elem.addEventListener('change', function() {
            document.getElementById('descriptiveForm').style.display = this.id === 'descriptive' ? 'block' : 'none';
            document.getElementById('managementForm').style.display = this.id === 'management' ? 'block' : 'none';
            document.getElementById('technicalForm').style.display = this.id === 'technical' ? 'block' : 'none';
            document.getElementById('transferForm').style.display = this.id === 'transfer' ? 'block' : 'none';
        });
    });
</script>
<div id="search-results"></div>
<script>
    document.querySelector('#searchForm').addEventListener('submit', function(event) {
        event.preventDefault();  // empêcher le rechargement de la page

        // Envoyer une requête AJAX à search.php
        fetch('search.php?MotCle=' + document.querySelector('input[name="MotCle"]').value)
            .then(response => response.text())
            .then(data => {
                // Utiliser la réponse pour remplir le div des résultats de recherche
                document.querySelector('#search-results').innerHTML = data;
            });
    });

</script>

</body>
</html>

