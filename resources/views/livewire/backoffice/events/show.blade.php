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
                            new DateRangePicker(document.querySelector('.datepicker'), {
                                // "autoApply": true,
                                "minDate": "{{ now()->format('d/m/Y') }}",
                                "startDate": selectedDate,
                                "endDate": selectedDate,
                                "locale": {
                                    "format": "DD/MM/YYYY",
                                    "separator": " - ",
                                    "applyLabel": "{{ __('date.apply') }}",
                                    "cancelLabel": "{{ __('date.cancel') }}",
                                    "fromLabel": "{{ __('date.from') }}",
                                    "toLabel": "{{ __('date.to') }}",
                                    "customRangeLabel": "{{ __('date.custom') }}",
                                    "weekLabel": "{{ __('date.week-letter') }}",
                                    "daysOfWeek": [
                                        "{{ __('date.su') }}",
                                        "{{ __('date.mo') }}",
                                        "{{ __('date.tu') }}",
                                        "{{ __('date.we') }}",
                                        "{{ __('date.th') }}",
                                        "{{ __('date.fr') }}",
                                        "{{ __('date.sa') }}"
                                    ],
                                    "monthNames": [
                                        "{{ __('date.january') }}",
                                        "{{ __('date.february') }}",
                                        "{{ __('date.march') }}",
                                        "{{ __('date.april') }}",
                                        "{{ __('date.may') }}",
                                        "{{ __('date.june') }}",
                                        "{{ __('date.july') }}",
                                        "{{ __('date.august') }}",
                                        "{{ __('date.september') }}",
                                        "{{ __('date.october') }}",
                                        "{{ __('date.november') }}",
                                        "{{ __('date.december') }}"
                                    ],
                                    "firstDay": 1
                                },
                            }, function (start, end) {
                                // Set date range to livewire
                                Livewire.emit('changeDateRange', start, `${globals.formattedDate(end._d).year}-${globals.formattedDate(end._d).month}-${globals.formattedDate(end._d).day}`);
                            })
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
