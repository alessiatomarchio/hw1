function onVerPrefJson(json) {

    //stampo il json ricevuto
    console.log(json);

    const bool = json.preferito; //se true l'utente loggato ha messo la ricetta tra i preferiti
    const listaRicette = document.querySelectorAll(".blocco_Food"); 

    if (bool === true) {
        for (key of listaRicette) {
            if (key.dataset.idBlocco === json.id_ricetta) {
                const bloccoLike = key.querySelector("div");
                const image = bloccoLike.querySelector("img");
                image.src="likered.png";
                image.addEventListener("click",eliminaDaiPreferiti);
                image.removeEventListener("click",onHeartClick);
            }
        }
    }
    else {
        for (key of listaRicette) { 
            if (key.dataset.idBlocco === json.id_ricetta)  {
                const bloccoLike = key.querySelector("div");
                const image = bloccoLike.querySelector("img");
                image.src="like.png";
                image.addEventListener("click",onHeartClick);
                image.removeEventListener("click",eliminaDaiPreferiti);
            }
        }
    }
} 
function onRicetteJson(json){
    console.log(json); 
    for(food of json){
    let mainSection = document.querySelector("main");

    let divBloccoFood = document.createElement('div'); 
    divBloccoFood.dataset.idBlocco = food.id;

    divBloccoFood.classList.add("blocco_Food"); 
    mainSection.appendChild(divBloccoFood);

    let titoloFood = document.createElement('p');
    titoloFood.classList.add("titolo_food");
     
    let titolo= food.titolo; 
    titoloFood.textContent = titolo; 
    divBloccoFood.appendChild(titoloFood); 

    let imageFood= document.createElement('img'); 
    imageFood.src = food.foto; 
    divBloccoFood.appendChild(imageFood); 

    let ingredientiFood = document.createElement('p'); 
    ingredientiFood.classList.add("ingredienti");

    let ingredienti = food.ingredienti; 
    ingredientiFood.textContent= ingredienti; 
    divBloccoFood.appendChild(ingredientiFood); 

    let procedimentoFood = document.createElement('p'); 
    procedimentoFood.classList.add("procedimento");

    let procedimento = food.procedimento; 
    procedimentoFood.textContent= procedimento; 
    divBloccoFood.appendChild(procedimentoFood); 

   let BloccolikeFood = document.createElement('div'); 
    BloccolikeFood.classList.add("blocco_like"); 
    divBloccoFood.appendChild(BloccolikeFood); 

    let fotoLike = document.createElement('img');
    fotoLike.src= "like.png"; 
    fotoLike.addEventListener('click', onHeartClick);
    BloccolikeFood.appendChild(fotoLike); 

    let textLike = document.createElement('em'); 
    textLike.textContent = "Aggiungi ai preferiti"; 
    BloccolikeFood.appendChild(textLike); 

    //chiamo la fetch per vedere se l'utente ha già inserito la ricetta tra i preferiti
    const formdata = new FormData();
    formdata.append("ricetta", food.id);
    fetch("verifica_preferito.php",{method: "post",body: formdata}).then(onResponse).then(onVerPrefJson);
    
    }
} 

function onResponse(response){
return response.json(); 
}


function aggiornaRicette() {
    fetch("fetch_ricette.php").then(onResponse).then(onRicetteJson); 
}

function onPreferitoEliminato(json){

    let array = document.querySelectorAll(".blocco_Food"); 
    for(key of array) {
     if(key.dataset.idBlocco === json.id_ricetta) {
        let bloccoLike = key.querySelector("div");
        let image = bloccoLike.querySelector("img");
        image.src ="like.png";
        image.addEventListener("click",onHeartClick);
        image.removeEventListener("click", eliminaDaiPreferiti);
    
     }
   }
}

function eliminaDaiPreferiti(event) {

    let image = event.currentTarget;
    let id_ricetta = image.parentNode.parentNode.dataset.idBlocco;
    const formdata = new FormData();
    formdata.append("ricettaid",id_ricetta);
    fetch("elimina_preferito.php",{method:"post",body:formdata}).then(onResponse).then(onPreferitoEliminato);
}

function onPreferitoSalvato(json) { 
    let array = document.querySelectorAll(".blocco_Food"); 
    for(key of array) {
        if(key.dataset.idBlocco === json.id_ricetta) {
            let bloccoLike = key.querySelector("div");
            let image = bloccoLike.querySelector("img");
            image.src ="likered.png";
            image.removeEventListener("click",onHeartClick);
            image.addEventListener("click", eliminaDaiPreferiti);
        }
    }
}

function onHeartClick(event) {
    //recuperiamo l'id associato alla ricetta selezionata
    
    let image = event.currentTarget;
    let id_ricetta = image.parentNode.parentNode.dataset.idBlocco;
    const formdata = new FormData();
    formdata.append("ricettaid",id_ricetta);
    fetch("salva_preferito.php",{method:"post",body:formdata}).then(onResponse).then(onPreferitoSalvato);
}

aggiornaRicette();