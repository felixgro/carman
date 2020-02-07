/*
    Initiale Page-Load-Animationen für alle Welcome-Pages
    Menu-Hover Animation
    Dep: anime.js
*/

const menu = document.querySelector('.nav');
let menuHovered = false; //Beschreibt den Hoverstate des Menus

const loadMenu = () => {
    anime({
        targets: '.menu-icon',
        easing: 'easeOutSine',
        duration: 230,
        opacity: .1,
        scale: .96,
        delay: function(el, i) { return i * 50 }
    });
}

menu.addEventListener('mouseover', (event) => {
    if(!menuHovered) {
        menuHovered = true;

        anime({
            targets: '.menu-txt',
            easing: 'easeOutSine',
            duration: 130,
            opacity: .1,
            delay: function (el, i) { return i * 35 }
        });
    }
});
menu.addEventListener('mouseleave', (event) => {
    if(menuHovered) {
        menuHovered = false;

        anime({
            targets: '.menu-txt',
            easing: 'easeOutSine',
            duration: 130,
            opacity: 0,
            scale: .96,
            delay: function (el, i) { return i * 35 }
        });
    }
});

loadMenu();