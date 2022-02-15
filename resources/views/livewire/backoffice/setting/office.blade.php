@section('title', __('view.setting_office'))
@section('breadcrumb')
    {{ Breadcrumbs::render('office') }}
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
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.office') }}</label>
                        <input class="form-control" type="text" wire:model.defer="projectOffice" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.address') }}</label>
                        <input class="form-control" type="text" wire:model.defer="projectAddress" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.city') }}</label>
                        <input class="form-control" type="text" wire:model.defer="projectCity" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.phone') }}</label>
                        <input class="form-control @error('projectPhone') is-invalid @enderror"" type=" text"
                            wire:model.defer="projectPhone" maxlength="10" />
                        @error('projectPhone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('view.gmaps_link') }}</label>
                        <input class="form-control @error('projectGmapsLink') is-invalid @enderror" type="text"
                            wire:model.defer="projectGmapsLink" />
                        @error('projectGmapsLink')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">{{ __('view.gmaps_iframe') }}</label>
                        <input class="form-control @error('projectGpsIframe') is-invalid @enderror" type="text"
                            wire:model.defer="projectGpsIframe" />
                        @error('projectGpsIframe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{ __('view.hours_office') }}</label>
                        <input class="form-control" type="text" wire:model.defer="projectHoursOffice" />
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">{{ __('button.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
