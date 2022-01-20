<x-modal title="{{ __('users.delete') }}">
    <x-slot name="body">
        <h4>
            {{ sprintf(__('users.ask_delete'), $user->email) }}
        </h4>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.delete wire:click="delete" type="button" />
        <x-buttons.cancel wire:click="$emit('hideModal')" />
    </x-slot>
</x-modal>
