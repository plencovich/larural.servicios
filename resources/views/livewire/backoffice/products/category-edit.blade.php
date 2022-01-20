<x-modal title="{{ __('products.categories.edit') }}">
    <x-slot name="body">
        <x-form action="store" id="category-edit">
            <div class="col-md-12">
                <x-input label="{{ __('products.categories.name') }}" type="text" name="category.name" />
            </div>
        </x-form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.cancel wire:click="$emit('hideModal')" />
        <x-buttons.edit form="category-edit" />
    </x-slot>
</x-modal>
