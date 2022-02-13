@if (!empty($label))
    <label class="form-label">{{ $label }}</label>
@endif

@php
    $errorClass = $errors->has($name) ? 'is-invalid' : null;
@endphp

<select {!! $attributes->merge(['class' => 'form-control ' . $errorClass]) !!} wire:model="{{ $name }}"
    name="{{ $name }}">
    <option value="">{{ __('globals.select_option') }}</option>
    {{ $slot }}
</select>
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
