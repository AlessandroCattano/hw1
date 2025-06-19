<?php
    header('Content-Type: application/json');
    $conn = mysqli_connect("localhost", "root", "", "justwatch");
    $query = "SELECT DISTINCT imdb FROM contents";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $imdbIds[] = $row['imdb'];
    }

    mysqli_close($conn);

    echo json_encode($imdbIds);
?>