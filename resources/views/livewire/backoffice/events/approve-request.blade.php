<x-modal title="{{ __('events.approve') }}">
    <x-slot name="body">
        <h4>
            {{ sprintf(__('events.ask.approve'), $eventRequest->name) }}
        </h4>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.generic wire:click="approve" type="button">
            {{ __('events.approve') }}
        </x-buttons.generic>
        <x-buttons.cancel wire:click="$emit('hideModal')" />
    </x-slot>
</x-modal>
