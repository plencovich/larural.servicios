<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    @can('update', $row->singleZone)
        <x-buttons.small-pen wire:click="$emit('showModal','backoffice.zones.edit-sub-zone', {{ $row }})" />
    @endcan

    @can('delete', $row->singleZone)
        <x-buttons.small-trash wire:click="$emit('showModal', 'backoffice.zones.delete-sub-zone', {{ $row }})" />
    @endcan
</x-livewire-tables::bs5.table.cell>
