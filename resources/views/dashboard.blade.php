<!doctype html>
<html lang="en">
<head>
    {{-- Meta Tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ $title }} - Carman</title>


    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/7af1637a61.js" crossorigin="anonymous"></script>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Stylesheets --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/forms.css') }}" rel="stylesheet">
</head>
<body>

    <div id="menuTooltip"></div>

    <header>
        {{-- Header Top: Logo & Logout Button --}}
        <section class="top">

            <a href="/" class="logo">
            <svg data-name="Ebene 1" viewBox="0 0 422 476.29" xmlns="http://www.w3.org/2000/svg">
                <title>Carman</title>

                <path transform="translate(-38 -11.854)" d="m453.17 378.85a20.125 20.125 0 0 0-28.411 1.815 198.04 198.04 0 0 1-148.61 67.219c-109.11 0-197.88-88.77-197.88-197.89a197.88 197.88 0 0 1 319.92-155.77l-65.451 65.451a105.29 105.29 0 1 0-0.8 181.12 20.129 20.129 0 1 0-20.42-34.7 65.037 65.037 0 1 1 0.677-111.81c0.388 0.235 0.788 0.432 1.185 0.638l17.606 17.606a4.124 4.124 0 0 0 5.832 0l116.5-116.5a4.124 4.124 0 0 0 0-5.832l-22.642-22.629a4.11 4.11 0 0 0-2.907-1.207 238.13 238.13 0 0 0-389.76 183.63c0 131.31 106.83 238.15 238.14 238.15a238.31 238.31 0 0 0 178.84-80.883 20.131 20.131 0 0 0-1.814-28.411z"/>

                <path transform="translate(-38 -11.854)" d="m297.71 96.7a20.13 20.13 0 0 0-20.13-20.13c-95.63 0-173.43 77.8-173.43 173.43a20.13 20.13 0 0 0 40.26 0c0-73.428 59.74-133.17 133.17-133.17a20.13 20.13 0 0 0 20.13-20.13z"/>

                <path transform="translate(-38 -11.854)" d="m367.91 347.85a132.76 132.76 0 0 1-90.334 35.321 20.13 20.13 0 1 0 0 40.26 172.9 172.9 0 0 0 117.65-46.009 20.129 20.129 0 1 0-27.316-29.572z"/>
                </svg>
            </a>

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

        {{-- Header Mid: Main Navigation Bar --}}
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

        {{-- Header Sub: Change current Vehicle & User Settings --}}
        <section class="sub">

            <a class="settings" href="{{ route('settings') }}"><i class="fas fa-cog"></i> {{ Auth::user()->name }}</a>

            <form action="" id="vehicleSelect" style="float: right; max-width: 100%;">
                @csrf

                <select name="vehicle" id="vehicle" style="margin: 0; float: right; margin: 0">
                    <option value="{{ $vehicle->id }}" selected>{{ $vehicle->make }} {{ $vehicle->model }}</option>

                    @foreach($userVehicles as $entry)

                        @if($entry->id !== $vehicle->id)

                            <option value="{{ $entry->id }}">{{ $entry->make }} {{ $entry->model }}</option>
                        @endif
                    @endforeach
                </select>

                <input type="hidden" name="userID" id="userID" value="{{ Auth::user()->id }}">
            </form>

            {{-- POST Ajax Request to /vehicles/setcurrent --}}
            <script src="{{ asset('js/vehicleRequest.js') }}"></script>
        </section>

    </header>

    <div class="content">
        <main>

           @yield('content')

        </main>

        <!--aside>

            <h3>Reminder</h3>
            <a href="/reminder/1" class="remind">
                <div class="due">
                    <div>
                        <h3>4</h3>
                        <p>Days</p>
                    </div>
                </div>
                <h2>TÜF</h2>
                <i class="fas fa-external-link-alt"></i>
            </a>
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
            </!--a-->
        </!--aside>
    </div>

    @if(session('notification'))
        @component('components.alertSuccess')
            @slot('title')
                {{ session('notification')[0] }}
            @endslot
            {{ session('notification')[1] }}
        @endcomponent
    @endif

<script src="{{ asset('js/menu.js') }}"></script>

</body>
</html>
