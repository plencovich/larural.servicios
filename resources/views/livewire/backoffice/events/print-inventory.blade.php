<div>
    <h1>{{ $event->name }} {{ $event->event_from->format('d/m/Y') }} - {{ $event->event_to->format('d/m/Y') }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('budgets.product.product') }}</th>
                <th>{{ __('budgets.product.quantity') }}</th>
            </tr>
        </thead>

        <tbody>
            @if (filled($items))
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->total_products }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>

        <tfoot>
            <tr>
                <td class="fw-bold h4">{{ __('globals.total') }}</td>
                <td class="fw-bold h4">{{ $items->sum->total_products }}</td>
            </tr>
        </tfoot>
    </table>

    <button type="button" class="btn btn-primary d-print-none" onclick="window.print();">{{ __("globals.print") }}</button>
</div>
