<?php
session_start();
?>
<html>

<head>
    <title>Justwatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="faq.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="webicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <section id="container">
        <section id="title">
            <h1>About JustWatch</h1>
            <p>General questions frequently asked about JustWatch</p>
        </section>
        <section id="pre-blocks">
            <p>FAQ</p>
        </section>
        <section id="blocks">
            <div class="block">
                <h2>Understanding Provider Filters in the JustWatch App</h2>
                <p>The JustWatch App offers a variety of provider filters to help users find content from their
                    preferred streaming services efficiently. These filters allow you to refine your search based on the
                    available providers.</p>
            </div>
            <div class="block">
                <h2>Is JustWatch free?</h2>
                <p>Yes! JustWatch is a free app. We do have an enhanced version of JustWatch called JustWatch Pro for a
                    monthly fee - this is not needed to enjoy all the main features of JustWatch and to find where...
                </p>
            </div>
            <div class="block">
                <h2>Where do I find my tracked TV shows?</h2>
                <p>With a recent update, we reorganized the Watchlist and the TV Show Tracking section. This means, none
                    of your saved TV shows have disappeared, but have moved to a new home. TV shows that you are tr...
                </p>
            </div>
            <div class="block">
                <h2>What is TV Show Tracking?</h2>
                <p>TV Show Tracking lets you keep track of your season progress or catch up with your favourite shows.
                    You will automatically get notified when new episodes or seasons come out. To start tracking a TV...
                </p>
            </div>
            <div class="block">
                <h2>What are custom lists?</h2>
                <p>Besides your Watchlist, you can save movies and TV Shows in lists you created yourself. You can find
                    custom lists in the first tab under Lists > My Lists.</p>
            </div>
            <div class="block">
                <h2>Is there a way to add movies to my Watchlist with one click?</h2>
                <p>With a recent release, we updated the Watchlist and TV Show Tracking section. You can now save titles
                    not only to the Watchlist or track them with TV Show Tracking, but also to your own lists</p>
            </div>
        </section>
    </section>
    <?php require_once 'footer.html'; ?>
</body>

</html>