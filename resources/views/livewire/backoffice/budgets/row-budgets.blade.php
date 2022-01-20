<x-livewire-tables::bs5.table.cell>
    {{ $row->event_name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->event_at }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    <x-buttons.small-pen wire:click="$emit('customerShow','backoffice.budgets.create-items', {{ $row }})" />
    <x-buttons.small-trash wire:click="$emit('showModal', 'backoffice.customers.delete', {{ $row }})" />
</x-livewire-tables::bs5.table.cell>
