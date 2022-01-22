<div>
    <x-form action="store">
        <div class="col-md-6">
            <x-input label="{{ __('customers.business_name') }}" type="text" error="businessName"
                name="customer.business_name" />
        </div>
        <div class="col-md-3">
            <x-input label="{{ __('customers.name') }}" type="text" error="name" name="customer.name" />
        </div>
        <div class="col-md-3">
            <x-input label="{{ __('customers.lastname') }}" type="text" error="lastname" name="customer.lastname" />
        </div>
        <div class="col-md-6">
            <x-input label="{{ __('customers.email') }}" type="text" error="email" name="customer.email" />
        </div>
        <div class="col-md-3">
            <x-input label="{{ __('customers.code') }}" type="text" error="code" name="customer.code" />
        </div>
        <div class="col-12">
            <x-buttons.back wire:click="$emit('customerShow',false)" />
            <x-buttons.edit />
        </div>
    </x-form>
</div>
