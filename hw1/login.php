<?php
    

    include 'auth.php';

    #CONTROLLO SE L'AMMINISTRATORE HA INSERITO LA PASSWORD SBAGLIATA PER IL LOGIN ADMIN 
    if(isset($_GET["errore"])) {
        $erroreAdmin = true; 
    }

    //chiamo checkAuth() in modo che vengano settate le variabili di sessione
    //dentro checkAuth() viene comunque richiamata session_start() per cui vengono recuperate tutte le variabili di sessione attive
    if (checkAuth()) {
        //vai alla home e arresta lo script php
        header("Location: home.php");
        exit;
    }

    #CONTROLLO CHE ESISTA UN UTENTE CON LE CREDENZIALI FORNITE


    if(isset($_POST["username"]) && isset($_POST["password"])) {

        $conn = mysqli_connect("localhost","root","","hw1");

        $username = mysqli_real_escape_string($conn,$_POST["username"]);
        $password = mysqli_real_escape_string($conn,$_POST["password"]);

        $query = "SELECT id,username,password FROM users WHERE username='".$username."'";

        $res = mysqli_query($conn,$query);
        if (mysqli_num_rows($res) > 0) {  
            $row = mysqli_fetch_assoc($res);


            if (password_verify($_POST["password"],$row["password"])) {

                $_SESSION["username"] = $row['username'];
                $_SESSION["id_user"] = $row['id'];

                mysqli_free_result($res);
                mysqli_close($conn);

                #reindirizzo verso la home 
                header('Location: home.php');

                exit;
            } 

            else {
                //flag di errore
                $erroreUser = true;
            }

        }

        else {
            //flag di errore
            $erroreUser = true;
        }

    }

?>

<!DOCTYPE html>
 <head>
        <title>Ricette fit: quando mangiare sano e' anche divertente</title>
        <link rel="stylesheet" href="login_style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">     

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
                        <label class="Label">Username<input type="text" name="username"></label>
                        <span class="hidden">
                        </p>

                        <p class="Container">
                        <label class="Label">Password<input type="password" name="password"></label>
                        <span class="hidden">
                        </p>

                        <p class="Container"> 
                        <label class="Label">&nbsp;<input type="submit" value="Accedi"></label>
                        </p>


                        <div id="link">
                        <!-- faccio spazio tra il punto interrogativo ed il link-->
                        <div>Non hai ancora un account? &nbsp; <a href="signup.php"> Registrati</a></div>
                        </div>

                      </form>


                    </main>

            </article>
               
            <footer>
                   <form class="Form" method = "post" action = "adminHome.php"> 
                   <?php
                        // Verifica la presenza di errori
                        if(isset($erroreAdmin))
                        {
                            echo "<p id='erroreAdmin'>";
                            echo "Password non valida.";
                            echo "</p>";
                        }
                         ?>  
                     <p class="Container">
                     <label class="Label">Password Admin<input type="password" name="loginAmministratore"><input type="submit" value="Accedi"></label> 
                     </p> 
                   </form>
                  <p id="Product">
                  Sito Web realizzato da </br>
                  Alessia Provvidenza Tomarchio 
                  </p> 
            </footer>
    
    </body>
</html>