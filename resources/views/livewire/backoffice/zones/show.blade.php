@section('title', __('zones.zones.zones'))
<div>
    <x-page-title-container>

    </x-page-title-container>

    @if ($componentShow)
        @livewire($componentShow, $params)
    @else

        <div class="row">
            <div class="col-xl-5 mb-n5">
                <div class="mb-5">
                    <h2 class="small-title">{{ __('zones.zones.add') }}</h2>
                    <div class="card">
                        <div class="card-body">
                            <x-form action="store">
                                <div class="col-md-12">
                                    <x-input label="{{ __('zones.zones.zone') }}" type="text" name="name" :readonly="! auth()->user()->can('create', App\Models\Zone::class)" />
                                </div>
                                @can('create', App\Models\Zone::class)
                                    <div class="col-12">
                                        <x-buttons.create />
                                    </div>
                                @endcan
                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="mb-5">
                    <h2 class="small-title">{{ __('zones.zones.list') }}</h2>
                    <div class="card">
                        <div class="card-body">
                            @livewire('backoffice.zones.list-zones')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
