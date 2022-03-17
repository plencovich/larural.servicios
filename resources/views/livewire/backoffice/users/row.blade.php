<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->lastname }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->email }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->created_at }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->account_verified_at }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->roles[0]->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    @can('update', $row)
        <x-buttons.small-pen wire:click="$emit('customerShow','backoffice.users.edit', {{ $row }})" />
    @endcan

    @can('delete', $row)
        <x-buttons.small-trash wire:click="$emit('showModal', 'backoffice.users.delete', {{ $row }})" />
    @endcan
</x-livewire-tables::bs5.table.cell>
