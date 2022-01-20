<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    <x-buttons.small-pen wire:click="$emit('showModal','backoffice.products.category-edit', {{ $row }})" />
    <x-buttons.small-trash
        wire:click="$emit('showModal', 'backoffice.products.category-delete', {{ $row }})" />
</x-livewire-tables::bs5.table.cell>
