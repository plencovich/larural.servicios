<x-modal title="{{ __('zones.sub-zones.delete') }}">
    <x-slot name="body">
        <h4>
            {{ sprintf(__('zones.sub-zones.ask.delete'), $subZone->name) }}
        </h4>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.delete wire:click="delete" type="button" />
        <x-buttons.cancel wire:click="$emit('hideModal')" />
    </x-slot>
</x-modal>
