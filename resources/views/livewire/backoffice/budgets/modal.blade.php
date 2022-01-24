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
                <x-select name="productName" label="{{ __('budgets.product.product') }}">
                    @foreach ($products as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6">
                <x-select name="productPrice" label="{{ __('budgets.product.price') }}">
                    @foreach ($prices as $price)
                        <option value="{{ $price->day_a }}">
                            ${{ $price->day_a }} ({{ $price->productPriceType->name }})
                        </option>
                        <option value="{{ $price->day_b }}">
                            ${{ $price->day_b }} ({{ $price->productPriceType->name }})
                        </option>
                        <option value="{{ $price->day_c }}">
                            ${{ $price->day_c }} ({{ $price->productPriceType->name }})
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6">
                <x-input label="{{ __('budgets.product.quantity') }}" type="number" name="productQty" />
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
