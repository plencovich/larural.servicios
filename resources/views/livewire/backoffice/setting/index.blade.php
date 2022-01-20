@section('title', __('view.setting'))
<div class="row row-cols-1 row-cols-md-2 g-2">
    <div class="col">
        <a href="{{ route('backoffice.setting.company') }}" class="card hover-border-primary h-100">
            <div class="card-body row g-0">
                <div class="col-auto">
                    <div
                        class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                        <i data-cs-icon="building" class="icon"></i>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column ps-card justify-content-start">
                        <div class="d-flex flex-column justify-content-center mb-2">
                            <div class="heading text-primary mb-0">{{ __('view.company') }}</div>
                        </div>
                        <div class="text-alternate">
                            {{ __('view.description_company') }}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('backoffice.setting.office') }}" class="card hover-border-primary h-100">
            <div class="card-body row g-0">
                <div class="col-auto">
                    <div
                        class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                        <i data-cs-icon="home" class="icon"></i>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column ps-card justify-content-start">
                        <div class="d-flex flex-column justify-content-center mb-2">
                            <div class="heading text-primary mb-0">{{ __('view.office') }}</div>
                        </div>
                        <div class="text-alternate">
                            {{ __('view.description_company') }}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('backoffice.setting.mail-reception') }}" class="card hover-border-primary h-100">
            <div class="card-body row g-0">
                <div class="col-auto">
                    <div
                        class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                        <i data-cs-icon="email" class="icon"></i>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column ps-card justify-content-start">
                        <div class="d-flex flex-column justify-content-center mb-2">
                            <div class="heading text-primary mb-0">{{ __('view.mail_reception') }}</div>
                        </div>
                        <div class="text-alternate">
                            {{ __('view.description_company') }}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('backoffice.setting.social-networks') }}" class="card hover-border-primary h-100">
            <div class="card-body row g-0">
                <div class="col-auto">
                    <div
                        class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                        <i data-cs-icon="eye" class="icon"></i>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column ps-card justify-content-start">
                        <div class="d-flex flex-column justify-content-center mb-2">
                            <div class="heading text-primary mb-0">{{ __('view.social_networks') }}</div>
                        </div>
                        <div class="text-alternate">
                            {{ __('view.description_company') }}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('backoffice.setting.maintenance-mode') }}" class="card hover-border-primary h-100">
            <div class="card-body row g-0">
                <div class="col-auto">
                    <div
                        class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                        <i data-cs-icon="tool" class="icon"></i>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column ps-card justify-content-start">
                        <div class="d-flex flex-column justify-content-center mb-2">
                            <div class="heading text-primary mb-0">{{ __('view.maintenance_mode') }}</div>
                        </div>
                        <div class="text-alternate">
                            {{ __('view.description_company') }}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('backoffice.setting.payment-methods') }}" class="card hover-border-primary h-100">
            <div class="card-body row g-0">
                <div class="col-auto">
                    <div
                        class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                        <i data-cs-icon="money" class="icon"></i>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column ps-card justify-content-start">
                        <div class="d-flex flex-column justify-content-center mb-2">
                            <div class="heading text-primary mb-0">{{ __('view.payment_methods') }}</div>
                        </div>
                        <div class="text-alternate">
                            {{ __('view.description_company') }}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
