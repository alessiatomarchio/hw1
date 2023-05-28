<?php

include 'auth.php';
if (!checkAuth()) {
 
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


$query = "DELETE FROM preferiti WHERE userid = $id_User AND ricetteid = $id_Ricetta" ;

$res = mysqli_query($conn,$query);
if ($res) {
    mysqli_close($conn); 
    $variabile = $id_Ricetta;
    echo json_encode(array("id_ricetta" => $variabile));
    }

}



?>