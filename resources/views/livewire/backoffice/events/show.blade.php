@section('title', __('calendar.title'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/vendor/fullcalendar.min.css') }}">
@endsection

<div id='calendar'></div>

@section('scripts')
    <script src="{{ asset('js/vendor/fullcalendar/main.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // console.log(document.querySelector('.datepicker'));
            Livewire.on('showBootstrapModal', e => {
                document.getElementById('laravel-livewire-modals').addEventListener('shown.bs.modal', function (event) {
                    new DateRangePicker(document.querySelector('.datepicker'), {
                        // options here
                    }, function (start, end) {
                        // callback
                        alert(start.format() + " - " + end.format());
                    })
                })
            })

            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                dateClick: function(info) {
                    // Swal.fire({
                    //     title: '¿Quieres agregar un evento para esta fecha?',
                    //     showCancelButton: true,
                    //     confirmButtonText: 'Sí',
                    //     cancelButtonText: 'No',
                    //     confirmButtonColor: '#191b27',
                    //     cancelButtonColor: '#cf2637',
                    // }).then((result) => {
                    //     if (result.isConfirmed) {
                    //         Livewire.emit('showModal', 'backoffice.events.add', info.dateStr);
                    //     }
                    // })
                    // console.log(info.date.getTime());
                    // console.log(new Date().setHours(0,0,0,0));
                    // console.log(info.date.getTime() >= new Date().setHours(0,0,0,0));
                    if (info.date.getTime() >= new Date().setHours(0,0,0,0)) {
                        Livewire.emit('showModal', 'backoffice.events.add', info.dateStr);
                    }
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
