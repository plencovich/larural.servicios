@section('title', __('budgets.budgets-list'))
<div>
    @if ($componentShow)
        @livewire($componentShow, $params)
    @else
        <x-page-title-container>
            @if (!$componentShow)
                @can('create', App\Models\Budget::class)
                    <x-page-title-add-button title="showModal" show="backoffice.budgets.create" />
                @endcan
            @endif
        </x-page-title-container>
        <x-scroll-section>
            @livewire('backoffice.budgets.list-budgets')
        </x-scroll-section>
    @endif
</div>