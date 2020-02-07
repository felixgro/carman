/*
    Initiale Page-Load-Animationen für alle Pages und sämmtliche Eventlistener im Header
    Dep: anime.js
*/

// Methode für Logo und Action Buttons im Header
const animateHeader = () => {

    // Logo
    anime({
        targets: '.carmanLogo',
        rotate: 360,
        scale: 1,
        opacity: 1
    });

    // Action Buttons
    anime({
        targets: '.header-action',
        duration: 600,
        easing: 'easeOutSine',
        opacity: 1,
        delay: function(el, i) { return i * 50 },
    });
}

animateHeader();

// LOGIK FÜR LOGOEVENTS (HEADER)

const logo = document.querySelector('.carmanLogo');
let mouseover = false; // Entählt aktuellen Logo-Hoverstatus

logo.addEventListener('mouseover', (event) => {
    if(!mouseover) {
        mouseover = true;
        anime({
            targets: '.carmanLogo',
            rotate: 720,
            scale: 1,
            opacity: 1,
        });
    }
});

logo.addEventListener('mouseleave', (event) => {
    if(mouseover) {
        mouseover = false;
        anime({
            targets: '.carmanLogo',
            rotate: 360,
            scale: 1,
            opacity: 1,
        });
    }
});

// Redirect zu Landingpage
logo.addEventListener('click', (event) => {
    window.location.href = "/";
});


