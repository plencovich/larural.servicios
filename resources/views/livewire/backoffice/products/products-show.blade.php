@section('title', __('products.products.products'))
<div>
    <x-page-title-container>
        @if (!$componentShow)
            <x-page-title-add-button show="backoffice.products.create-product" />
        @endif
    </x-page-title-container>

    <x-scroll-section>
        @if ($componentShow)
            @livewire($componentShow, $params)
        @else
            @livewire('backoffice.products.list-products')
        @endif
    </x-scroll-section>
</div>
