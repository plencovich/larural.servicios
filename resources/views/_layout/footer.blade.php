<!-- Layout Footer Start -->
<footer>
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <p class="mb-0 text-muted text-medium">{{ env('APP_NAME', __('view.not_configured')) }}
                        {{ env('APP_VERSION', '0.0.0') }}</p>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ul class="breadcrumb pt-0 pe-0 mb-0 float-end">
                        <li class="breadcrumb-item mb-0 text-medium"><a
                                href="{{ env('APP_AUTHOR_URL', __('view.not_configured')) }}" target="_blank"
                                class="btn-link">{{ env('APP_AUTHOR', __('view.not_configured')) }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Layout Footer End -->
