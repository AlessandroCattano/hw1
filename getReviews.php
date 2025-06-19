<?php
    header('Content-Type: application/json');
    $conn = mysqli_connect("localhost", "root", "", "justwatch");

    $imdb_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT DISTINCT name, surname, text, DATE(date_c) as data FROM comments join contents on comments.imdb_c = contents.imdb join users on comments.user_email = users.email where contents.imdb = '$imdb_id' ";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
            $comment = array(
                'name' => $row['name'],
                'surname'=> $row['surname'],
                'text' => $row['text'],
                'data'=> $row['data']
            );
            $comments[] = $comment;
        }
    }else{
        $comment = array('zero'=> "non ci sono commenti al momento");
        echo json_encode($comment);
        exit;
    }

    mysqli_close($conn);

    echo json_encode($comments);
?>

