<x-modal title="{{ __('events.add') }}">
    <x-slot name="body">
        <x-form action="store" id="event-create">
            <div class="col-md-12">
                <x-input label="{{ __('events.name') }}" type="text" name="name" />
            </div>
            <div class="col-md-6">
                <x-input label="{{ __('budgets.from') }}" type="text" class="datepicker" name="from_date" timezone="{{ config('app.timezone') }}" />
            </div>
            <div class="col-md-6">
                <x-input label="{{ __('budgets.to') }}" type="text" class="datepicker" name="to_date" />
            </div>
        </x-form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.cancel wire:click="$emit('hideModal')" />
        <x-buttons.create form="event-create" />
    </x-slot>
</x-modal>