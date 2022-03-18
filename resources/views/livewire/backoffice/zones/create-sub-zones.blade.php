<div>

    <div class="row">
        <div class="col-xl-5 mb-n5">
            <div class="mb-5">
                <h2 class="small-title">{{ __('zones.sub-zones.add') }}</h2>
                <div class="card">
                    <div class="card-body">
                        <x-form action="store">
                            <div class="col-md-12">
                                <x-input label="{{ __('zones.sub-zones.name') }}" type="text" name="name" :readonly="! auth()->user()->can('create', App\Models\Zone::class)" />
                            </div>
                            <div class="col-12">
                                <x-buttons.back wire:click="$emit('customerShow',false)" />

                                @can('create', App\Models\Zone::class)
                                    <x-buttons.create />
                                @endcan
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7">
            <div class="mb-5">
                <h2 class="small-title">{{ __('zones.sub-zones.list') }}</h2>
                <div class="card">
                    <div class="card-body">
                        @livewire('backoffice.zones.list-sub-zones', ['zoneId' => $zone->id])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
