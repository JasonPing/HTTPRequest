<?php
require_once('HttpClient.php');

$httpClient = new HttpClient();
$uri = 'https://www.coredna.com/assessment-endpoint.php';

// get Auth Token
$response = $httpClient->authenticate($uri);

if (!$response['success']) {
    die("Fail to get auth token");
}


echo "Successfully get token";
$token = $response['data'];


// Form POST data
$data = [
    "name" => 'Jason Ping',
    'email' => 'eazyee6@gmail.com',
    "url" => 'https://github.com/JasonPing/HTTPRequest'
];
$json = json_encode($data);
$response = $httpClient->post($uri, $json, $token);

var_dump($response);
