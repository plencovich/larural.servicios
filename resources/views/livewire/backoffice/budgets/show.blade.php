@section('title', __('budgets.budgets-list'))
<div>
    @if ($componentShow)
        @livewire($componentShow, $params)
    @else
        <x-page-title-container>
            @if (!$componentShow)
                <x-page-title-add-button title="showModal" show="backoffice.budgets.create" />
            @endif
        </x-page-title-container>
        <x-scroll-section>
            @livewire('backoffice.budgets.list-budgets')
        </x-scroll-section>
    @endif
</div>
