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
                eventClick: function(info) {
                    var eventObj = info.event;

                    if (eventObj.url) {
                        window.open(eventObj.url);

                        // prevents browser from following link in current tab.
                        info.jsEvent.preventDefault();
                    } else {
                        alert('Clicked ' + eventObj.title);
                    }
                },
                allDayText: '{{ __('calendar.text.all-day') }}',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    center: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                eventSources: [{
                    events: @json($events),
                }],
                views: {
                    timeGridDay: {
                        type: 'timeGrid',
                        duration: {
                            days: 1
                        },
                        buttonText: 'Day'
                    }
                }
            });

            calendar.setOption('locale', '{{ app()->getLocale() }}');
            calendar.setOption('buttonText', {
                today: '{{ __('calendar.text.today') }}',
                month: '{{ __('calendar.text.month') }}',
                week: '{{ __('calendar.text.week') }}',
                day: '{{ __('calendar.text.day') }}',
                list: '{{ __('calendar.text.list') }}'
            });

            calendar.render();
        });
    </script>
@endsection
