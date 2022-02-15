@section('title', __('view.forgot'))

<div
    class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
    <div class="sw-lg-50 px-5">
        <div class="sh-11">
            <a href="{{ url('/') }}">
                <div class="logo-default"></div>
            </a>
        </div>
        <div class="mb-3">
            <h2 class="cta-1 mb-0 text-primary">{{ __('view.forgot_password_heading') }}</h2>
        </div>
        <div class="mb-3">
            <p class="h6">{{ __('view.forgot_password_subheading') }}</p>
        </div>
        @if ($status)
            <div class="alert alert-success" role="alert">
                {{ $status }}
            </div>
        @endif
        <form wire:submit.prevent="sendResetLink" class="tooltip-end-bottom">
            <div class="mb-3 form-group tooltip-end-top">
                <x-input type="email" placeholder="{{ __('view.email') }}" name="email" />
            </div>
            <x-button class="btn btn-lg btn-primary">
                {{ __('button.send') }}
            </x-button>
        </form>
    </div>
</div>
