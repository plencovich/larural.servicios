<x-modal title="{{ __('budgets.delete') }}">
    <x-slot name="body">
        <h4>
            {{ sprintf(__('budgets.ask.delete'), $budget->event_name) }}
        </h4>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.delete wire:click="delete" type="button" />
        <x-buttons.cancel wire:click="$emit('hideModal')" />
    </x-slot>
</x-modal>
