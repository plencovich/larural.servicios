@section('title', __('calendar.title'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/vendor/fullcalendar.min.css') }}">
@endsection

<div id='calendar'></div>

@section('scripts')
    <script src="{{ asset('js/vendor/fullcalendar/main.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                allDayText: '{{ __("calendar.text.all-day") }}',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    center: 'dayGridMonth,timeGridWeek'
                },
                eventSources: [{
                    events: @json($events),
                }]
            });

            calendar.setOption('locale', '{{ app()->getLocale() }}');
            calendar.setOption('buttonText', {
                today: '{{ __("calendar.text.today") }}',
                month: '{{ __("calendar.text.month") }}',
                week: '{{ __("calendar.text.week") }}',
                day: '{{ __("calendar.text.day") }}',
                list: '{{ __("calendar.text.list") }}'
            });

            calendar.render();
        });
    </script>
@endsection
