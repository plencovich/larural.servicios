@if ($fromUrl)
    @section('title', __('products.products.products'))
@endif

<div>
    @if ($fromUrl)
        <x-page-title-container>
        </x-page-title-container>
        <x-scroll-section>
            @include('livewire.backoffice.products.edit-product-base')
        </x-scroll-section>
    @else
        @include('livewire.backoffice.products.edit-product-base')
    @endif
</div>
