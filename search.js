function update(){
    const searchTerm = searchInput.value;
    if (searchTerm.trim() === '') {
        searchResults.innerHTML = '';
    }
    fetch('search.php?term=' + searchTerm).then(onResponse()).then(onJson());
}

const searchInput = document.getElementById('search-input');
const searchResults = document.getElementById('search-results');
searchInput.addEventListener('input', update());

function onJson(json) {
    searchResults.innerHTML = ''; // Pulisci i risultati precedenti
    if (//json vuoto) {
        searchResults.innerHTML = '<p>Nessun risultato trovato.</p>';
    } else {
        const row = document.createElement('div');
        // results.forEach(result => {
        //     const li = document.createElement('li');
        //     li.textContent = result.title; // Assumi che ogni risultato abbia un campo "title"
        //     ul.appendChild(li);
        // });
    }
    searchResults.style.display = 'block'; // Mostra i risultati
}