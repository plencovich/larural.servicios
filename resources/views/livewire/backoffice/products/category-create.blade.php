<div>
    <h2 class="small-title">{{ __('products.categories.add') }}</h2>
    <div class="card">
        <div class="card-body">
            <x-form action="store">
                <div class="col-md-12">
                    <x-input label="{{ __('users.name') }}" type="text" name="name" :readonly="! auth()->user()->can('create', App\Models\Category::class)" />
                </div>
                <div class="col-12">
                    @can('create', App\Models\Category::class)
                        <x-buttons.create />
                    @endcan
                </div>
            </x-form>
        </div>
    </div>
</div>
