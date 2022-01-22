<x-modal title="{{ __('products.products.show-qr') }}">
    <x-slot name="body">
        <div class="text-center">
            {!! QrCode::size(300)->generate($product->code) !!}
        </div>
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-modal>
