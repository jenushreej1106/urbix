<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | URBIX</title>

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">

</head>

<body>

    <!-- NAVBAR -->

    <header class="navbar">

        <a href="{{ route('home') }}" class="logo">
            URBIX<span>.</span>
        </a>

        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('explore') }}">Explore</a>
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('updates') }}">Updates</a>
        </nav>

        <a href="{{ route('report') }}" class="nav-button">
            Report Issue ↗
        </a>

    </header>


    <!-- MAIN CONTENT -->

    <main>
        @yield('content')
    </main>


    <!-- FOOTER -->

    <footer>

        <a href="{{ route('home') }}" class="logo">
            URBIX<span>.</span>
        </a>

        <p>Building smarter cities, together.</p>

        <div class="footer-links">
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('help') }}">Help</a>
            <a href="{{ route('login') }}">Login</a>
        </div>

        <span>© 2026 URBIX. All Rights Reserved.</span>

    </footer>

</body>
</html>