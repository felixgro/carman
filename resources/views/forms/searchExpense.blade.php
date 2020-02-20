<script defer src="{{ asset('js/expensesSearch.js') }}"></script>

<form class="basic-form" action="/expenses/search" method="post">
@csrf
    <div class="spacer">
        <label for="search">Search</label>
        <input type="text" id="search" name="q" value="{{ $prevQuery ?? '' }}">
    </div>
    <!--div-- class="search-box">
        <a href="#">Item 1</a>
        <a href="#">Item 2</a>
    </!--div-->
    <div>
        <button>Search</button>
    </div>
</form>