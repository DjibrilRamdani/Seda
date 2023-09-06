<?php

function getDocuwareToken() {
    $username = 'ramdjibril24@mail.com';
    $password = 'Djibril94400!';
    $servername = 'start.docuware.com';
    $hostId = 'your_host_id';
    $cookieJarPath = '/path/to/your/cookie/jar';

    // 1. Se connecter avec un nom d'utilisateur et un mot de passe
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://{$servername}/docuware/platform/Account/Logon");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded',
        'Accept: application/json'
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        'Password' => $password,
        'UserName' => $username,
        'HostID' => $hostId,
        'RememberMe' => 'false'
    )));
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJarPath);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    // 2. Obtenir un jeton de connexion
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://{$servername}/docuware/platform/Organization/LoginToken");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
        'TargetProducts' => ['PlatformService'],
        'Usage' => 'Multi',
        'Lifetime' => '1.00:00:00'
    )));
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieJarPath);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $tokenResponse = json_decode($response);
    $token = $tokenResponse->Token ?? null;
    curl_close($ch);

    if (!$token) {
        return null;
    }

    // 3. Se connecter avec le jeton
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://{$servername}/docuware/platform/Account/TokenLogOn");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded',
        'Accept: application/json'
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        'Token' => $token,
        'HostID' => $hostId,
        'LicenseType' => 'PlatformService',
        'RememberMe' => 'false'
    )));
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieJarPath);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJarPath);
    curl_exec($ch);
    curl_close($ch);

    // Retourne le token
    return $token;
}
