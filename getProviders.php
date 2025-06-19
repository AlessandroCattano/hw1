<?php
    header('Content-Type: application/json');
    $conn = mysqli_connect("localhost", "root", "", "justwatch");

    $imdb_id = mysqli_real_escape_string($conn, $_GET['id']);

    $query = "SELECT * FROM contents WHERE imdb = '$imdb_id'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 0){
        $query = "SELECT COUNT(*) from providers";
        $result =  mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result); 
        $max = $row[0];
        $casual = rand(1, $max);
        $query = "INSERT INTO contents (imdb, provider) VALUES ('$imdb_id','$casual')";
        mysqli_query($conn, $query);
    }
    $query = "SELECT url, name FROM providers join contents on providers.id = contents.provider where contents.imdb = '$imdb_id'";

    $result = mysqli_query($conn, $query);

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