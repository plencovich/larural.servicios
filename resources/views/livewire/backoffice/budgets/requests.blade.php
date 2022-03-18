@section('title', __('events.requests-list'))
<div>
    <x-page-title-container>
    </x-page-title-container>
    <x-scroll-section>
        @livewire('backoffice.budgets.budget-requests')
    </x-scroll-section>
</div>