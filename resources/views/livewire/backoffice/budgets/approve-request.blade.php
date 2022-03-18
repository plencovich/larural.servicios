<x-modal title="{{ __('budgets.approve') }}">
    <x-slot name="body">
        <h4>
            {{ sprintf(__('budgets.ask.approve'), $budgetRequest->name) }}
        </h4>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.generic wire:click="approve" type="button">
            {{ __('budgets.approve') }}
        </x-buttons.generic>
        <x-buttons.cancel wire:click="$emit('hideModal')" />
    </x-slot>
</x-modal>
