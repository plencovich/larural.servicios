<div>
    <div class="card"></div>
    <x-form action="store">
        <div class="col-md-6">
            <x-input label="{{ __('products.products.name') }}" type="text" name="name" />
        </div>
        <div class="col-md-6">
            <x-input label="{{ __('products.products.description') }}" type="text" name="description" />
        </div>
        <div class="col-md-6">
            <x-input label="{{ __('products.products.quantity') }}" type="text" name="quantity" />
        </div>
        <div class="col-md-6">
            <x-input label="{{ __('products.products.price') }}" type="text" name="price" />
        </div>
        <div class="col-md-6">
            <x-select name="category" label="{{ __('products.products.category') }}">
                @foreach ($categories as $value)
                    <option value="{{ $value->id }}">
                        {{ $value->name }}
                    </option>
                @endforeach
            </x-select>
        </div>
        <div class="col-md-6">
            <x-select name="statusProduct" label="{{ __('products.products.status-product') }}">
                @foreach ($statusProducts as $value)
                    <option value="{{ $value->id }}">
                        {{ $value->name }}
                    </option>
                @endforeach
            </x-select>
        </div>
        <div class="col-md-6">
            <x-select name="statusOperation" label="{{ __('products.products.status-operation') }}">
                @foreach ($statusOperations as $value)
                    <option value="{{ $value->id }}">
                        {{ $value->name }}
                    </option>
                @endforeach
            </x-select>
        </div>
        <div class="col-12">
            <x-buttons.back wire:click="$emit('customerShow',false)" />
            <x-buttons.create />
        </div>
    </x-form>
</div>
