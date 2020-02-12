/*
    Skript für Ajax-Requests bezgl. Daten für ExpensesChart
    dep: Chart.js, JQuery
*/
(() => {
    const canvas = document.getElementById('expensesChart');
    const ctx = canvas.getContext('2d');

    const drawChart = (data, ctx) => {
        let newChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    'Gas Station',
                    'Tickets',
                    'Other'
                    ],
                datasets: [{
                    label: 'All Expenses',
                    data: [
                        data.fuel,
                        data.ticket,
                        data.other
                    ],
                    borderWidth: 0,
                    backgroundColor: [
                        'hsl(240, 30%, 35%)',
                        'hsla(355, 80%, 58%, 1)',
                        'hsl(40, 80%, 70%)'
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
                }
            }
        });
    }

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
                    'fuel': res.fuel_sum,
                    'ticket': res.ticket_sum,
                    'other': res.other_sum
                };

                drawChart(data, ctx);
            }
         });
    }

    getData(1, 'all');

})();