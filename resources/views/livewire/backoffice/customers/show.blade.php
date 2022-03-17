@section('title', __('customers.customers'))
<div>
    <x-page-title-container>
        @if (!$componentShow)
            @can('create', App\Models\Customer::class)
                <x-page-title-add-button show="backoffice.customers.create" />
            @endcan
        @endif
    </x-page-title-container>

    <x-scroll-section>
        @if ($componentShow)
            @livewire($componentShow, $params)
        @else
            @livewire('backoffice.customers.list-customers')
        @endif
    </x-scroll-section>
</div>
