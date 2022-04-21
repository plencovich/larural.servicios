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
    {!! $row->availableStockForDateRangeFormatted($this->from_date, $this->to_date) !!}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <ul>
        @foreach ($row->productReservations->unique('zone_name') as $reservation)
            <li>{{ $reservation->zone->name }}</li>
        @endforeach
    </ul>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <ul>
        @foreach ($row->productReservations->pluck('budget.event.name') as $event)
            <li>{{ $event }}</li>
        @endforeach
    </ul>
</x-livewire-tables::bs5.table.cell>