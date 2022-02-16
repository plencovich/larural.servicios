<x-livewire-tables::bs5.table.cell>
    {{ $row->event->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->customer->full_name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->status }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->event_from ? $row->event_from->isoFormat('LL') : $row->event->event_from->isoFormat('LL') }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->event_to ? $row->event_to->isoFormat('LL') : $row->event->event_to->isoFormat('LL') }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    <x-buttons.small-remito wire:click="printRemito({{ $row->id }})" />
    <x-buttons.small-pen wire:click="$emit('customerShow','backoffice.budgets.create-items', {{ $row }})" />
    <x-buttons.small-trash wire:click="$emit('showModal', 'backoffice.budgets.delete', {{ $row }})" />
</x-livewire-tables::bs5.table.cell>
