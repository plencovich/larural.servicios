@section('title', __('products.categories.category'))
<div>
    <x-page-title-container>

    </x-page-title-container>

    <div class="row">
        <div class="col-xl-5 mb-n5">
            <div class="mb-5">
                @if ($show)
                    @livewire($show)
                @else
                    @livewire('backoffice.products.category-create')
                @endif

            </div>
        </div>
        <div class="col-xl-7">
            <div class="mb-5">
                <h2 class="small-title">{{ __('products.categories.list') }}</h2>
                <div class="card">
                    <div class="card-body">
                        @livewire('backoffice.products.list-categories')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
