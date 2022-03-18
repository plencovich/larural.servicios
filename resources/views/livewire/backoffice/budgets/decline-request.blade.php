<x-modal title="{{ __('budgets.decline') }}">
    <x-slot name="body">
        <h4>
            {{ sprintf(__('budgets.ask.decline'), $budgetRequest->name) }}
        </h4>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.generic wire:click="decline" type="button">
            {{ __('budgets.decline') }}
        </x-buttons.generic>
        <x-buttons.cancel wire:click="$emit('hideModal')" />
    </x-slot>
</x-modal>
