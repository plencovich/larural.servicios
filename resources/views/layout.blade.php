<!DOCTYPE html>
<html lang="es" data-url-prefix="/" data-footer="true" data-color='dark-green'
    data-override='{"attributes": {"placement": "vertical", "layout": "boxed" }}'>


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    @include('_layout.head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    @livewireStyles
</head>

<body>
    <div id="root">
        <div id="nav" class="nav-container d-flex" @isset($custom_nav_data) @foreach ($custom_nav_data as $key => $value)
            data-{{ $key }}="{{ $value }}"
            @endforeach
        @endisset
        >
        @include('_layout.nav')
    </div>
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    {{ $slot }}
                </div>
            </div>
        </div>

    </main>
    @include('_layout.footer')
    @livewireScripts
    <livewire:modals />
    @include('_layout.scripts')
    {{-- TODO: revisar donde lo vamos a poner. --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ asset('/js/modals.js') }}"></script>
    <script src="{{ asset('/js/notify.js') }}"></script>
</body>

</html>
