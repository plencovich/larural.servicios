@section('title', __('users.users'))
<div>
    <x-page-title-container>
        @if (!$componentShow)
            @can('create', App\Models\User::class)
                <x-page-title-add-button show="backoffice.users.create" />
            @endcan
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
