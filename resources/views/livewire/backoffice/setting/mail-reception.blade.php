@section('title', __('view.setting_mail'))
@section('breadcrumb')
    {{ Breadcrumbs::render('mail-reception') }}
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
                    <div class="col-md-6">
                        <label class="form-label">{{ __('view.contact') }}</label>
                        <input class="form-control @error('emailContact') is-invalid @enderror" type="text"
                            wire:model.defer="emailContact" />
                        @error('emailContact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('view.sales') }}</label>
                        <input class="form-control @error('emailSales') is-invalid @enderror" type="text"
                            wire:model.defer="emailSales" />
                        @error('emailSales')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">{{ __('button.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
