(() => {
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
})();