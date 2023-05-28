<?php

    require_once 'auth.php';

    
    if (!checkAuth()) {
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect("localhost","root","","hw1");

    $id_User = mysqli_real_escape_string($conn,$_SESSION["id_user"]);
    $id_Ricetta = mysqli_real_escape_string($conn,$_POST["ricetta"]);  

    $query = "SELECT * FROM preferiti WHERE userid = $id_User AND ricetteid = $id_Ricetta";

    $res = mysqli_query($conn,$query);

 

    if (mysqli_num_rows($res) > 0) {
        echo json_encode(array("id_ricetta" => $id_Ricetta, "preferito" => true)); 
    }
    else {
        echo json_encode(array("id_ricetta" => $id_Ricetta, "preferito" => false)); 
    }

          
    //Libera le risorse e chiude la connessione
    mysqli_free_result($res);
    mysqli_close($conn);

?>