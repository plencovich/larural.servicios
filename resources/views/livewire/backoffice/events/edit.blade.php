<x-modal title="{{ __('events.edit') }}">
    <x-slot name="body">
        <x-form action="update" id="event-update">
            <div class="col-md-12">
                <x-input label="{{ __('events.name') }}" type="text" name="name" autofocus />
            </div>
            <div class="col-md-12">
                <x-input label="{{ __('globals.date_range') }}" type="text" value="{{ $event->event_from->format('d/m/Y') }} - {{ $event->event_to->format('d/m/Y') }}" readonly />
            </div>
        </x-form>
    </x-slot>
    <x-slot name="footer">
        @if (filled($budgets))
            <div class="col-12">
                <h4>{{ __('events.budgets') }}:</h4>
                <ul>
                    @foreach ($budgets as $budget)
                        <li><a href="{{ route('backoffice.budgets.edit', $budget) }}" class="btn-link text-info" target="_blank">{{ $budget->customer->full_name }}</a>: ${{ $budget->total }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (filled($items))
            <div class="col-12">
                <h4>{{ __('events.items') }}:</h4>
                <ul>
                    @foreach ($items as $item)
                        <li>{{ $item->product->name }}: {{ $item->total_products }}</li>
                    @endforeach
                </ul>

                <a href="{{ route('event.print-inventory', $event) }}" class="btn btn-primary" target="_blank">{{ __('events.print_inventory') }}</a>
            </div>
        @endif
        <x-buttons.cancel wire:click="$emit('hideModal')" />
        <x-buttons.edit form="event-update" />
    </x-slot>
</x-modal>