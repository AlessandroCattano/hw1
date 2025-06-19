<?php
    header('Content-Type: application/json');
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "justwatch");
    $email = mysqli_real_escape_string($conn, $_SESSION['email']);
    $query = "SELECT imdb FROM lists where email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 0) {
        $imdbIds = array("error" => "nessun contenuto");    
    }else{
        while ($row = mysqli_fetch_assoc($result)) {
            $imdbIds[] = $row['imdb'];
        }
    }

    mysqli_close($conn);

    echo json_encode($imdbIds);
?>