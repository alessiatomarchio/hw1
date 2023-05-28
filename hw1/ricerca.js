function generaPlaylist(json,sez_playlist_trovate) {

    console.log(json);


    if(json.tracks !== undefined) {
        
        for(key of json.tracks.items) {

            let divBloccoSong = document.createElement('div'); 
            divBloccoSong.classList.add("blocco_song"); 
            sez_playlist_trovate.appendChild(divBloccoSong); 
            let imageSong = document.createElement('img');
            imageSong.src = key.album.images[1].url; 
            divBloccoSong.appendChild(imageSong); 
            let a = document.createElement('a'); 
            a.textContent = "Clicca qui per ascoltare"; 
            a.href = key.external_urls.spotify; 
            divBloccoSong.appendChild(a); 
            
        }

    } else if (json.albums != undefined) {
                
        for(key of json.albums.items) {

            let divBloccoSong = document.createElement('div'); 
            divBloccoSong.classList.add("blocco_song"); 
            sez_playlist_trovate.appendChild(divBloccoSong); 
            let imageSong = document.createElement('img');
            imageSong.src = key.images[1].url; 
            divBloccoSong.appendChild(imageSong); 
            let a = document.createElement('a'); 
            a.textContent = "Clicca qui per ascoltare"; 
            a.href = key.external_urls.spotify; 
            divBloccoSong.appendChild(a); 
            
        }
    } 
    else if (json.artists !== undefined) {

        for(key of json.artists.items) {

            let divBloccoSong = document.createElement('div'); 
            divBloccoSong.classList.add("blocco_song"); 
            sez_playlist_trovate.appendChild(divBloccoSong); 
            let imageSong = document.createElement('img');
            imageSong.src = key.images[1].url; 
            divBloccoSong.appendChild(imageSong); 
            let a = document.createElement('a'); 
            a.textContent = "Clicca qui per ascoltare"; 
            a.href = key.external_urls.spotify; 
            divBloccoSong.appendChild(a); 
            
        }

    }


}

function onSearchJson(json) {

    console.log(json);

    const sez_playlist_trovate = document.querySelector("#sez_playlist_trovate");
    sez_playlist_trovate.innerHTML = "";

    let variabile;

    if (json.albums != undefined) {
        variabile = json.albums;
    }  else if(json.tracks != undefined) {
        variabile = json.tracks;
    } else if(json.artists != undefined) {
        variabile = json.artists;
    }


    if (variabile.items.length === 0) {
        //mostro il messaggio "nessuna playlist trovata"
        const avviso = document.querySelector("#ric_null");
        avviso.textContent = "La ricerca non ha prodotto alcun risultato";
        avviso.classList.remove("hidden");
    }
    else generaPlaylist(json,sez_playlist_trovate);
}

function onResponse(response) {
    return response.json();
}

function onSubmit(event) {

    const form = event.currentTarget;

    if (form.object.value === "") {
        const errore = document.querySelector("#errore");
        errore.classList.remove("hidden");
        errore.textContent = "Errore! Barra di ricerca vuota";
    }
    else {
        //NASCONDO TUTTE QUELLO CHE E' COLLEGATO ALLA RICERCA DELLE PLAYLIST TANTO VERRA' MOSTRATO DOPO CHE LA FETCH AVRA' AVUTO SUCCESSO
        document.querySelector("#ric_null").classList.add("hidden");
        document.querySelector("#errore").classList.add("hidden");
        /* invio richiesta con Post */ 
        const form_data = {method: 'post', body: new FormData(form)};
        fetch("ricerca_playlist.php", form_data).then(onResponse).then(onSearchJson);
    }

    //impedisci submit
    event.preventDefault();
}

const form = document.querySelector('form');
form.addEventListener('submit', onSubmit); 