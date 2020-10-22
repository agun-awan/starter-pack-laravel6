<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - @yield('title', 'Starter Pack Laravel 6')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-default bg-transparent">
            @component('components.NavbarContent') @endcomponent
        </nav>
    </header>

    <main>
        <article class="col-12">
            @component('components.MainContent') @endcomponent
        </article>
    </main>

    <footer>
        @component('components.FooterContent') @endcomponent
    </footer>

    @yield('scripts')
</body>
</html>
