<x-modal title="{{ __('events.decline') }}">
    <x-slot name="body">
        <h4>
            {{ sprintf(__('events.ask.decline'), $eventRequest->name) }}
        </h4>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.generic wire:click="decline" type="button">
            {{ __('events.decline') }}
        </x-buttons.generic>
        <x-buttons.cancel wire:click="$emit('hideModal')" />
    </x-slot>
</x-modal>
