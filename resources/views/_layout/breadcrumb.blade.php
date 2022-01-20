@unless($breadcrumbs->isEmpty())
    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
        <ul class="breadcrumb pt-0">
            @foreach ($breadcrumbs as $breadcrumb)

                @if (!is_null($breadcrumb->url) && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif

            @endforeach
        </ul>
    </nav>
@endunless
