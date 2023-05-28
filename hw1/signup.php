<?php

    require_once "auth.php";

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }  

    # controllo la validità dei dati inseriti e prima di tutto se sono effettivamente stati inseriti
    if (isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST['conferma_password'])) 
    {

        $conn = mysqli_connect("localhost","root","","hw1");


        #REGISTRAZIONE NEL DATABASE

        $name = mysqli_real_escape_string($conn,$_POST["nome"]);
        $surname = mysqli_real_escape_string($conn,$_POST["cognome"]);
        $username = mysqli_real_escape_string($conn,$_POST["username"]); 
        $email= mysqli_real_escape_string($conn,$_POST["email"]);
        $password = mysqli_real_escape_string($conn,$_POST["password"]);
        //anzichè memorizzare in chiaro la password nel DB, ne memorizzo un hash
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users(username, password, name, surname, email) VALUES ('$username', '$password', '$name', '$surname', '$email')";

        //se l'esecuzione della query ritorna vero (l'utente è stato registrato) imposto delle variabili di sessione in modo che
        // l'utente appena registrato non debba rifare il login per accedere
        if (mysqli_query($conn,$query)) {

            session_start();

            $_SESSION["username"] = $_POST["username"];
            $_SESSION['id_user'] = mysqli_insert_id($conn);

            mysqli_close($conn);

            #reindirizzo verso la home
            header('Location: home.php');

            exit;
        }
        else {
            $errore[] = "Errore di connessione al database!";
        }

    }
?>

<!DOCTYPE html>
    <head>
        <title>Ricette fit: quando mangiare sano e' anche divertente</title>        <link rel="stylesheet" href="signup.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <script src="signup.js" defer></script> 
        
    </head>
        <body>
           <article>
           <img id="Background" src="Fragole.jpg"> </img>

             <header id="header"> </header>

             <h1>FitForEat il blog di ricette sane e proteiche di Alessia</h1>
             <p id="descrizione"> Accedi per trovare tutte le ricette piu' gustose e trai ispirazione per crearne di nuove con gli alimenti che più ti piacciono. </br>
              Mangiare sano non e' mai stato cosi' divertente! </p>
        <main>

                <form class="Form" method = "post">   

                   <?php
                   // Verifica la presenza di errori
                   if(isset($erroreUser))
                   {
                   echo "<p id='erroreUser'>";
                   echo "Credenziali non valide.";
                   echo "</p>";
                   }
                    ?>

                   <p class="Container">
                   <label class="Label">Nome<input type="text" name="nome"></label>
                   <span class="hidden">
                   </p>

                   <p class="Container">
                   <label class="Label">Cognome<input type="text" name="cognome"></label>
                   <span class="hidden">
                   </p>
                    
                   <p class="Container">
                   <label class="Label">Email<input type="text" name="email"></label>
                   <span class="hidden">
                   </p>

                   <p class="Container">
                   <label class="Label">Username<input type="text" name="username"></label>
                   <span class="hidden">
                   </p>

                   <p class="Container">
                   <label class="Label">Password<input type="password" name="password"></label>
                   <span class="hidden">
                   </p>

                   <p class="Container">
                   <label class="Label">Conferma Password<input type="password" name="conferma_password"></label>
                   <span class="hidden">
                   </p> 


                   <p class="Container"> 
                   <label class="Label">&nbsp;<input type="submit" value="Registrati"></label>
                   </p>

                    <div id="link">
                    <!-- faccio spazio tra il punto interrogativo ed il link-->
                    <div>Hai già un account? &nbsp; <a href="login.php"> Accedi</a></div>
                    </div>            


                </form>


        </main>

        </article>

       <footer>

         <p id="Product">
         Sito Web realizzato da </br>
         Alessia Provvidenza Tomarchio 
         </p> 
       </footer>

     </body>
</html>