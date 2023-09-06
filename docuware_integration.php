<?php
require 'vendor/autoload.php'; // Si vous utilisez Composer pour gérer les dépendances


use GuzzleHttp\Client;

// Vos identifiants DocuWare
$username = 'ramdjibril24@gmail.com';
$password = 'Djibril94400!'; // Remarque : il est recommandé de stocker cela de manière sécurisée et non en dur dans le code

// Base URI de l'API DocuWare
$baseUri = 'https://{votreUriDocuWare}/DocuWare/Platform';

// Création d'un nouveau client HTTP
$client = new Client([
    'base_uri' => $baseUri,
]);

// Essayons de nous authentifier
try {
    $response = $client->request('POST', 'Authentication/Login', [
        'json' => [
            'UserName' => $username,
            'Password' => $password,
        ],
    ]);

    if ($response->getStatusCode() == 200) {
        // Authentification réussie
        $data = json_decode($response->getBody(), true);
        $token = $data['SessionToken']; // Stockez ce token pour les requêtes futures à l'API DocuWare

        echo 'Connexion réussie à DocuWare. Votre token est : ' . $token;
    } else {
        echo 'Échec de la connexion à DocuWare. Veuillez vérifier vos identifiants.';
    }
} catch (\Exception $e) {
    echo 'Une erreur s\'est produite lors de la connexion à DocuWare : ' . $e->getMessage();
}
?>
