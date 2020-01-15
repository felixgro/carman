(() => {
    const alerts = document.querySelectorAll('.alert');

    // Alert Visibility Time in Sec.
    const visibleTime = 5;

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
})();