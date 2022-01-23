<x-modal title="{{ __('zones.sub-zones.add') }}">
    <x-slot name="body">
        <x-form action="store" id="zone-edit">
            <div class="col-md-6">
                <x-select name="zone" label="{{ __('budgets.zone') }}">
                    @foreach ($zones as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6">
                <x-select name="subZone" label="{{ __('budgets.sub-zone') }}">
                    @foreach ($subZones as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-12">
                <x-select name="productName" label="{{ __('budgets.customer') }}">
                    @foreach ($products as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6">
                <x-input label="{{ __('budgets.product.price') }}" type="text" name="productPrice" />
            </div>
            <div class="col-md-6">
                <x-input label="{{ __('budgets.product.quantity') }}" type="text" name="productQty" />
            </div>
        </x-form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.cancel wire:click="$emit('hideModal')" />
        <x-buttons.button form="zone-edit">
            {{ __('button.add') }}
        </x-buttons.button>
    </x-slot>
</x-modal>
