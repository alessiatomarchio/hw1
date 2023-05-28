<?php

$conn= mysqli_connect("localhost", "root","","hw1" ); 
$risultati = array(); 
$query = "SELECT * FROM ricette"; 
$res = mysqli_query($conn,$query);
while($row= mysqli_fetch_assoc($res)){

$risultati[]= $row;

}
mysqli_free_result($res); 
mysqli_close($conn); 

echo json_encode($risultati);
?>