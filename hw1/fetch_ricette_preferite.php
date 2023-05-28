<?php

require_once 'auth.php';
    
if (!checkAuth()) {
    header("Location: login.php");
    exit;
}

$conn= mysqli_connect("localhost", "root","","hw1" ); 
$risultati = array(); 
$session = mysqli_real_escape_string($conn, $_SESSION["id_user"]);
$query = "SELECT * FROM ricette WHERE id in (SELECT ricetteid FROM preferiti WHERE userid = ". $session. ")";

$res = mysqli_query($conn,$query);
while($row= mysqli_fetch_assoc($res)){

$risultati[]= $row;

}
mysqli_free_result($res); 
mysqli_close($conn); 

echo json_encode($risultati);
?>