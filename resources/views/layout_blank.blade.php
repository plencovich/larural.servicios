<!DOCTYPE html>
<html lang="es" data-url-prefix="/">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    @include('_layout.head')
    @livewireStyles
</head>

<body class="h-100">
    <div id="root" class="h-100">
        <div class="container-fluid p-0 h-100 position-relative">
            <div class="row g-0 h-100">
                {{ $slot }}
            </div>
        </div>
    </div>

    @livewireScripts
    @include('_layout.scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts')
</body>

</html>
