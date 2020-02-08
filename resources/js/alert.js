/*
    Script für Alert Notifications
*/
(() => {
    const alerts = document.querySelectorAll('.alert');

    // Alert Visibility Time in Sec.
    const visibleTime = 5;

    const hideAlert = (event) => {
        if(alerts.length > 0) {
            for (let i = 0; i < alerts.length; i++) {
                setTimeout(() => {
    
                    alerts[i].classList.add('remove');
    
                    setTimeout(() => {
                        alerts[i].style.display = 'none';
                        alerts[i].setAttribute('aria-hidden', 'true');
                    }, 300);
                }, visibleTime * 1000);
                
            }
        }
    }

    hideAlert();


    // Event Listener Zuweisung
    for(let i = 0; i < alerts.length; i++) {
        alerts[i].onclick = (event) => {
            alerts[i].classList.add('remove');
    
            setTimeout(() => {
                alerts[i].style.display = 'none';
                alerts[i].setAttribute('aria-hidden', 'true');
            }, 300);
        };
    }
})();