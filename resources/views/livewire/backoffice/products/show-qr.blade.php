<x-modal title="{{ __('products.products.show-qr') }}">
    <x-slot name="body">
        <div class="text-center" id="qr-code">
            {!! QrCode::size(300)->generate(route('backoffice.products.edit', $product)) !!}
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-button type="button" class="btn-primary print-remito" data-print-title="{{ $product->name }}">
            {{ __('button.print') }}
        </x-button>
    </x-slot>
</x-modal>