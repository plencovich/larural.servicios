<x-form action="store">
    <div class="col-md-12">
        <x-input label="{{ __('products.products.image') }}" type="file" name="image" />
        @if ($image)
            <img src="{{ $image->temporaryUrl() }}" class="w-40">
        @elseif ($product && $product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="w-40">
        @endif
    </div>
    <div class="col-md-6">
        <x-input label="{{ __('products.products.code') }}" type="text" name="product.code" />
    </div>
    <div class="col-md-6">
        <x-input label="{{ __('products.products.name') }}" type="text" name="product.name" />
    </div>
    <div class="col-md-6">
        <x-input label="{{ __('products.products.description') }}" type="text" name="product.description" />
    </div>
    <div class="col-md-6">
        <x-input label="{{ __('products.products.quantity') }}" type="text" name="product.quantity" />
    </div>
    <div class="col-md-6">
        <x-select name="product.category_id" label="{{ __('products.products.category') }}">
            @foreach ($categories as $value)
                <option value="{{ $value->id }}">
                    {{ $value->name }}
                </option>
            @endforeach
        </x-select>
    </div>
    <div class="col-md-6">
        <x-select name="product.status_product_id" label="{{ __('products.products.status-product') }}">
            @foreach ($statusProducts as $value)
                <option value="{{ $value->id }}">
                    {{ $value->name }}
                </option>
            @endforeach
        </x-select>
    </div>
    <div class="col-md-6">
        <x-select name="product.status_operation_id" label="{{ __('products.products.status-operation') }}">
            @foreach ($statusOperations as $value)
                <option value="{{ $value->id }}">
                    {{ $value->name }}
                </option>
            @endforeach
        </x-select>
    </div>
    <fieldset>
        <legend>{{ __('products.prices.internal') }}</legend>
        <div class="row">
            <div class="col-md-4">
                <x-input label="{{ __('products.prices.day_a') }}" type="number" name="internal_day_a" />
            </div>
            <div class="col-md-4">
                <x-input label="{{ __('products.prices.day_b') }}" type="number" name="internal_day_b" />
            </div>
            <div class="col-md-4">
                <x-input label="{{ __('products.prices.day_c') }}" type="number" name="internal_day_c" />
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>{{ __('products.prices.external') }}</legend>
        <div class="row">
            <div class="col-md-4">
                <x-input label="{{ __('products.prices.day_a') }}" type="number" name="external_day_a" />
            </div>
            <div class="col-md-4">
                <x-input label="{{ __('products.prices.day_b') }}" type="number" name="external_day_b" />
            </div>
            <div class="col-md-4">
                <x-input label="{{ __('products.prices.day_c') }}" type="number" name="external_day_c" />
            </div>
        </div>
    </fieldset>
    <div class="col-12">
        @if ($fromUrl)
            <x-buttons.back-link href="{{ route('backoffice.products.list') }}" />
        @else
            <x-buttons.back wire:click="$emit('customerShow',false)" />
        @endif
        <x-buttons.edit />
    </div>
</x-form>
