<div class="page-title-container">
    <div class="row">
        <div class="col-12 col-md-7">
            <h1 class="mb-0 pb-0 display-4" id="title">@yield('title')</h1>
            @yield('breadcrumb')
        </div>
        {{ $slot }}
    </div>
</div>
