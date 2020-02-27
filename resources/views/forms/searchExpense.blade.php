<script defer src="{{ asset('js/expensesSearch.js') }}"></script>
<script defer src="{{ asset('js/form.js') }}"></script>
<script src="{{ asset('js/assets/slider.min.js') }}"></script>

<link rel="stylesheet" href=" {{ asset('css/assets/slider.css') }}">

<form class="basic-form" action="/expenses/search" method="post">
@csrf

    <div class="spacer">
        <label for="sort">Sort by</label>
        <select name="sort" id="sort" class="sort-select @error('sort') error @enderror">
            <option value="date" @if($prevSort == 'date') selected @endif>Date</option>
            <option value="title" @if($prevSort == 'title') selected @endif>Title</option>
            <option value="amount" @if($prevSort == 'amount') selected @endif>Amount</option>
        </select>
        <div class="multiple-choice" data-toggle=".sort-select">
            <div class="option @if($prevSort == 'date') selected @endif" data-value="1">Date</div>
            <div class="option @if($prevSort == 'title') selected @endif" data-value="2">Title</div>
            <div class="option @if($prevSort == 'amount') selected @endif" data-value="3">Amount</div>
        </div>
    </div>

    <div class="spacer">
        <label for="search">Search Term</label>
        <input type="text" id="search" name="q" value="{{ $prevQuery ?? '' }}">
    </div>

    <div class="spacer slider-container">
        <input type="text" id="amountRange" name="amountRange">
        <label for="amountRange">Amount Range</label>
    </div>

    
    <!--div-- class="search-box">
        <a href="#">Item 1</a>
        <a href="#">Item 2</a>
    </!--div-->

    
    <div>
        <button>Search</button>
    </div>
</form>

<script>

    var mySlider = new rSlider({
        target: '#amountRange',
        values: {
            min: 0,
            max: {{ $maxAmount ?? '' }}
        },
        step: {{ $step ?? '' }},
        range: true,
        tooltip: true,
        scale: true,
        labels: true,
        set: [
            {{ $prevAmountRange[0] ?? 0 }},
            {{ $prevAmountRange[1] ?? $maxAmount }}
        ]
    });



</script>