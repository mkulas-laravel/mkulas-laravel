<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- css -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- js -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
<body class="antialiased">
    <header>
        <img src="{{ asset('images/logo.png') }}" alt="logo">
        <nav>
            <ul>
                @yield('navbar')
                <li><a href="/faq">FAQ</a></li>
                <li><label for="search"><input id="search" type="search" class="" placeholder="Nájsť meno"></label> </li>
            </ul>
        </nav>

    </header>
    <main>
        <ul id="search_list">

        </ul>
        @yield('content')
    </main>
    <footer>
        © {{now()->year}} Girone s.r.o.
    </footer>
</body>
</html>
