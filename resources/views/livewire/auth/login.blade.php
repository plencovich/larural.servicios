@section('title', __('view.login'))


<div
    class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
    <div class="sw-lg-50 px-5">
        <div class="sh-11">
            <a href="{{ route('login') }}">
            <div class="logo-default" style="background-image: url(../img/logo/logo-larural-dark.svg);"></div>
            </a>
        </div>
        <div class="mb-5">
            <h2 class="cta-1 mb-0 text-primary">{{ __('view.login_heading') }}</h2>
        </div>
        <div class="mb-5">
            <p class="h6">{{ __('view.login_sub_heading') }}</p>
        </div>
        <form wire:submit.prevent="login" class="tooltip-end-bottom">
            <div class="mb-3 form-group tooltip-end-top">
                <x-input type="email" placeholder="{{ __('view.email') }}" name="email" />
            </div>
            <div class="mb-3 form-group tooltip-end-top">
                <a class="text-small" href="{{ route('password.forgot') }}">{{ __('view.forgot') }}</a>
                <x-input type="password" placeholder="{{ __('view.password') }}" name="password" />
            </div>
            <x-button class="btn btn-lg btn-primary">
                {{ __('button.login') }}
            </x-button>
        </form>
    </div>
</div>
