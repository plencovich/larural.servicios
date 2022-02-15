@section('title', __('view.password_reset'))

<div class="col-12 col-lg-auto h-100 pb-4 px-4 pt-0 p-lg-0">
    <div
        class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
        <div class="sw-lg-50 px-5">
            <div class="sh-11">
                <a href="{{ url('/') }}">
                    <div class="logo-default"></div>
                </a>
            </div>
            <div class="mb-5">
                <h2 class="cta-1 mb-0 text-primary">{{ __('view.reset_password_heading') }}</h2>
            </div>
            <div>
                <form wire:submit.prevent="resetPassword" class="tooltip-end-bottom">
                    <input type="text" hidden name="token" value="{{ request()->route('token') }}">
                    <div class="mb-3 form-group tooltip-end-top">
                        <x-input type="email" placeholder="{{ __('view.email') }}" name="email" readonly=true />
                    </div>
                    <div class="mb-3 form-group tooltip-end-top">
                        <x-input type="password" placeholder="{{ __('view.password') }}" name="password" />
                    </div>
                    <div class="mb-3 form-group tooltip-end-top">
                        <x-input type="password" placeholder="{{ __('view.password_confirm') }}"
                            name="password_confirmation" />
                    </div>
                    <x-button class="btn btn-lg btn-primary">
                        {{ __('button.confirms') }}
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</div>
