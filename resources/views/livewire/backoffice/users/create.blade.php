<div>
    <x-form action="store">
        <div class="col-md-6">
            <x-input label="{{ __('users.name') }}" type="text" name="name" />
        </div>
        <div class="col-md-6">
            <x-input label="{{ __('users.lastname') }}" type="text" name="lastname" />
        </div>
        <div class="col-md-6">
            <x-input label="{{ __('users.email') }}" type="email" name="email" />
        </div>
        <div class="col-md-6">
            <x-select name="role" label="{{ __('users.role') }}">
                @foreach ($roles as $value)
                    <option value="{{ $value->name }}">
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
