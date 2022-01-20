<x-modal title="{{ __('zones.sub-zones.edit') }}">
    <x-slot name="body">
        <x-form action="store" id="zone-edit">
            <div class="col-md-6">
                <x-select name="zone" label="{{ __('budgets.customersId') }}">
                    @foreach ($zones as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6">
                <x-select name="subZone" label="{{ __('budgets.customersId') }}">
                    @foreach ($subZones as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-12">
                <x-select name="productName" label="{{ __('budgets.customersId') }}">
                    @foreach ($products as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6">
                <x-input label="{{ __('zones.sub-zones.name') }}" type="text" name="productPrice" />
            </div>
            <div class="col-md-6">
                <x-input label="{{ __('zones.sub-zones.name') }}" type="text" name="productQty" />
            </div>
        </x-form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.cancel wire:click="$emit('hideModal')" />
        <x-buttons.edit form="zone-edit" />
    </x-slot>
</x-modal>
