<?php

    //CONTROLLA CHE LO USERNAME NON SIA GIA' IN USO

    $conn = mysqli_connect("localhost","root","","hw1");

    $username = mysqli_real_escape_string($conn,$_GET["param"]);

    $query = "SELECT username FROM users WHERE username = '".$username."'";
    $res = mysqli_query($conn,$query);

    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_close($conn);
?>