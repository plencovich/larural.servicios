@section('title', __('view.setting_payment_methods'))
@section('breadcrumb')
    {{ Breadcrumbs::render('payment-methods') }}
@endsection
<div>
    <section class="scroll-section">
        <div class="card">
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form wire:submit.prevent="store" method="POST" class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">{{ __('view.mp_user_id') }}</label>
                        <input class="form-control" type="text" wire:model.defer="mpUserId" />
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">{{ __('view.mp_client_id') }}</label>
                        <input class="form-control" type="text" wire:model.defer="mpClientId" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('view.mp_client_secret') }}</label>
                        <input class="form-control" type="text" wire:model.defer="mpClientSecret" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('view.mp_access_token') }}</label>
                        <input class="form-control" type="text" wire:model.defer="mpAccessToken" />
                    </div>
                    <div class="col-md-12">
                        <a href="{{ __('view.mp_link_credentials') }}" target="_blank"
                            class="btn-link">{{ __('view.click_here') }}</a>
                        {{ __('view.info_mp_credentials') }}
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">{{ __('button.save') }}</button>
                    </div>
            </div>
            </form>
        </div>
</div>
</section>
</div>
