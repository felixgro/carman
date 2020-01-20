const Donut = (element) => {
    this.data = genData();
    console.log(this.data);
};

function genData() {
    var type = ['Expenses'];
    var unit = ['EUR'];
    var cat = ['Ticket', 'Gas Station', 'Other'];

    var dataset = new Array();

    for (var i = 0; i < type.length; i++) {
        var data = new Array();
        var total = 0;

        for (var j = 0; j < cat.length; j++) {
            var value = Math.random()*10*(3-i);
            total += value;
            data.push({
                "cat": cat[j],
                "val": value
            });
        }

        dataset.push({
            "type": type[i],
            "unit": unit[i],
            "data": data,
            "total": total
        });
    }
    return dataset;
}

let expensesChart = new Donut('#chart');