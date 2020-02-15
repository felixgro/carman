/*
    Skript für Ajax-Requests bezgl. Daten für ExpensesChart
    dep: Chart.js, JQuery
*/
(() => {
    const options = document.querySelectorAll('.multiple-choice .option');
    const dataContainer = document.querySelector('.scope-data');
    const canvas = document.getElementById('expensesChart');
    const ctx = canvas.getContext('2d');

    let chart;

    const drawChart = (data, ctx = undefined) => {

        if(chart === undefined) {

            chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [
                        'Gas Station',
                        'Tickets',
                        'Service',
                        'Other'
                        ],
                    datasets: [{
                        label: 'All Expenses',
                        data: [
                            data.fuel,
                            data.ticket,
                            data.service,
                            data.other
                        ],
                        borderWidth: 0,
                        backgroundColor: [
                            'hsl(240, 30%, 35%)',
                            'hsla(355, 80%, 58%, 1)',
                            'hsl(40, 80%, 70%)',
                            'lightgrey'
                        ]
                    }]
                },
                options: {
                    cutoutPercentage: 50,
                    legend: {
                        display: false,
                        position: 'bottom'
                    },
                    tooltips: {
                        enabled: true,
                        cornerRadius: 2,
                        callbacks: {
                            label: function(tooltipItems, data) { 
                                let value = " " + data.datasets[0].data[ tooltipItems.index ];
                                return value + ' €';
                            }
                        }
                    },
                }
            });

        } else {

            chart.data.datasets[0].data = [data.fuel, data.ticket, data.service, data.other];
            chart.update();

        }

        updateScopeData(data);
    }

    // Sendet AJAX-Request mit Scope und UserID and /expenses/userID/getData
    const getData = (id, scope) => {
        let url = "/expenses/" + id + "/getData";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: 'get',
            data: {
                'scope': scope,
            },  
            success: function(res){

                let data = {
                    'total': res.sum,
                    'fuel': res.fuel_sum,
                    'ticket': res.ticket_sum,
                    'service': res.service_sum,
                    'other': res.other_sum
                };

                // Falls im angefragten Scope keine Ausgaben existieren
                if (res.sum === 0) {
                    nothingToShow();
                } else {
                    somethingToShow();
                }

                drawChart(data, ctx);
            }
         });
    }

    // Wenn auf Scope Button geklickt wurde
    const scopeClicked = (event) => { 

        let value = parseInt(event.target.dataset.value);

        switch(value) {

            // All Time
            case 1:
                getData(1, 'all');
                break;

            // This Week
            case 2:
                getData(1, 'month');
                break;

            // This Year
            case 3:
                getData(1, 'year');
                break;

            // Error Handling
            default:
        }
    }

    const updateScopeData = (data) => {
        let total = dataContainer.querySelector('h2');

        let totalSum = getConvertedNumber(data.total);
        total.innerHTML = totalSum;

        document.querySelector('small.currency').innerHTML = getUserCurrency().short;


        positionScopeData();

        let percent = calculatePercentages(data);

        document.getElementById('gasPercent').innerHTML = percent.fuel + "%";
        document.getElementById('ticketPercent').innerHTML = percent.ticket + "%";
        document.getElementById('servicePercent').innerHTML = percent.service + "%";
        document.getElementById('otherPercent').innerHTML = percent.other + "%";

        console.log(percent);
    }

    const positionScopeData = () => {
        return 0;
    }

    const calculatePercentages = (data) => {
        const sum     = data.total;
        const fuel    = data.fuel;
        const ticket  = data.ticket;
        const service = data.service;
        const other   = data.other;

        const onePercent = sum / 100;

        return {
            fuel: Math.round(fuel / onePercent),
            service: Math.round(service / onePercent),
            ticket: Math.round(ticket / onePercent),
            other: Math.round(other / onePercent)
        }
    }

    // Wird aufgerufen wenn eine Request die Summe 0 als Response geliefert hat
    const nothingToShow = () => {

        let msg = document.getElementById('noExpenses');
        
        msg.style.display = 'block';
        msg.style.opacity = 0;

        setTimeout(() => {

            let canvasRect = canvas.getBoundingClientRect();
            let msgRect = msg.getBoundingClientRect();

            // Ausrechnen der Position
            let x = canvasRect.left + (canvasRect.width / 2) - (msgRect.width / 2);
            let y = canvasRect.top + (canvasRect.height / 2) - (msgRect.height / 2);
        
            // Position Text
            msg.style.left = x + "px";
            msg.style.top = y + "px";

            msg.style.opacity = 1;

        }, 100);
    }

    const somethingToShow = () => {
        let msg = document.getElementById('noExpenses');

        msg.style.opacity = 0;
        msg.style.display = 'none';
    }

    const getConvertedNumber = (num) => {
        let knum = Math.abs(num) > 999 ? Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'k' : Math.sign(num)*Math.abs(num);

        return knum;
    }

    const getUserCurrency = () => {
        let symbol = document.getElementById('userCurrency').value;
        let short  = document.getElementById('userCurrencyShort').value;

        return {
            symbol: symbol,
            short: short
        }
    }

    getData(1, 'all');

    // Event-Listener Zuweisungen
    for(let i = 0; i < options.length; i++) {
        options[i].onclick = scopeClicked;
    }

})();