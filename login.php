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
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error[] = "Email non valida";
            } else {
                $email = mysqli_real_escape_string($conn, $_POST["email"]);
                $password = mysqli_real_escape_string($conn, $_POST['password']);

                $query = "SELECT email, pwd, name, surname FROM users WHERE email = '$email'";
                $res = mysqli_query($conn, $query);
                if (!$res) {
                    $error[] = "Errore nella query: " . mysqli_error($conn);
                } else {
                    $row = mysqli_fetch_assoc($res);
                    if ($row && password_verify($password, $row['pwd'])) {
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['email'] = $email;
                        $_SESSION['surname'] = $row['surname'];
                        mysqli_close($conn);
                        $response = array("success" => "Redirect correctly", "login" => "true");
                        echo json_encode($response);
                        exit;
                    } else {
                        $error[] = "Credenziali non valide";
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