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
                        <li>{{ $budget->customer->full_name }}: ${{ number_format($budget->total, 2) }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <x-buttons.cancel wire:click="$emit('hideModal')" />
        <x-buttons.edit form="event-update" />
    </x-slot>
</x-modal>