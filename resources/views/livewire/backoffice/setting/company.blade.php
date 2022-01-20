@section('title', __('view.setting_company'))
@section('breadcrumb')
    {{ Breadcrumbs::render('company') }}
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
                    <div class="col-md-4">
                        <label class="form-label">{{ __('view.name') }}</label>
                        <input class="form-control" type="text" wire:model.defer="projectName" />
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">{{ __('view.slogan') }}</label>
                        <input class="form-control" type="text" wire:model.defer="projectSlogan" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('view.email') }}</label>
                        <input class="form-control @error('projectEmail') is-invalid @enderror" type="text"
                            wire:model.defer="projectEmail" />
                        @error('projectEmail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('view.domain') }}</label>
                        <input class="form-control @error('projectDomain') is-invalid @enderror" type="text"
                            wire:model.defer="projectDomain" />
                        @error('projectDomain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('view.link_afip') }}</label>
                        <input class="form-control @error('linkAfip') is-invalid @enderror" type="text"
                            wire:model.defer="linkAfip" />
                        @error('linkAfip')
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
