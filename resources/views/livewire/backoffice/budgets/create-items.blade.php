@if ($fromUrl)
    @section('title', __('budgets.edit'))
@endif

<div>
    @include('livewire.backoffice.budgets.create-items-base')
</div>
