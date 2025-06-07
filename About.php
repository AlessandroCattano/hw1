<?php
session_start();
?>

<html>

<head>
    <title>JustWatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="About.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="webicon.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@900&display=swap" rel="stylesheet">
    <script src="script.js" defer></script>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <section id="introduction">
        <div id="sub"></div>
        <div id="text">
            <img src="JustWatch-logo-small.png" id="intro-logo" class="logo">
            Connecting movie fans with their favorite content worldwide
        </div>
    </section>
    <section id="content">
        <h2>WHAT WE DO</h2>
        <div id="container">
            <div class="half" id="left">
                <h3>For our users</h3>
                <img src="for-users.jpg"></img>
                <p>We show you where you can legally watch movies and TV shows that you love.<br>You are kept up to date
                    with what is new on Netflix, Amazon Prime, Apple TV and many other streaming platforms.<br> Our
                    simple filter system allows you to see only what is important to you.<br>We also allow users to
                    track their favorite shows and movies,<br>and can notify you when a title is available on one of
                    your services..</p>
                <div class="button">Learn more about our apps</div>
            </div>
            <div class= "half" id="right">
                <h3>For our clients</h3>
                <img src="for-clients-jw-media.jpg"></img>
                <p>JustWatch Media helps Entertainment brands around the world<br> get to grips with new challenges and
                    opportunities.<br> From blockbuster movies, award winning shows, major sporting events and console
                    games, we buy media for our clients across the major digital platforms.<br> We offer our clients
                    something no one else can, media buying based on audience content tastes.We work tirelessly to make
                    the experience of using our apps the best </p>
                <div class="button">Learn more about our marketing campaigns</div>
            </div>
        </div>
    </section>
    <section id="join-us">
        <h2>WE WANT TO HEAR FROM YOU</h2>
        <div id="columns-container">
            <div class="column" id="column1">
                <p>We work tirelessly to make the experience of using our apps the best that it can be and we love any
                    feedback or suggestions you may have in order for us to improve further.</p>
            </div>
            <div class="column" id="column2">
                <p>If you would like to find out more about opportunities to work with us, visit our talent page, we are
                    always looking to get more skilled and inspired people on our team.</p>
            </div>
            <div class="column" id="column3">
                <p>If you are interested in running campaigns with us for your upcoming movie, home entertainment
                    release or VOD service we are happy to hear from you.</p>
            </div>
        </div>
        <div class="button">Learn more about our marketing campaigns</div>
    </section>
    <?php require_once 'footer.html'; ?>
</body>

</html>