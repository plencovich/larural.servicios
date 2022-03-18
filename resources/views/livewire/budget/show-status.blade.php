@section('title', __('view.login'))


<div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
    <div class="sw-lg-50 px-5">
        <div class="mb-5">
            <h2 class="cta-1 mb-0 text-primary">{{ __('view.budget.hello') }} {{ $budget->customer->full_name }}</h2>
        </div>
        <div class="mb-5">
            <p class="h6">{{ __('view.budget.info') }}:</p>
            <p class="h6"><strong>{{ __('view.budget.event') }}</strong>: {{ $budget->event->name }}</p>
            <p class="h6"><strong>{{ __('budgets.date_from') }}</strong>: {{ $budget->event_from ? $budget->event_from->isoFormat('LL') : '' }}</p>
            <p class="h6"><strong>{{ __('budgets.date_to') }}</strong>: {{ $budget->event_to ? $budget->event_to->isoFormat('LL') : '' }}</p>
            <p class="h6"><strong>{{ __('view.budget.discount') }}</strong>: {{ $budget->discount }}%</p>
            <p class="h6"><strong>{{ __('view.budget.observations') }}</strong>: {{ $budget->observations }}</p>
        </div>
        <div class="mb-5">
            <h3 class="">{{ __('view.budget.sub-zones') }}:</h3>
            @forelse ($subZones as $items)
                {{-- Zone name --}}
                <p class="h6"><strong>{{ $items[0]->zone->name }}</strong>, {{ $items[0]->subZone->name }}</p>

                {{-- Items --}}
                @foreach ($items as $item)
                    <p class="h6">{{ $item->product_qty }}x {{ $item->product->name }} ${{ number_format($item->product_price, 2) }}</p>
                @endforeach

                <hr>
            @empty
                <p class="h6"><strong>{{ __('view.budget.no-sub-zones') }}</strong></p>
            @endforelse

            <h3><strong>{{ __('view.budget.total') }}: ${{ $budget->total }}</strong></h3>
        </div>

        <div class="mb-5">
            <h4 class="{{ $budget->isRejected() ? 'text-danger' : 'text-success' }}">
                {{ $budget->isRejected() ? __('budgets.rejected') : __('budgets.approved') }}
            </h4>
        </div>

        {{-- Important notes --}}
        <div class="mb-5">
            <x-button type="button"
                class="btn btn-link"
                data-bs-toggle="modal"
                data-bs-target="#important-notes">
                <i class="bi bi-info-circle"></i>
                {{ __('button.important-notes') }}
            </x-button>
        </div>
    </div>

    @include('livewire.budget.important-notes-modal')
</div>
