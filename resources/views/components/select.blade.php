@if (!empty($label))
    <label class="form-label">{{ $label }}</label>
@endif
<select class="form-select @error($name) is-invalid @enderror" wire:model="{{ $name }}"
    name="{{ $name }}">
    <option value="">Seleccionar una opcion...</option>
    {{ $slot }}
</select>
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
