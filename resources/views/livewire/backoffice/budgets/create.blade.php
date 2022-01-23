<x-modal title="{{ __('budgets.add') }}">
    <x-slot name="body">
        <x-form action="store" id="budget-create">
            <div class="col-md-12">
                <x-select name="customerId" label="{{ __('budgets.customer') }}">
                    @foreach ($customers as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-12">
                <x-input label="{{ __('budgets.event-name') }}" type="text" name="eventName" />
            </div>
        </x-form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.cancel wire:click="$emit('hideModal')" />
        <x-buttons.create form="budget-create" />
    </x-slot>
</x-modal>
