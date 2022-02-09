@section('title', __('calendar.title'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/vendor/fullcalendar.min.css') }}">
    <style>
        .fc-daygrid-day {
            cursor: pointer;
        }
    </style>
@endsection

<div id='calendar'></div>

@section('scripts')
    <script src="{{ asset('js/vendor/fullcalendar/main.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                dateClick: function(info) {
                    if (info.date.getTime() >= new Date().setHours(0,0,0,0)) {
                        // Show the event creation only if the selected date is greater than or equal to today
                        Livewire.emit('showModal', 'backoffice.events.add', info.dateStr);
                    }

                    // Get selected date to set as the start date of the range
                    let selectedDate = `${globals.formattedDate(info.date).day}/${globals.formattedDate(info.date).month}/${globals.formattedDate(info.date).year}`;

                    // Initialize date range picker on modal
                    Livewire.on('showBootstrapModal', e => {
                        // Select modal and handle shown event
                        document.getElementById('laravel-livewire-modals').addEventListener('shown.bs.modal', function (event) {
                            // Focus event name
                            $('input[autofocus=autofocus]').focus();

                            // Initialize picker
                            globals.initDatePicker();
                        })
                    })
                },
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
                today: "{{ __('calendar.text.today') }}",
                month: "{{ __('calendar.text.month') }}",
                week: "{{ __('calendar.text.week') }}",
                day: "{{ __('calendar.text.day') }}",
                list: "{{ __('calendar.text.list') }}"
            });

            calendar.render();

            // Dynamically add events
            Livewire.on('addEvent', event => {
                calendar.addEvent({
                    title: event.title,
                    start: event.start,
                    end: event.end,
                    url: event.url
                });
            });
        });
    </script>
@endsection
