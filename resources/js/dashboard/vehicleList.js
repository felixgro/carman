/*
    Script für Vehicle Liste, sämtliche AJAX-Requests und Load-in Animationen
    Dep: JQuery, anime.js
*/
(() => {
    const items = document.querySelectorAll('.list-item');
    const container = document.querySelector('.side-box');

    // Vertikaler Abstand Sideboxkante - Cusor
    let spacing = 5;

    // Beschreibt den aktuellen Zustand der Sidebox
    let visible = false;

    // Wird ausgeführt, wenn auf List-Item geklickt wird
    const clicked = (event) => {
        event.preventDefault();
        getData(event.target.dataset.id);
        moveContainer(event);
        toggleVisibility(true);
    }

    // Wird bei Klicken des x und bei Scrollen ausgeführt
    const hideBox = (event) => {
        event.preventDefault();

        if (container.style.display !== 'none') {
            toggleVisibility(false);
        }
    }

    // Sendet Vehicle AJAX Request und gibt Response an displayData Methode weiter
    const getData = (id) => {
        let url = "/vehicles/" + id + "/getData";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: 'get',
            success: function(res){
                displayData(res);
            }
         });
    }

    // Befüllt Side-Box mit angefragten Daten
    const displayData = (data) => {

        // dynamische Kosten-Zuweisung (um 'undefined' zu verhindern)
        totalCost = data.totalCost ? data.totalCost : 0;

        document.getElementById('currentMake').innerText = data.make;
        document.getElementById('currentModel').innerText = data.model;
        document.getElementById('currentKm').innerText = data.km;
        document.getElementById('currentPlate').innerText = data.plate;
        document.getElementById('currentCosts').innerText = totalCost;

        document.getElementById('currentMakeIcon').innerHTML = data.make_icon;

        document.getElementById('currentSelect').href = '/vehicles/' + data.id + "/select";
        document.getElementById('currentMain').href = '/vehicles/' + data.id + "/main";
        document.getElementById('currentEdit').href = '/vehicles/' + data.id + "/edit";

        document.getElementById('selectForm').action = "/vehicles/" + data.id + "/select";
        document.getElementById('mainForm').action = "/vehicles/" + data.id + "/main";
    }

    // Bewegt Container unter/über Cursor (jenachdem ob sich Cursor über/unter der Bildschirmhälfte befindet)
    const moveContainer = (event) => {
        let containerRect = container.getBoundingClientRect(); // Maße der Side-Box

        // dynamische Y-Position-Zuordnung
        let y;
        if(event.clientY < window.innerHeight / 2) {
            y = event.clientY - spacing;
        } else {
            y = event.clientY - (containerRect.height) - spacing;
        }

        let x = event.clientX - (containerRect.width / 2); // Zentriert auf horizontaler Achse

        container.style.left = x + "px";
        container.style.top = y + "px";
    }

    // Animiert Side-Box Aus/Ein
    const toggleVisibility = (dir) => {
        if(!dir) {
            visible = false;
            anime({
                targets: '.side-box',
                easing: 'easeOutSine',
                duration: 140,
                height: 0
            });
            setTimeout(() => {
                container.style.display = 'none';
            }, 150);
            container.setAttribute('aria-hidden', true);
        } else {
            container.style.display = 'flex';
            visible = true;
            anime({
                targets: '.side-box',
                easing: 'easeOutSine',
                duration: 120,
                height: 300
            });
            container.setAttribute('aria-hidden', false);
        }
    }

    // Event Listener für Click und Scroll
    for(let i = 0; i < items.length; i++) {
        items[i].onclick = clicked;
    }
    // window.onscroll = hideBox;
    document.getElementById('sideCloser').onclick = hideBox;
})();