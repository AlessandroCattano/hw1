function Update(json){
    console.log("Update: aggiornamento dello stato");
    console.log(json);
    if(json.success === true){
        const symbol = document.querySelector("#add-to-list");
        symbol.innerHTML = "&#x2713;";
    }else if(json.failed === false){
        console.log("Operazione non riuscita");
    }
}

function AddToList(){
    const url = "Add.php?id="+single_id;
    fetch(url).then(onResponse).then(Update);
}

function addSection(json){
    console.log("addSection: json nuovo commento ");
    console.log(json);
    if(json.error){
        const LoginModal = document.querySelector('#login-modal');
        document.body.classList.add('no-scroll');
        LoginModal.classList.add('show');
    }else if(json.zero){
        const commentsElement = document.querySelector('#comments');
        const container = document.createElement('div');
        container.id= "zero-comment";
        const paragraph = document.createElement('h3');
        paragraph.classList.add("user-comment");
        paragraph.textContent = json.zero;
        container.appendChild(paragraph);
        commentsElement.appendChild(container);
    }else{
        const commentsElement = document.querySelector('#comments');
        
        for (let i=0; i<json.length; i++){
            const container = document.createElement('div');
            container.classList.add("single-comment");
            
            const paragraph = document.createElement('h3');
            paragraph.classList.add("user-comment");
            paragraph.textContent = json[i].name+ " " + json[i].surname;
    
            const span_date= document.createElement('span');
            span_date.classList.add("comment-date");
            span_date.textContent="   ( "+ json[i].data+ " )";
    
            paragraph.appendChild(span_date);
    
            const comment_text = document.createElement('p');
            comment_text.classList.add("text-content");
            comment_text.textContent = json[i].text;
            
            container.appendChild(paragraph);
            container.appendChild(comment_text);
            commentsElement.appendChild(container);
        }
    }
}

function AddComment(event){
    event.preventDefault();
    const error_label = document.querySelector("#error_label");
    const textarea= document.querySelector('textarea');
    const test = /^\s*$/.test(textarea.value);
    if (!test){
        error_label.textContent = '';
        const comment_form = document.forms['comment-form'];
        const formData = new FormData(comment_form);
        formData.append('imdb_id', single_id); 
        textarea.value="";
        const zero = document.querySelector("#zero-comment");
        if(zero)zero.remove();
        fetch("addReviews.php", {
                method: 'post', 
                body: formData
            }).then(onResponse).then(addSection);
    }else{
        
        error_label.textContent = "Commento non valido"; 
    }    
}

function loadReviews(json){
    const commentsElement = document.querySelector("#comments");

    const form = document.createElement('form');
    form.id = "insert-comment";
    form.name="comment-form";

    const label = document.createElement('p');
    label.id = "label-insert-comment";
    label.textContent = "Lascia un commento per questo contenuto: "
    commentsElement.appendChild(label);
    
    const textarea = document.createElement("textarea");
    textarea.name = "text-area";
    form.appendChild(textarea);

    const button = document.createElement("input");
    button.type = "submit";
    button.value = "Commenta";
    button.id= "comment-button";
    button.addEventListener('click', AddComment);
    form.appendChild(button);
    
    commentsElement.appendChild(form);

    const error_label = document.createElement('p');
    error_label.id = "error_label";
    commentsElement.appendChild(error_label);
    
    console.log("loadReviews: commenti");
    console.log(json);
    addSection(json);

    const loading = document.querySelector("#loading-scene");
    loading.classList.add('hide');
    details.classList.remove('hide');
}

function printProviders(json){
    const inside = document.querySelector('#inside');

    const providers = document.createElement("div");
    providers.id = "provider-div";

    const provParagraph = document.createElement("span");
    provParagraph.id = "providerParagraph";
    provParagraph.textContent = "Guardalo su: ";
    providers.appendChild(provParagraph);

    for(let i=0; i<json.length; i++){
        const link = document.createElement("a");
        link.classList.add("provider_url");
        link.href = json[i].url;
        link.textContent = " -- " + json[i].name+ " ";
        providers.appendChild(link);
    }

    inside.appendChild(providers);
}

function onJsonProvider(json){
    console.log("json provider: " + json);
    console.log(json);
    const providerElement =document.querySelector('#provider-div');
    if (providerElement) {
        providerElement.remove();
    }
    const trackElement = document.querySelector('#track');
    if (trackElement) {
        trackElement.remove();
    }
    const commentsElement = document.querySelector('#comments');
    if (commentsElement) {
        commentsElement.remove();
    }

    printProviders(json);
    const url_track = "getTrack.php?title="+title;
    fetch(url_track).then(onResponse).then(onJsonSpotify);      
}

function onJsonSpotify(json) {
    console.log("onJsonSpotify: json link spotify");
    console.log(json);
    const track_url = json.tracks.items[0].external_urls.spotify;
    const inside = document.querySelector('#inside');
    const track = document.createElement("div");
    track.id = "track";
    const trackParagraph = document.createElement("p");
    trackParagraph.id = "trackParagraph";
    const link = document.createElement("a");
    link.href = track_url;
    link.textContent = "qui";
    link.id = "song_url";
    trackParagraph.textContent = "Ascolta la traccia su Spotify ";
    trackParagraph.appendChild(link);
    track.appendChild(trackParagraph);
    inside.appendChild(track);

    const reviews = document.createElement("div");
    reviews.id = "comments";
    inside.appendChild(reviews);

    const url_reviews = "getReviews.php?id="+single_id;
    fetch(url_reviews).then(onResponse).then(loadReviews);  
}

function selectOption(json){
    console.log('selectOption: json del controllo della sessione');
    console.log("json");
    const optionsDiv = document.createElement("div");
    optionsDiv.id = "options";
    const addToListParagraph = document.createElement("p");
    addToListParagraph.id = "add-to-list";
    if(json.success === true){
        addToListParagraph.innerHTML = "&#x2713;";
    }else if(json.failed === false){
        addToListParagraph.textContent = "+";
        addToListParagraph.addEventListener('click', AddToList);
    }else{
        console.log("selectOption: nessun accesso rilevato");
    }
    
    optionsDiv.appendChild(addToListParagraph);
    const titleMovie = document.querySelector('#content-title');
    titleMovie.appendChild(optionsDiv);
}


function onJson(json) {
    console.log("onJson: carico i dettagli principali");
    console.log(json);  
    json = json[single_id];
    const insideLeft = document.querySelector('#inside-left');
    const insideRight = document.querySelector('#inside-right');
    const img = document.querySelector('#left img');
    const titleMovie = document.querySelector('#content-title');
    titleMovie.innerHTML = '';
    insideLeft.innerHTML = '';
    insideRight.innerHTML = '';

    const poster = json.Poster || 'webicon.png';
    const title = json.Title || 'N/A';

    img.src = poster;

    const rating = json.imdbRating || 'N/A';
    const runtime = json.Runtime || 'N/A';
    const languages = json.Language || 'N/A';
    const releaseDate = json.Released || 'N/A';
    const boxOffice = json.BoxOffice || 'N/A';
    const Seasons = json.totalSeasons || 'N/A';

    const genres = json.Genre || 'N/A';
    const plot = json.Plot || 'N/A';
    const directors = json.Director || 'N/A';
    const actors = json.Actors || 'N/A';

    const titleParagraph = document.createElement("p");
    titleParagraph.textContent = "titolo:";
    titleMovie.appendChild(titleParagraph);

    const titleHeading = document.createElement("h1");
    titleHeading.id = "title-movie";
    titleHeading.textContent = title;
    titleMovie.appendChild(titleHeading);

    const url = "Check.php?id="+single_id;
    fetch(url).then(onResponse).then(selectOption);

    const ratingDiv = document.createElement("div");
    ratingDiv.id = "rating";
    ratingDiv.classList.add("ileft");
    const ratingParagraph = document.createElement("p");
    ratingParagraph.textContent = "Rating: " + rating;
    ratingDiv.appendChild(ratingParagraph);
    insideLeft.appendChild(ratingDiv);

    const runtimeDiv = document.createElement("div");
    runtimeDiv.id = "runtime";
    runtimeDiv.classList.add("ileft");
    const runtimeParagraph = document.createElement("p");
    runtimeParagraph.textContent = "Runtime: " + runtime;
    runtimeDiv.appendChild(runtimeParagraph);
    insideLeft.appendChild(runtimeDiv);

    const languagesDiv = document.createElement("div");
    languagesDiv.id = "languages";
    languagesDiv.classList.add("ileft");
    const languagesParagraph = document.createElement("p");
    languagesParagraph.textContent = "Supported languages: " + languages;
    languagesDiv.appendChild(languagesParagraph);
    insideLeft.appendChild(languagesDiv);

    const releaseDateDiv = document.createElement("div");
    releaseDateDiv.id = "releasedate";
    releaseDateDiv.classList.add("ileft");
    const releaseDateParagraph = document.createElement("p");
    releaseDateParagraph.textContent = "Release Date: " + releaseDate;
    releaseDateDiv.appendChild(releaseDateParagraph);
    insideLeft.appendChild(releaseDateDiv);

    const type = json.Type;
    if (type === "series") {
        const SeasonDiv = document.createElement("div");
        SeasonDiv.id = "Seasons";
        SeasonDiv.classList.add("ileft");
        const SeasonParagraph = document.createElement("p");
        SeasonParagraph.textContent = "Seasons: " + Seasons;
        SeasonDiv.appendChild(SeasonParagraph);
        insideLeft.appendChild(SeasonDiv);
    }
    else {
        const boxOfficeDiv = document.createElement("div");
        boxOfficeDiv.id = "boxoffice";
        boxOfficeDiv.classList.add("ileft");
        const boxOfficeParagraph = document.createElement("p");
        boxOfficeParagraph.textContent = "Incassi: " + boxOffice;
        boxOfficeDiv.appendChild(boxOfficeParagraph);
        insideLeft.appendChild(boxOfficeDiv);
    }

    const genresDiv = document.createElement("div");
    genresDiv.id = "genres";
    genresDiv.classList.add("iright");
    const genresParagraph = document.createElement("p");
    genresParagraph.textContent = "Genres: " + genres;
    genresDiv.appendChild(genresParagraph);
    insideRight.appendChild(genresDiv);

    const plotDescriptionDiv = document.createElement("div");
    plotDescriptionDiv.id = "plot-description";
    plotDescriptionDiv.classList.add("iright");
    const plotDescriptionParagraph = document.createElement("p");
    plotDescriptionParagraph.textContent = "Plot: " + plot;
    plotDescriptionDiv.appendChild(plotDescriptionParagraph);
    insideRight.appendChild(plotDescriptionDiv);

    const directorsDiv = document.createElement("div");
    directorsDiv.id = "directors";
    directorsDiv.classList.add("iright");
    const directorsParagraph = document.createElement("p");
    directorsParagraph.textContent = "Directors: " + directors;
    directorsDiv.appendChild(directorsParagraph);
    insideRight.appendChild(directorsDiv);

    const actorsDiv = document.createElement("div");
    actorsDiv.id = "actors";
    actorsDiv.classList.add("iright");
    const actorsParagraph = document.createElement("p");
    actorsParagraph.textContent = "Actors: " + actors;
    actorsDiv.appendChild(actorsParagraph);
    insideRight.appendChild(actorsDiv);

    const url_provider = "getProviders.php?id="+single_id;
    fetch(url_provider).then(onResponse).then(onJsonProvider);
    
}

function onResponse(response) {
    return response.json();
}

function getdetails(clickedPoster) {
    single_id = clickedPoster.id;
    console.log("getdetails: singolo imdb da caricare: " + single_id);
    fetch('omdb.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify([single_id])
    }).then(onResponse).then(onJson);
}

function showdet(event) {
    grid.classList.add('hide');
    const backgrid = document.querySelector('#backtogrid');
    backgrid.addEventListener('click', backtogrid);
    const loading = document.querySelector("#loading-scene");
    loading.classList.remove('hide');
    const clickedPoster = event.currentTarget;
    getdetails(clickedPoster);
}

function backtogrid() {
    grid.classList.remove('hide');
    details.classList.add('hide');
}

function createlinks(json) {
    console.log("createlinks: json dei risultati da visualizzare");
    console.log(json);
    const posters = document.querySelector('#grid');
    const key = Object.keys(json);
    for (const imdbId of key) { 
        const img = document.createElement("img");
        if (json[imdbId] && json[imdbId].Poster) {
            img.src = json[imdbId].Poster;
            img.id = imdbId;
            img.addEventListener('click', showdet);
        } else {
            console.log('createlinks: Nessun dato trovato per imdbID:' + imdbId);
            img.src = 'webicon.png';
        }
        img.classList.add("poster");
  
        const loading =document.querySelector('#loading-scene');
        loading.classList.add('hide');
        const title = document.querySelector("#list");
        title.classList.remove('hide');
        posters.appendChild(img);
    }
    const loading = document.querySelector("#loading-scene");
    loading.classList.add('hide');
    if (grid.classList.contains('hide'))list.classList.remove('hide');
}

function createposters(json) {
    console.log("createposters: json ricevuto di contenuti da caricare");
    console.log(json);
    if(json === null){
        console.log("createposters: nessun risultato")
    }else{
        fetch('omdb.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(json)
        }).then(onResponse).then(createlinks);
    }
}

function Getid(json){
    console.log("get id: json ricevuto dalla ricerca per titolo: ");
    console.log(json);
    const grid = document.querySelector("#grid");
    if (json.Error){
        console.log("Getid: contenuto inesistente");
        grid.innerHTML = '';
        return null;
    }else{
        grid.innerHTML = '';
        const loading = document.querySelector("#loading-scene");
        loading.classList.remove('hide');
        const list = document.querySelector("#list");
        list.classList.add('hide');
        const indexedJson = {};
        for (let i=0; i<json.Search.length; i++){
            indexedJson[i] = json.Search[i].imdbID;
        }
        console.log("Getid: json indicizzato da caricare: ")
        console.log(indexedJson);
        createposters(indexedJson);
    }
    
}

function searchContent(){
    const title = document.querySelector("#search-input");
    const value = title.value;
    const test = /^\s*$/.test(value);
    const grid = document.querySelector("#grid");
    if(test){
        console.log("searchContent: Input non valido");
        grid.innerHTML='';
    }else{
        const url = "Search.php?title="+value;
        fetch(url).then(onResponse).then(Getid);
    }    
}

const grid = document.querySelector('#list');
const details = document.querySelector('#details');

fetch('load_contents.php').then(onResponse).then(createposters);
let single_id = null;

const search = document.querySelector("#search-button");
search.addEventListener('click', searchContent);
