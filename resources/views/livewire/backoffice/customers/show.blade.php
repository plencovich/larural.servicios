@section('title', __('customers.customers'))
<div>
    <x-page-title-container>
        @if (!$componentShow)
            <x-page-title-add-button show="backoffice.customers.create" />
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
