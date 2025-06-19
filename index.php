<?php
    session_start();
?>
<html>
<head>
    <title>JustWatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="webicon.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@900&display=swap" rel="stylesheet">
    <script src="script.js" defer></script>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <section id="welcome">
        <?php
            if (isset($_SESSION['email']) &&  isset($_SESSION['name']) &&  isset($_SESSION['surname'])) {
                echo "<h1>Ciao ".$_SESSION['name']. "</h1>";
            }else {
                echo "<h1>La tua guida allo streaming per film e serie tv</h1>";
            }
        ?>
        <?php
            if (isset($_SESSION['email']) &&  isset($_SESSION['name']) &&  isset($_SESSION['surname'])) {
                echo "<p> Aggiungi alla tua lista personale film e serie tv da guardare quando preferisci</p>";
            }else {
                echo "<p>Iscriviti o effettua il login per avere tutte le funzioni di JustWatch</p>";
            }
        ?>
        <?php
            if (isset($_SESSION['email']) &&  isset($_SESSION['name']) &&  isset($_SESSION['surname'])) {
                echo "<section id='buttons'>
                        <a href='popolari.php' id='button1'>Scopri film e serie tv</a>
                    </section>";
            }
        ?>
    </section>
    <section id="providers">
        <p>Servizi di streaming su JustWatch</p>
        <div id="icons-providers">
            <img src=" netflix.jpeg" class="provider">
            <img src=" amazonprimevideo.jpeg" class="provider">
            <img src=" disneyplus.jpeg" class="provider">
            <img src=" appletvplus.jpeg" class="provider">
            <img src=" nowtv.jpeg" class="provider">
            <img src=" skygo.jpeg" class="provider">
            <img src=" infinity.jpeg" class="provider">
            <img src=" mediasetplay.jpeg" class="provider">
            <img src=" paramountplus.jpeg" class="provider">
            <img src=" discoverypluseurope.jpeg" class="provider">
        </div>
    </section>
    <section id="functions">
        <div class="function" id="func1">
            <div><img src=" guide.png"></div>
            <h2>La tua guida completa allo streaming</h2>
            <p>Ricevi consigli personalizzati per tutti i tuoi servizi di streaming preferiti. Ti mostreremo dove
                guardare film e serie TV.</p>
        </div>
        <div class="function" id="func2">
            <div><img src=" imgsearch.png"></div>
            <h2>Tutte le piattaforme in un'unica ricerca</h2>
            <p>Di' addio allo zapping tra i vari servizi di streaming per scoprire dov'è disponibile un film o una serie
                TV. ti aiutiamo noi, con un'unica ricerca.</p>
        </div>
        <div class="function" id="func3">
            <div><img src=" lists.png"></div>
            <h2>Metti insieme tutte le tue liste</h2>
            <p>Crea un'unica lista su tutti i tuoi dispositivi che includa tutti i film e le serie TV che vorresti
                guardare sui vari servizi in streaming.</p>
        </div>
    </section>
    
    <?php require_once 'footer.html'; ?>
</body>

</html>