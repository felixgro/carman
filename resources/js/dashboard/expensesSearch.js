/**
 * Script für AutoComplete bei der Expenses Suche
 * und für Click Events bzgl. Expenses Cards
 */
(() => {

    // Autocomplete
    const txtSearch = document.getElementById("search");
    txtSearch.addEventListener('keyup', event => {

        let value = txtSearch.value;

        if(value.length > 2) {
            sendSearchRequest(value);
        }
    });

    const sendSearchRequest = value => {
        console.log(value)
    }

    // Expenses Klick Events
    const cards = document.querySelectorAll('.card-item');
    for(let i = 0; i < cards.length; i++) {
        cards[i].addEventListener('click', (event) => {
            console.dir(event.target.dataset.id);
            window.location.href = "/expenses/" + event.target.dataset.id;
        });
    }
})();