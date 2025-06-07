<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "justwatch");
    
    if (isset($_SESSION['email'])){
        $email = mysqli_real_escape_string($conn, $_SESSION['email']);
        $imdb_id = mysqli_real_escape_string($conn, $_GET['id']);
    
        $query = "SELECT * FROM lists WHERE email = '$email' AND imdb = '$imdb_id'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $val = array(
                'success' => true
            );
        } else {
            $val = array(
                'failed' => false
            );
        }
    
        
    }else{
        $val = array(
                'failed' => null
            );
    }

    echo json_encode($val);    
    mysqli_close($conn);

?>