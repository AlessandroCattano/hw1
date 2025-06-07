<?php
    header('Content-Type: application/json');
    $conn = mysqli_connect("localhost", "root", "", "justwatch");

    $imdb_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT url, name FROM providers join contents on providers.id = contents.provider where contents.imdb = '$imdb_id'";

    $result = mysqli_query($conn, $query);

    $provider_url = array();
    if ($result) {  
        while ($row = mysqli_fetch_assoc($result)) {
            $provider = array(
                'url' => $row['url'],
                'name' => $row['name']
            );
            $provider_url[] = $provider;
        }
    }else {
        echo "Errore nella query";
    }

    mysqli_close($conn);

    echo json_encode($provider_url);
?>