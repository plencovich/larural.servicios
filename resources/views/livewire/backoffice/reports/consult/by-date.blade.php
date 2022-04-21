<x-modal title="{{ __('reports.consult.by-date') }}">
    <x-slot name="body">
        <x-form action="consult" id="consult-range">
            <div class="col-md-12">
                <x-input label="{{ __('globals.date_range') }}" type="text" class="datepicker" name="date_range" timezone="{{ config('app.timezone') }}" />
            </div>
        </x-form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.cancel wire:click="$emit('hideModal')" />
        <x-buttons.button form="consult-range">
            {{ __('button.search') }}
        </x-buttons.button>
    </x-slot>
</x-modal>