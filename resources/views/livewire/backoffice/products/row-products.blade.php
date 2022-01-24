<x-livewire-tables::bs5.table.cell>
    <img src="{{ asset('storage/' . $row->image) }}" style="max-width: 5rem;">
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->code }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->description }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->quantity }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->category->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->statusProduct->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->statusOperation->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    <x-buttons.small-qr-code wire:click="$emit('showModal','backoffice.products.show-qr', {{ $row }})" />
    <x-buttons.small-pen wire:click="$emit('customerShow','backoffice.products.edit-product', {{ $row }})" />
    <x-buttons.small-trash wire:click="$emit('showModal', 'backoffice.products.delete-product', {{ $row }})" />
</x-livewire-tables::bs5.table.cell>
