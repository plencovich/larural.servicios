<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    <x-buttons.small-list-task
        wire:click="$emit('customerShow','backoffice.zones.create-sub-zones', {{ $row }})" />

    @can('update', $row)
        <x-buttons.small-pen wire:click="$emit('showModal','backoffice.zones.edit', {{ $row }})" />
    @endcan

    @can('delete', $row)
        <x-buttons.small-trash wire:click="$emit('showModal', 'backoffice.zones.delete', {{ $row }})" />
    @endcan
</x-livewire-tables::bs5.table.cell>
