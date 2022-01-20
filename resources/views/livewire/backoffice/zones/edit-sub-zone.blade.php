<x-modal title="{{ __('zones.sub-zones.edit') }}">
    <x-slot name="body">
        <x-form action="store" id="zone-edit">
            <div class="col-md-12">
                <x-input label="{{ __('zones.sub-zones.name') }}" type="text" name="subZone.name" />
            </div>
        </x-form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.cancel wire:click="$emit('hideModal')" />
        <x-buttons.edit form="zone-edit" />
    </x-slot>
</x-modal>
