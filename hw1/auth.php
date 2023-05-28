<?php
               

    session_start();

    function checkAuth() {
        
        if(!isset($_SESSION['id_user'])) {

            if (isset($_COOKIE['id_user']) && isset($_COOKIE['token']) && isset($_COOKIE['cookie_id'])) { 
                $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
                
                $cookieid = mysqli_real_escape_string($conn, $_COOKIE['cookie_id']);
                $userid = mysqli_real_escape_string($conn, $_COOKIE['id_user']);

                $res = mysqli_query($conn, "SELECT * FROM cookies WHERE id = $cookieid AND id_user = $userid");
                if ($cookie = mysqli_fetch_assoc($res)) {
                    if(time() > $cookie['time']) {
                        mysqli_query($conn, "DELETE FROM cookies WHERE id = ".$cookie['id']) or die(mysqli_error($conn));
                        header('Location: logout.php');
                        exit;
                    } else if (password_verify($_COOKIE['token'], $cookie['hash'])) {
                        $_SESSION['id_user'] = $_COOKIE['id_user'];
                        mysqli_close($conn);
                        return true;
                    }
                }
                mysqli_close($conn);
            }
            return false;
        } else {
            return true; //ritorno vero perchè la sessione e' già attiva. 
        }
    }

?>