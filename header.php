<header>
        <nav id="nav-mobile">
            <div id="menu">
                <img class="images" id="burger-menu" src=" menu.png">
                <div id="mobile-links">
                    <a href="index.php">Home</a>
                    <a href="popolari.php">Popolari</a>
                    <?php
                        if (isset($_SESSION['email']) &&  isset($_SESSION['name']) &&  isset($_SESSION['surname'])) {
                            echo "<a href='lista.php'>Liste</a>";
                        }
                    ?>
                    <a href="faq.php">FAQ</a>
                    <a href="About.php">About</a>
                </div>
            </div>
            <img src="JustWatch-logo-small.png" id="logo-mobile">
            <?php
                if (isset($_SESSION['email']) &&  isset($_SESSION['name']) &&  isset($_SESSION['surname'])) {
                    echo "<a class='img-logout' href='logout.php'><img src='user-logged.png' class='logout image' id='user-mobile-logged'></a>";
                }else {
                    echo "<img src='user.png' class='user images' id='user-mobile'>";
                }
            ?>
        </nav>
        <nav id="main-nav">
            <div id="main"><img src="JustWatch-logo-small.png"></div>
            <a href="index.php">Home</a>
            <a href="popolari.php">Popolari</a>
            <?php
                if (isset($_SESSION['email']) &&  isset($_SESSION['name']) &&  isset($_SESSION['surname'])) {
                    echo "<a href='lista.php'>Liste</a>";
                }
            ?>
            <a href="faq.php">FAQ</a>
            <a href="About.php">About</a>
            <?php
                if (isset($_SESSION['email']) &&  isset($_SESSION['name']) &&  isset($_SESSION['surname'])) {
                    echo "<a class='img-logout' href='logout.php'><img src='user-logged.png' class='logout image' id='user-logged'></a>";
                }else {
                    echo "<img src='user.png' class='user images' id='user-mobile'>";
                }
            ?>
        </nav>
</header>

<section id="login-modal" class="modals">
        <div class="modal">
            <div class="modal-title">
                <h2>Account JustWatch</h2>
                <div class="modal-close">X</div>
            </div>
            <form name="login-form">
                <div class="modal-body">
                    <div class="horizontal">
                        <span>Email:</span><input type="text" name="email" class="email">
                    </div>
                    <div class="horizontal">
                        <span>Password:</span><input type="password" name="password" class="password">
                    </div>
                    <div class="horizontal" id="register">
                        <p>Non hai ancora un account?</p><a id="change-modal">Registrati</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="modal-buttons">
                        <input type="submit" class="enter" value="login">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section id="register-modal" class="modals">
        <div class="modal">
            <div class="modal-title">
                <div id="back">&#x21E6;</div>
                <h2>Account JustWatch</h2>
                <div class="modal-close">X</div>
            </div>
            <form name="registration-form">
                <div class="modal-body">
                    <div class="horizontal">
                        <span>Email:</span><input type="text" name="email" class="email">
                    </div>
                    <div class="horizontal">
                        <span>Nome:</span><input type="text" name="name" id="name">
                    </div>
                    <div class="horizontal">
                        <span>Cognome:</span><input type="text" name="surname" id="surname">
                    </div>
                    <div class="horizontal">
                        <span>Password:</span><input type="password" name="password" class="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="modal-buttons">
                        <input type="submit" class="enter" value="Registrati">
                    </div>
                </div>
            </form>
        </div>
    </section>