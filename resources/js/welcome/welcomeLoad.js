/*
    Initiale Page-Load-Animationen für alle Welcome-Pages
    Dep: anime.js

    CSS Klassenpflicht:
    .logo-type -> Die SVG-Type
    .carmanLogo -> das Logo für die Mouse Events
*/

// Methode für SVG-Schriftzug Animation im Main Container 
const animateMainType = () => {

    // Delay zwischen Kontur und Fülle Animation
    let fillDelay = 300;

    // Animiert Typekontur
    anime({
        targets: '.logo-type path',
        strokeDashoffset: [anime.setDashoffset, 0],
        easing: 'easeOutSine',
        duration: 900,
        delay: function(el, i) { return i * 50 }
    });
    
    // Animiert Typefülle
    anime({
        targets: '.logo-type path',
        duration: 900,
        easing: 'easeOutSine',
        fill: '#eee',
        delay: function(el, i) { return i * 60 + fillDelay },
    }); 
}

// Methoden werden sofort aufgerufen
animateMainType();