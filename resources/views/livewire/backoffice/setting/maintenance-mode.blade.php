@section('title', __('view.setting_maintenance_mode'))
@section('breadcrumb')
    {{ Breadcrumbs::render('maintenance-mode') }}
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
                        <label class="form-label">{{ __('view.is_maintenance_status') }}</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input  @error('isMaintenanceStatus') is-invalid @enderror"
                                    type="radio" wire:model="isMaintenanceStatus" value="1"
                                    {{ $isMaintenanceStatus === '1' ? 'checked="checked"' : null }}
                                    name="is_maintenance_status" />
                                <label class="form-check-label">{{ __('view.yes') }}</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('isMaintenanceStatus') is-invalid @enderror"
                                    type="radio" wire:model="isMaintenanceStatus" value="0"
                                    {{ $isMaintenanceStatus === '0' ? 'checked="checked"' : null }}
                                    name="is_maintenance_status" />
                                <label class="form-check-label">{{ __('view.no') }}</label>
                                @error('isMaintenanceStatus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('view.is_maintenance_type') }}</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input  @error('isMaintenanceType') is-invalid @enderror"
                                    type="radio" wire:model="isMaintenanceType" value="basic"
                                    {{ $isMaintenanceType == 'basic' ? 'checked="checked"' : null }}
                                    name="is_maintenance_type" />
                                <label class="form-check-label">{{ __('view.basic') }}<a
                                        href="{{ route('backoffice.setting.maintenance', ['view_type' => 'basic']) }}"
                                        target="_blanch">({{ __('view.example') }})</a></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input  @error('isMaintenanceType') is-invalid @enderror"
                                    type="radio" wire:model="isMaintenanceType" value="contact"
                                    {{ $isMaintenanceType == 'contact' ? 'checked="checked"' : null }}
                                    name="is_maintenance_type" />
                                <label class="form-check-label">{{ __('view.contact') }}<a
                                        href="{{ route('backoffice.setting.maintenance', ['view_type' => 'clasic']) }}"
                                        target="_blanch">({{ __('view.example') }})</a></label>
                                @error('isMaintenanceType')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{ __('view.is_maintenance_title') }}</label>
                        <input class="form-control" type="text" wire:model.defer="isMaintenanceTitle" />
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{ __('view.is_maintenance_desc') }}</label>
                        <input class="form-control" type="text" wire:model.defer="isMaintenanceText" />
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">{{ __('button.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
