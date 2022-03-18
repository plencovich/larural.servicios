<x-livewire-tables::bs5.table.cell>
    {{ $row->code }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->business_name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->lastname }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->email }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    @can('update', $row)
        <x-buttons.small-pen wire:click="$emit('customerShow','backoffice.customers.edit', {{ $row }})" />
    @endcan

    @can('delete', $row)
        <x-buttons.small-trash wire:click="$emit('showModal', 'backoffice.customers.delete', {{ $row }})" />
    @endcan
</x-livewire-tables::bs5.table.cell>
