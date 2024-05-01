@extends('main')

@section('title', 'Planning')

@section('content')
    <div class="container-md mt-5">
        <h2 class="text-center">Planning des cours</h2>
        <p class="mt-4 text-muted text-center fs-6">
            (Orange : Boussy-Saint-Antoine, Vert : Epinay-sous-Sénart, Jaune : Varennes Jarcy, Bleu : Aquagym)
        </p>
        <div id="loader" class="text-center mt-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
        </div>

        <div id='calendar' style="display: none"></div>

        <div class="mt-5 text-center">
            <a href="{{ asset('assets/pdf/PLANNING-2023-24.pdf') }}">Télécharger le planning</a>
        </div>

        <!-- Fenêtre modale pour afficher les détails de l'événement -->
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="modal-horaires text-muted"></p>
                        <p class="modal-description"></p>
                        <p class="modal-location"></p>
                        <div id="eventMap" style="width: 100%; height: 300px;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>
        window.initMap = function(latitude, longitude) {
            const eventMap = new google.maps.Map(document.getElementById('eventMap'), {
                center: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
                zoom: 14,
                streetViewControl: false,
                disableDefaultUI: true,
            });

            const marker = new google.maps.Marker({
                position: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
                map: eventMap
            });
        };

        document.addEventListener('DOMContentLoaded', function() {
            const currentDate = new Date();
            const startOfWeek = new Date(currentDate.setDate(currentDate.getDate() - currentDate.getDay() + (currentDate.getDay() === 0 ? -6 : 1)));

            const calendarEl = document.getElementById('calendar');
            const loaderEl = document.getElementById('loader');

            fetch('/load-planning')
                .then(response => response.json())
                .then(data => {
                    loaderEl.style.display = 'none';
                    calendarEl.style.display = '';

                    const googleMapsScript = document.createElement('script');
                    googleMapsScript.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyASp72IjHskwrcCWyhdFsixQxTICadnwLE&libraries=places&callback=initMap`;
                    googleMapsScript.defer = true;
                    document.head.appendChild(googleMapsScript);

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialDate: startOfWeek,
                    initialView: 'timeGridSixDays',
                    timeZone: 'Europe/Paris',
                    locale: 'fr',
                    headerToolbar: {
                        start: '',
                        center: '',
                        end: ''
                    },
                    views: {
                        timeGridSixDays: {
                            type: 'timeGrid',
                            duration: {days: 6},
                            buttonText: '6 jours'
                        }
                    },
                    dayHeaderContent: function (arg) {
                        return arg.date.toLocaleString('fr', {weekday: 'long'});
                    },
                    slotLabelFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        omitZeroMinute: false,
                        meridiem: 'short'
                    },
                    slotMinTime: '08:30:00',
                    slotMaxTime: '22:30:00',
                    allDaySlot: false,
                    slotDuration: '00:15:00',
                    slotEventOverlap: false,
                    height: '1460px',
                    events: data,
                    eventClick: function (info) {
                        $('#eventModal .modal-title').text(info.event.title);
                        $('#eventModal .modal-horaires').text(info.event.start.toLocaleString('fr-FR', { timeZone: 'GMT', weekday: 'long', hour: 'numeric', minute: '2-digit' })
                            + ' - '
                            + info.event.end.toLocaleString('fr-FR', { timeZone: 'GMT', hour: 'numeric', minute: '2-digit' }));
                        $('#eventModal .modal-description').text("Animateur : " + info.event.extendedProps.description);
                        $('#eventModal .modal-location').text("Lieu : " + info.event.extendedProps.location);
                        initMap(info.event.extendedProps.latitude, info.event.extendedProps.longitude);
                        $('#eventModal').modal('show');
                    }
                });

                calendar.render();
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des données', error);
                    loaderEl.style.display = 'none';
                });
        });
    </script>
@endsection

