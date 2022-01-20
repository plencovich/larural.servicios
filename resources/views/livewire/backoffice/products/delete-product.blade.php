<x-modal title="{{ __('products.products.delete') }}">
    <x-slot name="body">
        <h4>
            {{ sprintf(__('products.products.ask.delete'), $product->name) }}
        </h4>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.delete wire:click="delete" type="button" />
        <x-buttons.cancel wire:click="$emit('hideModal')" />
    </x-slot>
</x-modal>
