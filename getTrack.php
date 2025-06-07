<?php
    header('Content-Type: application/json');
    $clientId = 'd5ae488ed01d4ffca577289e96e0b1ca';
    $clientSecret = '84be69b2dfac43bb9519ca699930c8ba';
    $conn = mysqli_connect("localhost", "root", "", "justwatch");
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    $headers = array("Authorization: Basic ".base64_encode($clientId.":".$clientSecret));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($curl);
    $token_json=json_decode($response,true);
    $token = $token_json['access_token'];
    curl_close( $curl );

    $title = mysqli_real_escape_string($conn, $_GET['title']);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?type=track&q=" . urlencode($title));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers= array("Authorization: Bearer " . $token);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;
?>