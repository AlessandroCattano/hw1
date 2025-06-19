<?php
    header('Content-Type: application/json');
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "justwatch");
    $email = mysqli_real_escape_string($conn, $_SESSION['email']);
    $imdb_id = mysqli_real_escape_string($conn, $_GET['id']);

    $query = "DELETE FROM lists WHERE email = '$email' AND imdb = '$imdb_id'";
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

    echo json_encode($val);

    mysqli_close($conn);

?>