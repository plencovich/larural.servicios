@section('title', __('events.requests-list'))
<div>
    <x-page-title-container>
    </x-page-title-container>
    <x-scroll-section>
        @livewire('backoffice.events.list-requests')
    </x-scroll-section>
</div>