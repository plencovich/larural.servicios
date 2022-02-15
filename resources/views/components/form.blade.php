<form wire:submit.prevent="{{ $action }}" {{ $attributes->merge(['class' => 'row g-3']) }}>
    {{ $slot }}
</form>
