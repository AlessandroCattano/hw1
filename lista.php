<?php
session_start();
?>

<html>

<head>
    <title>JustWatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="popolari.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="webicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@900&display=swap" rel="stylesheet">
    <script src="script.js" defer></script>
    <script src="lista.js" defer></script>
</head>

<body>
    <?php require_once 'header.php'; ?>

    <section id="loading-scene">
        <img src="download.gif" alt="">
    </section>
    
    <section id="list">
        <?php
            echo "<div id='title' class='hide'>
                    <h1>Ecco la lista personale di ".$_SESSION['name']." ".$_SESSION['surname']. "</h1>
                </div>"
        ?>
        <section id="grid">

        </section>
    </section>

    <section id="details" class="hide">
        <p id="backtogrid">&#x21E6;</p>
        <div id="left">
            <img src="">
        </div>
        <div id="right">
            <div id="content-title"></div>
            <div id="inside">
                <div id="inside-left"></div>
                <div id="inside-right"></div>
            </div>
        </div>
    </section>

</body>

</html>