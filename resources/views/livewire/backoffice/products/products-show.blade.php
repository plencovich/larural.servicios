@section('title', __('products.products.products'))
<div>
    <x-page-title-container>
        @if (!$componentShow)
            <x-page-title-add-button show="backoffice.products.create-product" />
        @endif
    </x-page-title-container>

    <x-scroll-section>
        <div class="d-flex align-items-center mb-3">
            <p class="m-0">
                @if (
                    !$this->event_from ||
                    ($this->event_from &&
                    $this->event_to &&
                    $this->event_from == now()->format('Y-m-d') &&
                    $this->event_to == now()->format('Y-m-d'))
                )
                    {{ __('products.consulting-today') }}
                @else
                    {{ __('products.consulting-date', [
                            'from' => Helper::formatEs($this->event_from),
                            'to' => Helper::formatEs($this->event_to)
                    ]) }}
                @endif
            </p>
            <x-button type="button" class="btn-primary ms-3" wire:click="$emit('showModal', 'backoffice.products.consult-stock')">{{ __('products.change-date-range') }}</x-button>
        </div>

        @if ($componentShow)
            @livewire($componentShow, $params)
        @else
            @livewire('backoffice.products.list-products')
        @endif
    </x-scroll-section>
</div>
