<div>
    <h2 class="small-title">{{ __('products.categories.add') }}</h2>
    <div class="card">
        <div class="card-body">
            <x-form action="store">
                <div class="col-md-12">
                    <x-input label="{{ __('users.name') }}" type="text" name="name" />
                </div>
                <div class="col-12">
                    <x-buttons.create />
                </div>
            </x-form>
        </div>
    </div>
</div>
