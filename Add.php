<?php
    header('Content-Type: application/json');
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "justwatch");
    $email = mysqli_real_escape_string($conn, $_SESSION['email']);
    $imdb_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = "SELECT * FROM lists WHERE imdb='$imdb_id' AND email = '$email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0.){
        $val = array(
            'failed' => false
        );
    }else{
        $query = "INSERT INTO lists (email,imdb) VALUES ('$email', '$imdb_id')";
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            $val = array(
                'success' => true
            );
        } else {
            $val = array(
                'failed' => false
            );
        }
    }

    
    echo json_encode($val);

    mysqli_close($conn);

?>