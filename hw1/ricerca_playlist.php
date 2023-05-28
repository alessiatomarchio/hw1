<?php

    /* credenziali OAuth2 Spotify */

    $clientID = "c9c5e5c8fc1546bb8921ed37a646ad13";
    $clientSecret = "a34269e6aa2c43cabbcf05d189fdfa09";
    $token; /*variabile che conterrà il token OAuth2 Spotify */
        
    // ACCESS TOKEN
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token' );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    # Eseguo la POST
    curl_setopt($ch, CURLOPT_POST, 1);
    # Setto body e header della POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($clientID.':'.$clientSecret))); 
    $token=json_decode(curl_exec($ch), true);
    curl_close($ch); 

    // QUERY EFFETTIVA

    if($_POST["modalita"] == "album") {
        $url = "https://api.spotify.com/v1/search?type=album&limit=10&q=" . urlencode($_POST["object"]);
    }
    elseif($_POST["modalita"]== "titoloCanzone"){
        $url = "https://api.spotify.com/v1/search?type=track&limit=10&q=" . urlencode($_POST["object"]);
    }
    elseif($_POST["modalita"]== "artista"){
        $url = "https://api.spotify.com/v1/search?type=artist&limit=10&q=" . urlencode($_POST["object"]); 
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    # Imposto il token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
    $res=curl_exec($ch);
    curl_close($ch);
    
    echo $res;
?>