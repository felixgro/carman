<!doctype html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - Rider</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/7af1637a61.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>

    <div id="menuTooltip"></div>

    <header>

        <section class="top">

            <a href="/" class="logo">Rider</a>

            <!-- Logout Link -->
            <a href="href="{{ route('logout') }}" class="logout" onclick="
                event.preventDefault();
                document.getElementById('logout-form').submit();
            ">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </section>


        <section class="mid" id="menuIcons">

            <a href="/home" data-name="Home">
                <i class="fas fa-columns {{ $currentPage == 'home' ? 'current' : '' }}"></i>
            </a>

            <a href="/vehicles" data-name="Vehicle">
                <i class="fas fa-car {{ $currentPage == 'vehicle' ? 'current' : '' }}""></i>
            </a>

            <a href="/routes" data-name="Route">
                <i class="fas fa-route {{ $currentPage == 'route' ? 'current' : '' }}""></i>
            </a>

            <a href="/expenses" data-name="Expense">
                <i class="fas fa-gas-pump {{ $currentPage == 'expense' ? 'current' : '' }}""></i>
            </a>

            <a href="/dependencies" data-name="Dependency">
                <i class="fas fa-exclamation-circle {{ $currentPage == 'dependency' ? 'current' : '' }}""></i>
            </a>

            <input type="hidden" id="currentPage" value="{{ $currentPage ?? '' }}">

        </section>

        <section class="sub">
            <a href="{{ route('settings') }}" id="carSelect" class="select-opener">
                <i class="fas fa-chevron-down"></i> {{ $vehicle['make'] }}  {{ $vehicle['model'] }}</i>
            </a>
            <a class="settings" href="{{ route('settings') }}"><i class="fas fa-cog"></i> {{ Auth::user()->name }}</a>
        </section>

    </header>

    <div class="content">
        <main>

           @yield('content')

        </main>

        <aside>

            <h3>Reminder</h3>
            <p>Nothing to show yet..</p>
            <!--a href="/reminder/1" class="remind">
                <div class="due">
                    <div>
                        <h3>4</h3>
                        <p>Days</p>
                    </div>
                </div>
                <h2>TÜF</h2>
                <i class="fas fa-external-link-alt"></i>
            </!--a>
            <a href="/reminder/1" class="remind">
                <div class="due">
                    <div>
                        <h3>42</h3>
                        <p>Days</p>
                    </div>
                </div>
                <h2>Parkpickerl</h2>
                <i class="fas fa-external-link-alt"></i>
            </a>
            <a-- href="/reminder/1" class="remind">
                <div class="due">
                    <div>
                        <h3>>1</h3>
                        <p>Year</p>
                    </div>
                </div>
                <h2>Vignette</h2>
                <i class="fas fa-external-link-alt"></i>
            </a-->
        </aside>
    </div>

<script src="{{ asset('js/menu.js') }}"></script>

</body>
</html>
