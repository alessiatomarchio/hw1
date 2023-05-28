<?php

include 'auth.php';

//chiamo checkAuth() in modo che se c'è un cookie valido vengano settate le variabili di sessione
//dentro checkAuth() viene comunque richiamata session_start() per cui vengono recuperate tutte le variabili di sessione attive
if (!checkAuth()) {
    //vai alla login e arresta lo script php
    header("Location: login.php");
    exit;
}

if(isset($_POST["ricettaid"]))
{

$id_Ricetta= $_POST["ricettaid"]; 
$id_User = $_SESSION["id_user"]; 

$conn = mysqli_connect("localhost","root","","hw1");
$id_Ricetta= mysqli_real_escape_string($conn,$_POST["ricettaid"]);
$id_User = mysqli_real_escape_string($conn,$_SESSION["id_user"]);


$query = "INSERT INTO preferiti (userid,ricetteid) VALUES ('". $id_User ."','". $id_Ricetta ."')";

$res = mysqli_query($conn,$query);
if ($res) {
    mysqli_close($conn); 
    $variabile = $id_Ricetta;
    echo json_encode(array("id_ricetta" => $variabile));
    }

}


?>