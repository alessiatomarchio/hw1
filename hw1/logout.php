<?php
    
    #CANCELLA I DATI DI SESSIONE E RITORNA ALLA LOGIN

    //in questo modo si recuperano tutte le variabili di sessione settate
    session_start();

    //distruggo tali variabili
    session_destroy();

    //reindirizza alla login
    header("Location: login.php");
?>