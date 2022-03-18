<x-livewire-tables::bs5.table.cell>
    {{ $row->event->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->user->full_name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->event_from ? $row->event_from->isoFormat('LL') : $row->event->event_from->isoFormat('LL') }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->event_to ? $row->event_to->isoFormat('LL') : $row->event->event_to->isoFormat('LL') }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->status_formatted }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    @can('update', $row)
        <x-buttons.small-approve wire:click="$emit('showModal', 'backoffice.budgets.approve-request', {{ $row }})" />
        <x-buttons.small-decline wire:click="$emit('showModal', 'backoffice.budgets.decline-request', {{ $row }})" />
    @endcan
</x-livewire-tables::bs5.table.cell>
