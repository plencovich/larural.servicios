<div class="d-flex align-items-center mb-3">
    <p class="m-0">
        @if (
            !$this->event_from ||
            ($this->event_from &&
            $this->event_to &&
            $this->event_from == now()->format('Y-m-d') &&
            $this->event_to == now()->format('Y-m-d'))
        )
            {{ __('products.consulting-today') }}
        @else
            {{ __('products.consulting-date', [
                    'from' => Helper::formatEs($this->event_from),
                    'to' => Helper::formatEs($this->event_to)
            ]) }}
        @endif
    </p>
    <x-button type="button" class="btn-primary ms-3" wire:click="$emit('showModal', 'backoffice.products.consult-stock')">{{ __('products.change-date-range') }}</x-button>
</div>

<x-livewire-tables::bs5.table.cell>
    @if ($row->image)
        <img src="{{ asset('storage/' . $row->image) }}" style="max-width: 5rem;">
    @endif
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
    {!! $row->availableStockForDateRangeFormatted($this->event_from, $this->event_to) !!}
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
