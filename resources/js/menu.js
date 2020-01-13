(() => {
    // Main Menu Tooltip Function
    const icons = document.querySelectorAll('#menuIcons a');
    let tooltip = document.getElementById('menuTooltip');
    let toolRect = tooltip.getBoundingClientRect();

    // Liest die Aktuelle Seite aus einem Hidden Inputfeld aus. Das Value dieses Feldes kommt aus PHP vom jeweiligen Controller
    let currentPage = document.getElementById('currentPage').value == '' ? 'home' : document.getElementById('currentPage').value;
    let currentFocus;

    switch(currentPage) {
        case 'vehicle':
            currentFocus = 1;
        break;
        case 'route':
            currentFocus = 2;
        break;
        case 'expense':
            currentFocus = 3;
        break;
        case 'dependency':
            currentFocus = 4;
        break;
        default:
            currentFocus = 0;
    }

    // TODO: Wenn Auswahltasten verwendet wurden, kehrt Menu nach 10 sekunden in den Normalzustand
    const keyTimeout = 10;

    // Header Zeile inder sich das Tooltip bewegen soll
    let targetRowRect = document.querySelector('header section.sub').getBoundingClientRect();

    // Wird ausgeführt, wenn der Cursor ein Icon überlapt
    const mouseEnter = (event) => {
        const icon = event.target;

        renameTooltip(icon.dataset.name);
        moveTooltip(icon.getBoundingClientRect());
    }

    // Wird ausgeführt, wenn  sich der Cursor nichtmehr über dem Icon befindet
    const mouseLeave = (event) => {
        resetTooltip();
    }

    const getTooltipY = () => {
        let targetRowRect = document.querySelector('header section.sub').getBoundingClientRect();
        let y = targetRowRect.y + (targetRowRect.height / 2) - (toolRect.height / 2) + document.body.scrollTop;
        return y;
    }


    let y = getTooltipY();

    // Bewegt das Tooltip zum Icon der aktuellen Seite
    const resetTooltip = () => {
        for(let i = 0; i < icons.length; i++) {
            
            const name = icons[i].dataset.name.toLowerCase();

            if(name === currentPage.toLowerCase()) {
                renameTooltip(name);
                moveTooltip(icons[i].getBoundingClientRect());
            }
        }
    }

    // Zentriert Tooltip in untester Menuzeile unter dem ClientRect rect
    const moveTooltip = (rect) => {
        updateToolRect();
        let x = rect.x + (rect.width / 2) - (toolRect.width / 2);
        let y = targetRowRect.y + (targetRowRect.height / 2) - (toolRect.height / 2);

        tooltip.style.left = x + "px"; 
        tooltip.style.top = y + "px";
    }

    // Ändert den im Tooltip gezeigten Text zu value
    const renameTooltip = (value) => {
        tooltip.innerText = value;
    }

    // Notwendig, da Tooltip bei renameTooltip() die Breite verändern könnte
    const updateToolRect = () => {
        toolRect = tooltip.getBoundingClientRect();
    }

    // Eventlistener Zuweisungen
    for(let i = 0; i < icons.length; i++) {
        icons[i].addEventListener('mouseover', mouseEnter);
        icons[i].addEventListener('mouseleave', mouseLeave);
        icons[i].addEventListener('focus', mouseEnter);
        icons[i].addEventListener('blur', mouseLeave);
    }

    // Setzt Tooltip zu current Page zurück
    setTimeout(resetTooltip, 300);

    /* Key Menu Navigation:

    '.':              öffnet Einstellungen
    links / rechts:   main manu auswahl
    oben / enter:     link aufrufen
    unten:           abbrechen
    */
    let keyTimeoutFunction = undefined;

    // Startet Timeout von keyTimeout Sekunden bis Menu in Normalzustand gerät
    const activateTimeout = () => {
        keyTimeoutFunction = setTimeout(() => {
            currentFocus = 0;
            resetTooltip();
        }, keyTimeout * 1000);
    }

    // TODO: Icon farbe ändern
    const cancleTimeout = () => {
        if(keyTimeoutFunction !== undefined) {
            clearTimeout(keyTimeoutFunction);
            keyTimeoutFunction = undefined;
        }
    }
    document.addEventListener('keydown', (event) => {

        // Event Zuordnung
        switch(event.code) {

            case 'ArrowLeft':
                // Wählt linkes Element aus. wenn keines vorhanden ist wird das ganz rechte ausgewählt
                if(currentFocus === 0) {
                    icons[icons.length - 1].focus();
                    currentFocus = icons.length - 1;
                } else if (currentFocus > 0) {
                    icons[--currentFocus].focus();
                }
            break;

            case 'ArrowRight':
                // Wählt rechtes Element aus, wenn keines vorhanden ist wird das ganz linke ausgewählt
                if(currentFocus === icons.length - 1) {
                    icons[0].focus();
                    currentFocus = 0;
                } else if (currentFocus < icons.length - 1) {
                    icons[++currentFocus].focus();
                }
            break;

            case 'ArrowDown':
                // Bricht die Auswahl ab und kehrt in Normalzustand zurück
                currentFocus = 0;
                for(let i = 0; i < icons.length; i++) {
                    icons[i].blur();
                }
                resetTooltip();
            break;

            case 'ArrowUp':
                // Öffnet die aktuelle Auswahl
                let url = document.activeElement.href;
                window.location = url;
            break;

            default:
                // Sollte eine andere Taste außer den Pfeiltasten und der Entertaste gedrückt werden so wird ebenfals die Auswahl abgebrochen
                currentFocus = 0;
                resetTooltip();
            break;
        }
    });
})();