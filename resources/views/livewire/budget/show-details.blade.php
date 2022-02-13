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
                    <p class="h6">
                        {{ $item->product_qty }}x {{ $item->product->name }} ${{ number_format($item->product_price, 2) }}
                        @if ($item->discount > 0)
                            ({{ __('view.budget.product_discount', ['percent' => number_format($item->discount, 2)]) }})
                        @endif
                    </p>
                @endforeach

                <hr>
            @empty
                <p class="h6"><strong>{{ __('view.budget.no-sub-zones') }}</strong></p>
            @endforelse

            <h3><strong>{{ __('view.budget.total') }}: ${{ $budget->total }}</strong></h3>
        </div>

        <div class="mb-5">
            <x-button type="button"
                class="btn btn-primary"
                id="approval-button">
                {{ __('button.approve') }}
            </x-button>

            <x-button type="button"
                class="btn btn-danger"
                id="reject-button">
                {{ __('button.reject') }}
            </x-button>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $(() => {
            // Show confirmation window for appoval
            $('#approval-button').on('click', function() {
                Swal.fire({
                    title: "{{ __('budgets.alert.confirmation.approval.title') }}",
                    text: "{{ __('budgets.alert.confirmation.approval.body') }}",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#191b27',
                    cancelButtonColor: '#cf2637',
                    cancelButtonText: "{{ __('button.cancel') }}",
                    confirmButtonText: "{{ __('button.approve') }}",
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.approve();
                    }
                })
            });

            // Show confirmation window for reject
            $('#reject-button').on('click', function() {
                Swal.fire({
                    title: "{{ __('budgets.alert.confirmation.reject.title') }}",
                    text: "{{ __('budgets.alert.confirmation.reject.body') }}",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#191b27',
                    cancelButtonColor: '#cf2637',
                    cancelButtonText: "{{ __('button.cancel') }}",
                    confirmButtonText: "{{ __('button.reject') }}",
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.reject();
                    }
                })
            });
        })
    </script>
@endsection