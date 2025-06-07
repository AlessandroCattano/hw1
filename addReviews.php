<?php
    header('Content-Type: application/json');
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "justwatch");
    $comments = array();

    if (!isset($_SESSION['email'])) {
        $comment = array("error" => "Effettua prima il login");
        $comments[] = $comment;
        mysqli_close($conn);
        echo json_encode($comments);
        exit;
    }

    $email = $_SESSION['email'];

    if (isset($_POST['text-area']) && isset($_POST['imdb_id'])) {
        $imdb_id = mysqli_real_escape_string($conn, $_POST['imdb_id']);
        $text = mysqli_real_escape_string($conn, $_POST['text-area']);

        $query = "INSERT INTO comments (user_email, imdb_c, text) VALUES ('" . $_SESSION['email'] . "', '" . $_POST['imdb_id'] . "', '" . $_POST['text-area'] . "')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            $comment = array("error" => "Errore nell'inserimento del commento: " . mysqli_error($conn));
            $comments[] = $comment;
        } else {
            $query = "SELECT name, surname, text, DATE(date_c) as data from comments join users on comments.user_email = users.email where users.email = '" . $_SESSION['email'] . "' AND comments.imdb_c = '" . $_POST['imdb_id'] . "' AND comments.text = '" . $_POST['text-area'] . "' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if($row = mysqli_fetch_assoc($result)){
                $comment = array(
                    'name' => $row['name'],
                    'surname'=> $row['surname'],
                    'text' => $row['text'],
                    'data'=> $row['data']
                );
                $comments[] = $comment;
            } else {
                $comment = array("error" => "Errore nel loading del commento: " . mysqli_error($conn));
                $comments[] = $comment;
            }

        }
    } else {
        $comment = array("error" => "Errore nella richiesta");
        $comments[] = $comment;
    }
    mysqli_close($conn);
    echo json_encode($comments);

?>