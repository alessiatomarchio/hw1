<?php

include 'auth.php';

//chiamo checkAuth() in modo che vengano settate le variabili di sessione, se la sessione e' attiva
//dentro checkAuth() viene comunque richiamata session_start() per cui vengono recuperate tutte le variabili di sessione attive
if (!checkAuth()) {
    //vai alla login e arresta lo script php
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
 <head>
        <title>Ricette fit: quando mangiare sano e' anche divertente</title>
        <link rel="stylesheet" href="home.css"/>
        <script src="home.js" defer></script>
        <script src="common_script.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Playfair:wght@300&display=swap" rel="stylesheet">    

 </head>
    <body>
    <div class="overlay"></div>
        <article>
            <h1>FitForEat il blog di ricette sane e proteiche di Alessia</h1>
            <h3> Benvenuto @
            <?php
            $username= $_SESSION["username"];
            echo $username;
            ?>
            </h3>
                <nav id="navbar"> 
                  <a class="links" href="preferiti.php">LE MIE RICETTE PREFERITE</a>
                  <a class="links" href="RicercaPlaylist.php">ASCOLTA PLAYLIST</a>
                  <a class="links" href="logout.php">ESCI</a>
                </nav>
                  <div id="menu" class="hidden">
                   <div></div>
                   <div></div>
                   <div></div>
                  </div>
                <div id="menu_view" class="hidden">
                  <a class="links" href="preferiti.php">LE MIE RICETTE PREFERITE</a>
                  <a class="links" href="RicercaPlaylist.php">ASCOLTA PLAYLIST</a>
                  <a class="links" href="logout.php">ESCI</a>
                  <em>Chiudi menu</em>
                </div>
                    <main>   <!-- qui dentro ci saranno le ricette prese dal database-->  </main>

          </article>
              <footer> 
                  <p id="Product">
                  Sito Web realizzato da </br>
                  Alessia Provvidenza Tomarchio 
                  </p> 
             </footer>
    </body>
</html>