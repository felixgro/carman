@extends('dashboard')

@section('content')

<link rel="stylesheet" href=" {{ asset('css/tables.css') }}">
<link rel="stylesheet" href=" {{ asset('css/forms.css') }}">
<link rel="stylesheet" href=" {{ asset('css/expenses.css') }}">

<h1>Expenses</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore ea expedita assumenda sint voluptate, et iste accusamus repellat explicabo atque aut rem omnis molestiae. Quae aliquam maxime rem placeat error?</p>

<div class="container">
    <div class="chart-container" style="padding-bottom: 50px">
        <canvas id="expensesChart" width="400" height="160" aria-label="Expenses Doughnut Chart" role="img"></canvas>
    </div>
    <div class="sub-action">
        <a href="/expenses/new"><i class="fas fa-plus-square"></i> Add Expense</a>
    </div>

    <table>
        <thead>
            <th></th>
            <th>Purchase</th>
            <th>Costs</th>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr tabindex="0">
                <td><i class="fas fa-money-bill-wave expense-type-{{ $expense->expense_type_id }}"></i></td>
                <td class="title">
                    <a href="/expenses/{{ $expense->id }}" tabindex="-1">
                        <strong>{{ $expense->title }}</strong>
                    </a>
                    <br>
                        <span>{{ $expense->created_at }}</span>
                </td>
                <td><strong>{{ $expense->amount }}</strong> EUR</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    let canvas = document.getElementById('expensesChart');
    let ctx = canvas.getContext('2d');

    let chart = new Chart(ctx, {
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
                    {{ count($fuel) ?? 0 }},
                    {{ count($tickets) ?? 0 }},
                    {{ count($other) ?? 0 }}
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
                position: 'bottom'
            },
            tooltips: {
                enabled: true,
                /*
                custom: (tooltipModel) => {
                    var tooltipEl = document.getElementById('chart-tooltip');

                    // Create element on first render
                    if (!tooltipEl) {
                        tooltipEl = document.createElement('div');
                        tooltipEl.id = 'chart-tooltip';
                        tooltipEl.innerHTML = '<table></table>';
                        document.body.appendChild(tooltipEl);
                    }
                }*/
            }
        }
    });

</script>
@endsection