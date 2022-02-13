<x-modal title="{{ __('zones.sub-zones.add') }}">
    <x-slot name="body">
        <x-form action="store" id="zone-edit">
            <div class="col-md-6">
                <x-select name="zone" label="{{ __('budgets.zone') }}" class="form-control select2-modal">
                    @foreach ($zones as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6">
                <x-select name="subZone" label="{{ __('budgets.sub-zone') }}" class="form-control select2-modal">
                    @foreach ($subZones as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-12">
                <x-select name="product_id" label="{{ __('budgets.product.product') }}" class="form-control select2-modal">
                    @foreach ($products as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6">
                <x-select name="productPrice" label="{{ __('budgets.product.price') }}" class="form-control select2-modal">
                    @foreach ($prices as $price)
                        <option value="{{ $price->day_a }}">
                            ${{ $price->day_a }} ({{ $price->productPriceType->name }}) ({{ __('products.prices.day_a') }})
                        </option>
                        <option value="{{ $price->day_b }}">
                            ${{ $price->day_b }} ({{ $price->productPriceType->name }}) ({{ __('products.prices.day_b') }})
                        </option>
                        <option value="{{ $price->day_c }}">
                            ${{ $price->day_c }} ({{ $price->productPriceType->name }}) ({{ __('products.prices.day_c') }})
                        </option>
                        <option value="{{ $price->day_d }}">
                            ${{ $price->day_d }} ({{ $price->productPriceType->name }}) ({{ __('products.prices.day_d') }})
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6">
                <x-input label="{{ __('budgets.product.quantity') }}" type="number" name="productQty" />
            </div>
            <div class="col-md-6">
                <x-input label="{{ __('budgets.discount') }}" type="number" name="discount" />
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
