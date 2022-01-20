@php
$title = empty($title) ? 'customerShow' : $title;
@endphp
<div class="col-12 col-md-5 d-flex align-items-start justify-content-end">
    <x-button wire:click="$emit('{{ $title }}','{{ $show }}')" type="button"
        class="btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto">
        <i class="bi bi-file-plus"></i>
        {{ __('button.add') }}
    </x-button>
</div>
