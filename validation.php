<?php
header('Content-Type: application/json');    
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "justwatch");

    if (!$conn) {
        $error[] = "Errore di connessione al database: " . mysqli_connect_error();
    } else {

        if (empty($_POST["email"]) || empty($_POST["password"])) {
            $error[] = "Errore: campi vuoti.";
        } elseif (strlen($_POST["password"]) < 8) {
            $error[] = "Errore: password troppo corta (min 8 caratteri).";
        }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        }elseif(empty($_POST["name"]) || empty($_POST["surname"])) {
            $error[] = "Errore: nome/cognome non validi.";
        }else {
            $email = mysqli_real_escape_string($conn, $_POST["email"]);

            $query = "SELECT email FROM users WHERE email = '$email'";
            $res = mysqli_query($conn, $query);
            if (!$res) {
                $error[] = "Errore nella query: " . mysqli_error($conn);
            } else {
                if (mysqli_num_rows($res) > 0) {
                    $error[] = "Email già utilizzata";
                    $response = array("error" => $error);
                    echo json_encode($response);
                    exit;
                }
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $surname = mysqli_real_escape_string($conn, $_POST['surname']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $password = password_hash($password, PASSWORD_BCRYPT);
        
                $query = "INSERT INTO users(email, pwd, name, surname) VALUES('$email', '$password', '$name', '$surname')";
                $res = mysqli_query($conn, $query);
        
                if (!$res) {
                    $error[] = "Errore nella query: " . mysqli_error($conn);
                } else {
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    $_SESSION['surname'] = $surname;
                    mysqli_close($conn);
                    $response = array("success" => "Redirect correctly", "reg"=> "true");
                    echo json_encode($response);
                    exit;
                }
            }
        }

    }
} else {
    $error[] = "Errore: richiesta non valida.";
}

if (!empty($error)) {
    $response = array("error" => $error);
    echo json_encode($response);
}

if ($conn) {
    mysqli_close($conn);
}
?>