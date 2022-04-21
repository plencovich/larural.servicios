@section('title', __('reports.products.rented-products'))
<div>
    <x-page-title-container>
    </x-page-title-container>

    <x-scroll-section>
        <div class="d-flex align-items-center mb-3">
            {{-- Filter by date --}}
            <x-button type="button" class="btn-primary" wire:click="$emit('showModal', 'backoffice.reports.consult.by-date')">{{ __('reports.products.by-date') }}</x-button>

            {{-- Filter by product --}}
            {{-- <x-button type="button" class="btn-primary ms-2" wire:click="$emit('showModal', 'backoffice.reports.consult.by-product')">{{ __('reports.products.by-product') }}</x-button> --}}
        </div>

        <div class="d-flex align-items-center mb-3">
            {{-- Filter by date text --}}
            <p class="m-0">
                @if ($this->from_date &&
                    $this->to_date &&
                    $this->from_date == now()->format('Y-m-d') &&
                    $this->to_date == now()->format('Y-m-d')
                )
                    {{ __('reports.filtering.today') }}
                @elseif (
                    $this->from_date &&
                    $this->to_date
                )
                    {{ __('reports.filtering.by-date', [
                            'from' => Helper::formatEs($this->from_date),
                            'to' => Helper::formatEs($this->to_date)
                    ]) }}
                @endif
            </p>
        </div>

        @if ($componentShow)
            @livewire($componentShow, $params)
        @else
            @livewire('backoffice.reports.list-rented-products')
        @endif
    </x-scroll-section>
</div>
