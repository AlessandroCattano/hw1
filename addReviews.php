<?php
    header('Content-Type: application/json');
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "justwatch");

    if (!isset($_SESSION['email'])) {
        $comment = array("error" => "Effettua prima il login");
        mysqli_close($conn);
        echo json_encode($comment);
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
            $comment = array(
                    'name' => $_SESSION['name'],
                    'surname'=> $_SESSION['surname'],
                    'text' => $text,
                    'data'=> date( 'Y-m-d')
                );
            $comments[] = $comment;
        }
    } else {
        $comment = array("error" => "Errore nella richiesta");
        $comments[] = $comment;
    }
    mysqli_close($conn);
    echo json_encode($comments);

?>