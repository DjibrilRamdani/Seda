<?php
require('db_connect.php');

$MotCle = isset($_GET['MotCle']) ? $_GET['MotCle'] : "";

if ($MotCle !== "") {
    $stmt = $conn->prepare("SELECT * FROM descriptive_metadata WHERE MotCleDescriptive LIKE ?");
    $param = "%" . $MotCle . "%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $results_descriptive = $stmt->get_result();

    $stmt = $conn->prepare("SELECT * FROM management_metadata WHERE MotCleManagment LIKE ?");
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $results_management = $stmt->get_result();

    $stmt = $conn->prepare("SELECT * FROM technical_metadata WHERE MotCleTechnical LIKE ?");
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $results_technical = $stmt->get_result();

    $stmt = $conn->prepare("SELECT * FROM transfer_metadata WHERE MotCle LIKE ?");
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $results_transfer = $stmt->get_result();

// Affichage des résultats
    echo "Résultats de la recherche pour '" . $MotCle . "':<br><br>";

    if ($results_descriptive->num_rows > 0) {
        while ($row = $results_descriptive->fetch_assoc()) {
            echo '<div class="result">';
            echo " Type de métadonnées : Métadonnées descriptives <br>";
            echo "Titre : " . $row["Titre"] . "<br>";
            echo '<a href="decode.php?file=' . urlencode($row["Titre"] . '_descriptive.xml') . '&typeMetadata=descriptive">Décoder</a><br>';
            echo '</div>';
        }
    }

    if ($results_management->num_rows > 0) {
        while ($row = $results_management->fetch_assoc()) {
            echo '<div class="result">';
            echo "Type de métadonnées : Métadonnées de gestion <br>";
            echo "Titre : " . $row["TitreManag"] . "<br>";
            echo "Code d'accès : " . $row["AccessRuleCode"] . "<br>";
            echo '<a href="decode.php?file=' . urlencode($row["TitreManag"] . '_management.xml') . '&typeMetadata=management">Décoder</a><br>';
            echo '</div>';
        }
    }

    if ($results_technical->num_rows > 0) {
        while ($row = $results_technical->fetch_assoc()) {
            echo '<div class="result">';
            echo "Type de métadonnées : Métadonnées techniques <br>";
            echo "Nom du fichier : " . $row["TitreTechn"] . "<br>";
            echo "Format du fichier : " . $row["FormatFichier"] . "<br>";
            echo "Taille du fichier : " . $row["TailleFichier"] . "<br>";
            echo "Date de création : " . $row["DateCreation"] . "<br>";
            echo '<a href="decode.php?file=' . urlencode($row["TitreTechn"] . '_technical.xml') . '&typeMetadata=technical">Décoder</a><br>';
            echo '</div>';
        }
    }

    if ($results_transfer->num_rows > 0) {
        while ($row = $results_transfer->fetch_assoc()) {
            echo '<div class="result">';
            echo "Type de métadonnées : Métadonnées de transfert <br>";
            echo "Titre : " . $row["TitreTransf"] . "<br>";
            echo "Agence de Transfert : " . $row["AgenceTransfert"] . "<br>";
            echo '<a href="decode.php?file=' . urlencode($row["TitreTransf"] . '_transfer.xml') . '&typeMetadata=transfer">Décoder</a><br>';
            echo '</div>';
        }
    }

}

?>
