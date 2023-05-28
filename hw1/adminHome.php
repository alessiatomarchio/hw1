<?php

  if(isset($_POST["loginAmministratore"])) {
      $conn = mysqli_connect("localhost","root","","hw1");
      $query = "SELECT password FROM admin"; 
      $res = mysqli_query($conn,$query);
      if (mysqli_num_rows($res) > 0) {  
          $row = mysqli_fetch_assoc($res);


          if ($_POST["loginAmministratore"] === $row["password"]) {

            mysqli_free_result($res);
            mysqli_close($conn);
          } 

          else {
              //ci spostiamo alla login con errore 
              header('Location: login.php?errore=true');
          }

      } else
            //ci spostiamo alla login con errore 
            header('Location: login.php?errore=true');
    } elseif (isset($_POST["titolo"]) && isset($_POST["ingredienti"]) && isset($_POST["foto"]) && isset($_POST["procedimento"])) 
    {

        $conn = mysqli_connect("localhost","root","","hw1");


        #INSERIMENTO RICETTA NEL DATABASE

        $titolo = mysqli_real_escape_string($conn,$_POST["titolo"]);
        $ingredienti = mysqli_real_escape_string($conn,$_POST["ingredienti"]);
        $foto = mysqli_real_escape_string($conn,$_POST["foto"]); 
        $procedimento= mysqli_real_escape_string($conn,$_POST["procedimento"]);

        $query = "INSERT INTO ricette (titolo, ingredienti, foto, procedimento) VALUES ('$titolo', '$ingredienti', '$foto', '$procedimento')";

        $res =  mysqli_query($conn,$query);
        if($res){
        mysqli_close($conn);
        }
  
    } elseif (isset($_POST["titolo_eliminazione"])) 
    {
   
           $conn = mysqli_connect("localhost","root","","hw1");
   
   
           #ELIMINAZIONE RICETTA DEL DATABASE
   
           $titolo_eliminato = mysqli_real_escape_string($conn,$_POST["titolo_eliminazione"]);
          
   
           $query = "DELETE FROM ricette WHERE titolo ='$titolo_eliminato'";
   
           $res =  mysqli_query($conn,$query);
           if($res){
           mysqli_close($conn);
           }
     
       } else {
        header('Location: login.php');
       }


?>

<!DOCTYPE html>
    <head>
        <title>Ricette fit: quando mangiare sano e' anche divertente</title>        
        <link rel="stylesheet" href="signup.css"/>
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
             <p id="descrizione"> Inserimento di tutte le ricette con tutte le informazioni</p>
        <main>

                <form class="Form" method = "post">   

                   <p class="Container">
                   <label class="Label">Titolo Ricetta<input type="text" name="titolo"></label>
                   <span class="hidden">
                   </p>

                   <p class="Container">
                   <label class="Label">Ingredienti<textarea name="ingredienti"></textarea> </label>
                   <span class="hidden">
                   </p>
                    
                   <p class="Container">
                   <label class="Label">Foto<input type="text" name="foto"></label>
                   <span class="hidden">
                   </p>

                   <p class="Container">
                   <label class="Label">Procedimento<textarea name="procedimento"></textarea> </label>
                   <span class="hidden">
                   </p>
           
                   <p class="Container"> 
                   <label class="Label">&nbsp;<input type="submit" value="Carica"></label>
                   </p>
                   

                </form>

                <form class="Form" method = "post">   
                
                 <p class="Container">
                   <label class="Label">Titolo Ricetta<input type="text" name="titolo_eliminazione"></label>
                   <span class="hidden">
                   </p>
        
                 <p class="Container"> 
                 <label class="Label">&nbsp;<input type="submit" value="Elimina Ricetta"></label>
                 </p>
                 
                </form> 


        </main>

        </article>

       <footer>
       <a href="logout.php">TORNA ALLA LOGIN</a>
        <p id="Product">
        Sito Web realizzato da </br>
        Alessia Provvidenza Tomarchio 
       </p> 
       </footer>

     </body>
</html>