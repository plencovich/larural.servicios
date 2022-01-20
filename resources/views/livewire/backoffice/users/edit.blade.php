<div>
    <x-form action="store">
        <div class="col-md-6">
            <x-input label="{{ __('users.name') }}" type="text" name="user.name" />
        </div>
        <div class="col-md-6">
            <x-input label="{{ __('users.lastname') }}" type="text" name="user.lastname" />
        </div>
        <div class="col-md-6">
            <x-input label="{{ __('users.email') }}" type="email" name="user.email" />
        </div>
        <div class="col-12">
            <x-buttons.back wire:click="$emit('customerShow',false)" />
            <x-buttons.edit />
        </div>
    </x-form>
</div>
