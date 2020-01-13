(() => {

    const table = document.getElementById("vehicleTable");
    const rows = table.rows;
    const links = document.querySelectorAll('table tbody tr td a');

    const clickedOnItem = (event) => {
        let clickedRow = event.target;
        redirectTo(clickedRow.children[0].href)
    }

    const redirectTo = (url) => {
        if(url) {
            window.location.href = url;
        }
    }

    for(let i = 0; i < links.length; i++) {
        let row = rows[(i + 1)];
        let link = links[i];

        link.style.pointerEvents = 'none';
        link.addEventListener('click', function(e) {
            e.preventDefault();
        });

        row.addEventListener('click', clickedOnItem);
    }


})();