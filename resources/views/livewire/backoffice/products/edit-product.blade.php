<div>
    <x-form action="store">
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
            <x-input label="{{ __('products.products.price') }}" type="text" name="product.price" />
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
        <div class="col-12">
            <x-buttons.back wire:click="$emit('customerShow',false)" />
            <x-buttons.edit />
        </div>
    </x-form>
</div>
