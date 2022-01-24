<x-livewire-tables::bs5.table.cell>
    {{ $row->event_name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->customer->full_name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->status }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->event_from_at ? $row->event_from_at->isoFormat('LL') : '' }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->event_to_at ? $row->event_to_at->isoFormat('LL') : '' }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    <x-buttons.small-remito wire:click="printRemito({{ $row->id }})" />
    <x-buttons.small-pen wire:click="$emit('customerShow','backoffice.budgets.create-items', {{ $row }})" />
    <x-buttons.small-trash wire:click="$emit('showModal', 'backoffice.customers.delete', {{ $row }})" />
</x-livewire-tables::bs5.table.cell>
