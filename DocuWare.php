<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

class DocuWare {

    private $client;
    private $token;

    public function __construct($base_uri, $username, $password) {
        $this->client = new Client(['base_uri' => $base_uri]);

        // Authentification
        $response = $this->client->request('POST', 'Authentication/Login', [
            'json' => [
                'UserName' => $username,
                'Password' => $password,
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        $this->token = $body['Token'];
    }

    public function uploadFile($file) {
        // Logic pour l'upload du fichier ici
        // Vous devez consulter la documentation de l'API DocuWare pour savoir comment uploader un fichier.
    }

}
