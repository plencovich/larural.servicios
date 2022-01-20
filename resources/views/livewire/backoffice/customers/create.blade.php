<div>
    <x-form action="store">
        <div class="col-md-6">
            <x-input label="{{ __('customers.business_name') }}" type="text" error="businessName"
                name="businessName" />
        </div>
        <div class="col-md-3">
            <x-input label="{{ __('customers.name') }}" type="text" error="name" name="name" />
        </div>
        <div class="col-md-3">
            <x-input label="{{ __('customers.lastname') }}" type="text" error="lastname" name="lastname" />
        </div>
        <div class="col-md-6">
            <x-input label="{{ __('customers.email') }}" type="text" error="email" name="email" />
        </div>
        <div class="col-12">
            <x-buttons.back wire:click="$emit('customerShow',false)" />
            <x-buttons.create />
        </div>
    </x-form>
</div>
