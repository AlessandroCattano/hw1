<?php
    header('Content-Type: application/json');
    $key = '2c4e24b2';
    $url = 'https://www.omdbapi.com/';
    $data = json_decode(file_get_contents('php://input'), true);

    foreach ($data as $imdbId) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . "?apikey=" . $key . "&i=" . $imdbId);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $results[$imdbId] = json_decode($output, true); 
    }
    echo json_encode($results);
?>