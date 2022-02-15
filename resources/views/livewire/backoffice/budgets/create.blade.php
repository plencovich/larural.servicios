<x-modal title="{{ __('budgets.add') }}">
    <x-slot name="body">
        <x-form action="store" id="budget-create">
            <div class="col-md-12" wire:ignore>
                <x-select name="customer_id" label="{{ __('budgets.customer') }}" class="form-control select2-modal">
                    @foreach ($customers as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->full_name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-12" wire:ignore>
                <x-select name="event_id" label="{{ __('budgets.event') }}" class="form-control select2-modal">
                    @foreach ($events as $value)
                        <option value="{{ $value->id }}" {{ $value->id == $event_id ? 'selected' : null }}>
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
        </x-form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.cancel wire:click="$emit('hideModal')" />
        <x-buttons.create form="budget-create" />
    </x-slot>
</x-modal>
