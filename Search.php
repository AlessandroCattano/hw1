<?php
    header('Content-Type: application/json');
    $key = '2c4e24b2';
    $url = 'https://www.omdbapi.com/';

    if (isset($_GET['title'])) {
        $title = $_GET['title'];
    }   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . "?apikey=" . $key . "&s=" . urlencode($title)); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($ch);

    if ($output === false) {
        echo json_encode(array("error" => "curl error: " . curl_error($ch)));
        exit;
    }

    curl_close($ch);
    $data = json_decode($output, true);
    echo json_encode($data);

?>