@props(['type' => 'text', 'placeholder' => '', 'name' => '', 'readonly' => false, 'label' => '', 'help' => ''])

@if ($label)
    <label class="form-label">{{ $label }}</label>
@endisset
@php
    $errorClass = $errors->has($name) ? 'is-invalid' : null;
@endphp
<input type="{{ $type }}" {!! $attributes->merge(['class' => 'form-control ' . $errorClass]) !!} @if ($name)wire:model.debounce.500ms="{{ $name }}" @endif placeholder="{{ $placeholder }}" @if ($readonly) readonly @endif />

@if ($help)
    <small id="help-{{ $name }}" class="form-text text-muted">{!! $help !!}</small>
@endisset

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
