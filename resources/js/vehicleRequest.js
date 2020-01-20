/*
    Sendet Ajax Request sobald Auswahl getroffen wurde. Als Response wird bei
    einen Fehler oder fehlender Befugnis 0 zurückgegeben. Ist die Request erfolgreich so giebt sie
    1 zurück.   
*/

// Vehicle Select Box am Header
const vehicleSelect = document.getElementById('vehicleSelect');
vehicleSelect.onchange = (event) => {
    event.preventDefault();

    let vehicleID = event.target.options[event.target.selectedIndex].value;

    // Sended die Benutzer ID  (userID) mit der angefragten Vehicle ID (vehicleID) als Post Aufruf
    let url = "/vehicles/setcurrent";
    let data = 'vehicleID=' + vehicleID + "&userID=" + document.getElementById('userID').value;
    console.log(data);

    let xhr = new XMLHttpRequest();

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

    xhr.onload = (event) => {
        if(xhr.status === 200) {
            // TODO: nötige Elemente dynamisch laden
            location.reload();
        }
    };

    xhr.send(data);
}