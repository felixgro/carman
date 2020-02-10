<!doctype html>
<html lang="en">
<head>
    {{-- Meta Tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ $title }} - Carman</title>


    {{-- Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    {{-- Stylesheets --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/forms.css') }}" rel="stylesheet">
</head>
<body>
<header>
        <div class="wrapper">
            <svg id="Ebene_1" class="carmanLogo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 422 476.293">
                <title>Logo</title>
                <path d="M453.168,378.852a20.125,20.125,0,0,0-28.411,1.815,198.035,198.035,0,0,1-148.614,67.219C167.031,447.886,78.26,359.116,78.26,250A197.882,197.882,0,0,1,398.185,94.23l-65.451,65.451a105.292,105.292,0,1,0-.8,181.122,20.129,20.129,0,1,0-20.42-34.7,65.037,65.037,0,1,1,.677-111.81c.388.235.788.432,1.185.638l17.606,17.606a4.124,4.124,0,0,0,5.832,0l116.5-116.5a4.124,4.124,0,0,0,0-5.832L430.672,67.576a4.11,4.11,0,0,0-2.907-1.207A238.134,238.134,0,0,0,38,250c0,131.314,106.832,238.146,238.143,238.146a238.311,238.311,0,0,0,178.839-80.883A20.131,20.131,0,0,0,453.168,378.852Z" transform="translate(-38 -11.854)"/>
                <path d="M297.707,96.7a20.13,20.13,0,0,0-20.13-20.13c-95.63,0-173.428,77.8-173.428,173.428a20.13,20.13,0,0,0,40.26,0c0-73.428,59.74-133.168,133.168-133.168A20.13,20.13,0,0,0,297.707,96.7Z" transform="translate(-38 -11.854)"/>
                <path d="M367.911,347.847a132.765,132.765,0,0,1-90.334,35.321,20.13,20.13,0,1,0,0,40.26,172.9,172.9,0,0,0,117.65-46.009,20.129,20.129,0,1,0-27.316-29.572Z" transform="translate(-38 -11.854)"/>
            </svg>
            <div>
                <a href="{{ route('logout') }}" id="logoutBtn" class="main-button header-action" onclick="
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                ">Logout</a>
                <a href="{{ route('settings') }}" class="header-action" id="settingsBtn">
                    <svg width="512pt" height="512pt" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="m499.95 197.7-39.352-8.5547c-3.4219-10.477-7.6602-20.695-12.664-30.539l21.785-33.887c3.8906-6.0547 3.0352-14.004-2.0508-19.09l-61.305-61.305c-5.0859-5.0859-13.035-5.9414-19.09-2.0508l-33.887 21.785c-9.8438-5.0039-20.062-9.2422-30.539-12.664l-8.5547-39.352c-1.5273-7.0312-7.7539-12.047-14.949-12.047h-86.695c-7.1953 0-13.422 5.0156-14.949 12.047l-8.5547 39.352c-10.477 3.4219-20.695 7.6602-30.539 12.664l-33.887-21.785c-6.0547-3.8906-14.004-3.0352-19.09 2.0508l-61.305 61.305c-5.0859 5.0859-5.9414 13.035-2.0508 19.09l21.785 33.887c-5.0039 9.8438-9.2422 20.062-12.664 30.539l-39.352 8.5547c-7.0312 1.5312-12.047 7.7539-12.047 14.949v86.695c0 7.1953 5.0156 13.418 12.047 14.949l39.352 8.5547c3.4219 10.477 7.6602 20.695 12.664 30.539l-21.785 33.887c-3.8906 6.0547-3.0352 14.004 2.0508 19.09l61.305 61.305c5.0859 5.0859 13.035 5.9414 19.09 2.0508l33.887-21.785c9.8438 5.0039 20.062 9.2422 30.539 12.664l8.5547 39.352c1.5273 7.0312 7.7539 12.047 14.949 12.047h86.695c7.1953 0 13.422-5.0156 14.949-12.047l8.5547-39.352c10.477-3.4219 20.695-7.6602 30.539-12.664l33.887 21.785c6.0547 3.8906 14.004 3.0391 19.09-2.0508l61.305-61.305c5.0859-5.0859 5.9414-13.035 2.0508-19.09l-21.785-33.887c5.0039-9.8438 9.2422-20.062 12.664-30.539l39.352-8.5547c7.0312-1.5312 12.047-7.7539 12.047-14.949v-86.695c0-7.1953-5.0156-13.418-12.047-14.949zm-152.16 58.297c0 50.613-41.18 91.793-91.793 91.793s-91.793-41.18-91.793-91.793 41.18-91.793 91.793-91.793 91.793 41.18 91.793 91.793z"/>
                    </svg>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" aria-hidden="true">
                    @csrf
                </form>
        
            </div>
        </div>
    </header>
<div class="nav">
        <a class="item @if($currentPage == 'home') current @endif" href="/home">
            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 422 476.293">
                <title>Logo</title>
                <path d="M453.168,378.852a20.125,20.125,0,0,0-28.411,1.815,198.035,198.035,0,0,1-148.614,67.219C167.031,447.886,78.26,359.116,78.26,250A197.882,197.882,0,0,1,398.185,94.23l-65.451,65.451a105.292,105.292,0,1,0-.8,181.122,20.129,20.129,0,1,0-20.42-34.7,65.037,65.037,0,1,1,.677-111.81c.388.235.788.432,1.185.638l17.606,17.606a4.124,4.124,0,0,0,5.832,0l116.5-116.5a4.124,4.124,0,0,0,0-5.832L430.672,67.576a4.11,4.11,0,0,0-2.907-1.207A238.134,238.134,0,0,0,38,250c0,131.314,106.832,238.146,238.143,238.146a238.311,238.311,0,0,0,178.839-80.883A20.131,20.131,0,0,0,453.168,378.852Z" transform="translate(-38 -11.854)"/>
                <path d="M297.707,96.7a20.13,20.13,0,0,0-20.13-20.13c-95.63,0-173.428,77.8-173.428,173.428a20.13,20.13,0,0,0,40.26,0c0-73.428,59.74-133.168,133.168-133.168A20.13,20.13,0,0,0,297.707,96.7Z" transform="translate(-38 -11.854)"/>
                <path d="M367.911,347.847a132.765,132.765,0,0,1-90.334,35.321,20.13,20.13,0,1,0,0,40.26,172.9,172.9,0,0,0,117.65-46.009,20.129,20.129,0,1,0-27.316-29.572Z" transform="translate(-38 -11.854)"/>
            </svg>
            <span class="menu-txt">Home</span>
        </a>
        <a class="item @if($currentPage == 'vehicles') current @endif" href="/vehicles">
            <svg class="menu-icon" id="key" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.339 89"><title>Element 1</title><g id="Ebene_2" data-name="Ebene 2"><g id="Ebene_1-2" data-name="Ebene 1"><g id="key_vector"><circle cx="36.149" cy="15.09" r="4.536"/><path d="M61.811,0H36.966A15.528,15.528,0,0,0,21.438,15.528v8.009L.2,72.454a2.421,2.421,0,0,0,1.257,3.186l6.47,2.809a2.42,2.42,0,0,0,3.186-1.257L21.438,53.411v20.06A15.528,15.528,0,0,0,36.966,89H61.811A15.528,15.528,0,0,0,77.339,73.472V15.528A15.528,15.528,0,0,0,61.811,0ZM8.622,75.542,3.107,73.148,21.438,30.925v15.1ZM36.149,7.612a7.478,7.478,0,1,1-7.478,7.478A7.478,7.478,0,0,1,36.149,7.612ZM68.39,68.2A12.979,12.979,0,0,1,55.411,81.177H43.366A12.979,12.979,0,0,1,30.387,68.2V56.13A12.979,12.979,0,0,1,43.366,43.151H55.411A12.979,12.979,0,0,1,68.39,56.13Z"/><rect x="44.608" y="59.689" width="9.562" height="5.038"/><path d="M55.411,46.094H43.366A10.048,10.048,0,0,0,33.329,56.13V68.2A10.048,10.048,0,0,0,43.366,78.235H55.411A10.048,10.048,0,0,0,65.448,68.2V56.13A10.048,10.048,0,0,0,55.411,46.094Zm1.7,19.26A2.316,2.316,0,0,1,54.8,67.669H43.981a2.316,2.316,0,0,1-2.316-2.316V59.063a2.316,2.316,0,0,1,2.316-2.316H54.8a2.316,2.316,0,0,1,2.316,2.316Z"/></g></g></g></svg>

            <span class="menu-txt">Vehicles</span>
        </a>
        <a class="item @if($currentPage == 'routes') current @endif" href="/routes">
            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 422 476.293">
                <title>Logo</title>
                <path d="M453.168,378.852a20.125,20.125,0,0,0-28.411,1.815,198.035,198.035,0,0,1-148.614,67.219C167.031,447.886,78.26,359.116,78.26,250A197.882,197.882,0,0,1,398.185,94.23l-65.451,65.451a105.292,105.292,0,1,0-.8,181.122,20.129,20.129,0,1,0-20.42-34.7,65.037,65.037,0,1,1,.677-111.81c.388.235.788.432,1.185.638l17.606,17.606a4.124,4.124,0,0,0,5.832,0l116.5-116.5a4.124,4.124,0,0,0,0-5.832L430.672,67.576a4.11,4.11,0,0,0-2.907-1.207A238.134,238.134,0,0,0,38,250c0,131.314,106.832,238.146,238.143,238.146a238.311,238.311,0,0,0,178.839-80.883A20.131,20.131,0,0,0,453.168,378.852Z" transform="translate(-38 -11.854)"/>
                <path d="M297.707,96.7a20.13,20.13,0,0,0-20.13-20.13c-95.63,0-173.428,77.8-173.428,173.428a20.13,20.13,0,0,0,40.26,0c0-73.428,59.74-133.168,133.168-133.168A20.13,20.13,0,0,0,297.707,96.7Z" transform="translate(-38 -11.854)"/>
                <path d="M367.911,347.847a132.765,132.765,0,0,1-90.334,35.321,20.13,20.13,0,1,0,0,40.26,172.9,172.9,0,0,0,117.65-46.009,20.129,20.129,0,1,0-27.316-29.572Z" transform="translate(-38 -11.854)"/>
            </svg>
            <span class="menu-txt">Routes</span>
        </a>
        <a class="item" href="/expenses">
            <svg class="menu-icon  @if($currentPage == 'expenses') current @endif" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 71.241 87.5"><title>Element 3</title><g id="Ebene_2" data-name="Ebene 2"><g id="Ebene_1-2" data-name="Ebene 1"><g id="bill_vector"><rect x="45.248" y="22.463" width="7.488" height="18.185"/><rect x="11.873" y="20.752" width="7.488" height="19.896"/><rect x="22.998" y="26.314" width="7.488" height="14.334"/><rect x="34.123" y="13.05" width="7.488" height="27.598"/><path d="M54.128,56.693a13.692,13.692,0,0,1,.032,27.384h-.035a13.692,13.692,0,0,1-.033-27.384h.036m0-3.423h-.044a17.115,17.115,0,0,0,.042,34.23h.044a17.115,17.115,0,0,0-.042-34.23Z"/><path d="M58.351,64.855h0a1.284,1.284,0,1,1-.91.378,1.275,1.275,0,0,1,.91-.378m0-2.139a3.423,3.423,0,1,0,2.414,1,3.412,3.412,0,0,0-2.414-1Z"/><path d="M49.9,73.348h0a1.284,1.284,0,1,1-.91.378,1.276,1.276,0,0,1,.91-.378m0-2.139a3.423,3.423,0,1,0,2.414,1,3.412,3.412,0,0,0-2.414-1Z"/><path d="M58.979,76.925a1.706,1.706,0,0,1-1.207-.5L48.065,66.77a1.712,1.712,0,0,1,2.414-2.427L60.186,74a1.711,1.711,0,0,1-1.207,2.925Z"/><path d="M37.225,70.642a17.189,17.189,0,0,1,.343-3.466h-8.9a1.711,1.711,0,0,1,0-3.423h9.986a17.077,17.077,0,0,1,1.394-2.567H28.667a1.711,1.711,0,1,1,0-3.423H43.026a17.154,17.154,0,0,1,3.026-2.139H28.667a1.711,1.711,0,0,1,0-3.423H53.912a1.71,1.71,0,0,1,1.666,1.333,17.091,17.091,0,0,1,12.453,6.795V13.016A13.016,13.016,0,0,0,55.016,0h-42A13.016,13.016,0,0,0,0,13.016V63.573A13.016,13.016,0,0,0,13.016,76.589H38.3A17.077,17.077,0,0,1,37.225,70.642ZM8.664,42.607V20.1a2.562,2.562,0,0,1,2.562-2.562H21.321A1.678,1.678,0,0,1,23,19.22v3.885h7.916V12.377A2.536,2.536,0,0,1,33.45,9.841h9.261a2.536,2.536,0,0,1,2.536,2.536v6.877h8.547a2.578,2.578,0,0,1,2.578,2.578v20.82a1.633,1.633,0,0,1-1.633,1.633h-44.4A1.678,1.678,0,0,1,8.664,42.607Zm6.384,14.708a1.7,1.7,0,0,0,1.21.5,5.129,5.129,0,0,1,1.711,9.968V68.1a1.711,1.711,0,0,1-3.423,0v-.317a5.112,5.112,0,0,1-3.423-4.834c0-.043,0-.087,0-.131a1.711,1.711,0,0,1,3.421.117,1.712,1.712,0,1,0,1.711-1.7,5.135,5.135,0,0,1-3.633-8.763,4.964,4.964,0,0,1,1.922-1.191v-.3a1.711,1.711,0,0,1,3.423,0V51.3a5.232,5.232,0,0,1,1.886,1.14,4.988,4.988,0,0,1,1.537,3.583,1.711,1.711,0,0,1-1.685,1.738h-.027a1.712,1.712,0,0,1-1.711-1.685,1.617,1.617,0,0,0-.468-1.151,1.792,1.792,0,0,0-2.452-.035A1.718,1.718,0,0,0,15.049,57.315Z"/></g></g></g></svg>
            <span class="menu-txt">Expenses</span>
        </a>
        <a class="item  @if($currentPage == 'reminder') current @endif"" href="/dependencies">
            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 68.105 89.24"><title>Element 4</title><g id="Ebene_2" data-name="Ebene 2"><g id="Ebene_1-2" data-name="Ebene 1"><g id="reminder_vector"><path d="M33.846,20.63l6.042.037h.01a1.648,1.648,0,0,0,.01-3.3l-4.393-.027L35.55,11.3a1.648,1.648,0,0,0-1.638-1.658H33.9a1.648,1.648,0,0,0-1.648,1.638l-.047,7.689A1.648,1.648,0,0,0,33.846,20.63Z"/><path d="M54.924,14.544H52.51A18.983,18.983,0,0,0,37.293.275,19.421,19.421,0,0,0,34.031,0a18.981,18.981,0,0,0-18.42,14.544H13.182A13.22,13.22,0,0,0,0,27.725V76.058A13.22,13.22,0,0,0,13.182,89.24H54.924A13.22,13.22,0,0,0,68.105,76.058V27.725A13.22,13.22,0,0,0,54.924,14.544ZM14.586,72.215l-1.112,1.377a1.061,1.061,0,0,1-.254.2,1.119,1.119,0,0,1-.128.1,1.079,1.079,0,0,1-.825.05c-.034-.012-.064-.036-.1-.051a1.066,1.066,0,0,1-.212-.111L8.675,71.3A1.1,1.1,0,0,1,10,69.55l2.433,1.835.444-.55a1.1,1.1,0,0,1,1.71,1.381Zm0-10.985-1.112,1.377a1.061,1.061,0,0,1-.254.2,1.119,1.119,0,0,1-.128.1,1.079,1.079,0,0,1-.825.05c-.034-.012-.064-.036-.1-.051a1.066,1.066,0,0,1-.212-.111L8.675,60.319A1.1,1.1,0,0,1,10,58.565L12.432,60.4l.444-.55a1.1,1.1,0,0,1,1.71,1.381Zm0-10.985-1.112,1.377a1.061,1.061,0,0,1-.254.2,1.119,1.119,0,0,1-.128.1,1.079,1.079,0,0,1-.825.05c-.034-.012-.064-.036-.1-.051a1.066,1.066,0,0,1-.212-.111L8.675,49.334A1.1,1.1,0,0,1,10,47.58l2.433,1.835.444-.55a1.1,1.1,0,0,1,1.71,1.381ZM19.674,16.5A14.54,14.54,0,0,1,34.031,4.394a14.95,14.95,0,0,1,2.516.209,14.6,14.6,0,0,1-2.472,28.989,14.973,14.973,0,0,1-2.516-.22A14.6,14.6,0,0,1,19.674,16.5ZM48.333,73.722H21.42a2.2,2.2,0,0,1,0-4.394H48.333a2.2,2.2,0,1,1,0,4.394ZM19.223,60.54a2.2,2.2,0,0,1,2.2-2.2H37.348a2.2,2.2,0,1,1,0,4.394H21.42A2.2,2.2,0,0,1,19.223,60.54Zm32.954-8.788H21.42a2.2,2.2,0,0,1,0-4.394H52.177a2.2,2.2,0,0,1,0,4.394Z"/></g></g></g></svg>
            <span class="menu-txt">Reminder</span>
        </a>
        <a href="" class="item current-vehicle">
            @include($vehicle->vehicle_manufacture->icon)
            <span class="menu-txt">{{ $vehicle->model }}</span>
        </a>
    </div>
    <div class="wrapper">
        @yield('content')
    </div>
    @if(session('notification'))
    @component('components.alertSuccess')
        @slot('title')
            {{ session('notification')[0] }}
        @endslot
        {{ session('notification')[1] }}
    @endcomponent
    @endif
   <script src="{{ asset('js/dashboardLoad.js') }}"></script>
</body>
</html>
