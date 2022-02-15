@section('title', __('users.users'))
<div>
    <x-page-title-container>
        @if (!$componentShow)
            <x-page-title-add-button show="backoffice.users.create" />
        @endif
    </x-page-title-container>

    <x-scroll-section>
        @if ($componentShow)
            @livewire($componentShow, $params)
        @else
            @livewire('backoffice.users.list-users')
        @endif
    </x-scroll-section>
</div>
