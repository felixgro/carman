/*
    Script für Select Input der in Buttons aufgespalten wird
*/
(() => {
    const container = document.querySelectorAll('.multiple-choice');

    const click = (event) => {

        const element = event.target;
        const parent = event.target.parentElement;

        const i = event.target.dataset.value - 1;

        let select = document.querySelector(parent.dataset.toggle);

        select.selectedIndex = i;

        renderCurrent(element, i);
    }

    const renderCurrent = (element, index) => {
        const parent = element.parentElement;
        const childs = parent.querySelectorAll('.option');

        for(let i = 0; i < childs.length; i++) {
            let cur = childs[i];
            if (cur.classList.contains('selected')) {
                cur.classList.remove('selected');
            }
        }

        childs[index].classList.add('selected');
    }

    const hideSelector = (element) => {

        if(element === null) {
            console.error('data-toggle Attribute seems to be missing or wrong');
        }
        element.setAttribute('aria-hidden', true);
        element.classList.add('hidden');
    }

    for(let i = 0; i < container.length; i++) {
        let cur = container[i];
        let htmlSelect = document.querySelector(cur.dataset.toggle);
        cur.onclick = click;
        hideSelector(htmlSelect);
    }
})();