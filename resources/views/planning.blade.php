@extends('main')

@section('title', 'Joie et Gym | Planning')

@section('content')
    <div class="container-md mt-5">
        <h2 class="text-center">Planning des cours</h2>
{{--        <div class="card mb-5">--}}
{{--            <table class="table table-striped-columns">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th class="col">Jour</th>--}}
{{--                    <th class="col">Lieu</th>--}}
{{--                    <th class="col">Heure</th>--}}
{{--                    <th class="col">Cours</th>--}}
{{--                    <th class="col">Enseignant</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                <!-- Lundi -->--}}
{{--                <tr>--}}
{{--                    <th rowspan="8">Lundi</th>--}}
{{--                    <td rowspan="4">EPINAY Sénart-Club</td>--}}
{{--                    <td>09h00-10h00</td>--}}
{{--                    <td rowspan="2">Souplesse-Etirements</td>--}}
{{--                    <td rowspan="2">Nathalie</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>10h15-11h15</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>18h00-19h00</td>--}}
{{--                    <td>Gym Entretien</td>--}}
{{--                    <td rowspan="2">Joelle</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>19h10-20h10</td>--}}
{{--                    <td>Taille Abdo-Fessiers</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>BOUSSY Piscine Sénarts</td>--}}
{{--                    <td>11h15-12h00</td>--}}
{{--                    <td>Aquagym</td>--}}
{{--                    <td></td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td rowspan="3">BOUSSY La Ferme--}}
{{--                    <td>09h00-10h00</td>--}}
{{--                    <td>Gym Tonic</td>--}}
{{--                    <td rowspan="2">Vincent</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>10h00-11h00</td>--}}
{{--                    <td>Gym Musculaire</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>14h00-15h00</td>--}}
{{--                    <td>Body Zen</td>--}}
{{--                    <td>Joelle</td>--}}
{{--                </tr>--}}
{{--                <!--Mardi-->--}}
{{--                <tr>--}}
{{--                    <th rowspan="11">Mardi</th>--}}
{{--                    <td rowspan="2">EPINAY Sénart-Club</td>--}}
{{--                    <td>18h15-19h15</td>--}}
{{--                    <td>Gym Form</td>--}}
{{--                    <td>Rose-Marie</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>19h20-20h20</td>--}}
{{--                    <td>Step</td>--}}
{{--                    <td>Fabrice</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>EPINAY Piscine Bonningue</td>--}}
{{--                    <td>12h15-13h00</td>--}}
{{--                    <td>Aquagym</td>--}}
{{--                    <td></td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td rowspan="5">BOUSSY La Ferme</td>--}}
{{--                    <td>10h00-10h45</td>--}}
{{--                    <td rowspan="2">Gym Entretien</td>--}}
{{--                    <td rowspan="3">Joelle</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>10h45-11h30</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>11h30-12h30</td>--}}
{{--                    <td>Stretching Postural</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>14h00-17h15</td>--}}
{{--                    <td rowspan="2">Yoga</td>--}}
{{--                    <td rowspan="2">Mary</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>15h45-17h15</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>BOUSSY Cosec</td>--}}
{{--                    <td>20h45-21h45</td>--}}
{{--                    <td>Dance Move/Abdo-Fessiers</td>--}}
{{--                    <td>Fabrice</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td rowspan="2">VARENNES JARCY</td>--}}
{{--                    <td>19h00-20h00</td>--}}
{{--                    <td>Gym Entretien</td>--}}
{{--                    <td rowspan="2">Joelle</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>20h05-21h05</td>--}}
{{--                    <td>Stretching Postural</td>--}}
{{--                </tr>--}}
{{--                <!--Mercredi-->--}}
{{--                <tr>--}}
{{--                    <th rowspan="6">Mercredi</th>--}}
{{--                    <td rowspan="4">EPINAY Sénart-Club</td>--}}
{{--                    <td>09h00-10h00</td>--}}
{{--                    <td>Gym Douce</td>--}}
{{--                    <td>Rose-Marie</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>11h30-12h30</td>--}}
{{--                    <td>Stretching Postural</td>--}}
{{--                    <td>Joelle</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>19h30-20h30</td>--}}
{{--                    <td>Dance Move</td>--}}
{{--                    <td rowspan="2">Fabrice</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>20h30-21h30</td>--}}
{{--                    <td>Abdo-Fessiers Etirements</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>BOUSSY Piscine Sénarts</td>--}}
{{--                    <td>11h15-12h00</td>--}}
{{--                    <td>Aquagym</td>--}}
{{--                    <td></td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>VARENNES JARCY</td>--}}
{{--                    <td>09h15-10h15</td>--}}
{{--                    <td>Gym Musculaire</td>--}}
{{--                    <td>Vincent</td>--}}
{{--                </tr>--}}
{{--                <!--Jeudi-->--}}
{{--                <tr>--}}
{{--                    <th rowspan="8">Jeudi</th>--}}
{{--                    <td rowspan="4">EPINAY Sénart-Club</td>--}}
{{--                    <td>09h00-10h00</td>--}}
{{--                    <td>Gym Form</td>--}}
{{--                    <td>Rose-Marie</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>10h15-11h15</td>--}}
{{--                    <td>Body Zen</td>--}}
{{--                    <td>Nathalie</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>11h30-12h30</td>--}}
{{--                    <td>Streching Postural</td>--}}
{{--                    <td>Luckie</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>18h00-19h00</td>--}}
{{--                    <td>Bodysculp-Musculation</td>--}}
{{--                    <td>Rose-Marie</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>EPINAY Piscine Bonningue</td>--}}
{{--                    <td>12h30-13h15</td>--}}
{{--                    <td>Aquagym</td>--}}
{{--                    <td></td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>BOUSSY Lamartine</td>--}}
{{--                    <td>18h30-19h30</td>--}}
{{--                    <td>Gym Détente Méthodes Pilates</td>--}}
{{--                    <td>Nathalie</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>BOUSSY Cosec</td>--}}
{{--                    <td>20h45-21h45</td>--}}
{{--                    <td>Dance Move</td>--}}
{{--                    <td rowspan="2">Fabrice</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>VARENNES JARCY</td>--}}
{{--                    <td>19h20-20h20</td>--}}
{{--                    <td>Gym Entretien</td>--}}
{{--                </tr>--}}
{{--                <!--Vendredi-->--}}
{{--                <tr>--}}
{{--                    <th rowspan="4">Vendredi</th>--}}
{{--                    <td>EPINAY Sénart-Club</td>--}}
{{--                    <td>09h30-10h30</td>--}}
{{--                    <td>Gym Détente Méthode Pilates</td>--}}
{{--                    <td>Nathalie</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td rowspan="2">BOUSSY La Ferme</td>--}}
{{--                    <td>09h15-10h15</td>--}}
{{--                    <td>Renforcement Musculaire</td>--}}
{{--                    <td>Vincent</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>13h45-14h45</td>--}}
{{--                    <td>Gym Douce</td>--}}
{{--                    <td>Joelle</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>BOUSSY Piscine Sénarts</td>--}}
{{--                    <td>11h15-12h00</td>--}}
{{--                    <td>Aquagym</td>--}}
{{--                    <td></td>--}}
{{--                </tr>--}}
{{--                <!--Samedi-->--}}
{{--                <tr>--}}
{{--                    <th rowspan="4">Samedi</th>--}}
{{--                    <td>EPINAY Sénart-Club</td>--}}
{{--                    <td>09h30-10h30</td>--}}
{{--                    <td>Yoga</td>--}}
{{--                    <td>Virginie</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td rowspan="3">BOUSSY La Ferme</td>--}}
{{--                    <td>09h00-10h00</td>--}}
{{--                    <td>Gym Tonic</td>--}}
{{--                    <td rowspan="3">Joelle</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>10h00-11h00</td>--}}
{{--                    <td>Etirements</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>11h00-12h00</td>--}}
{{--                    <td>Streching Postural</td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
        <div id="loader" class="text-center mt-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
        </div>

        <div id='calendar' style="display: none"></div>
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
                        $('#eventModal .modal-horaires').text(info.event.start.toLocaleString('fr', {weekday: 'long', hour: 'numeric', minute: '2-digit'}) + ' - ' + info.event.end.toLocaleString('fr', {hour: 'numeric', minute: '2-digit'}));
                        $('#eventModal .modal-description').text("Professeur : " + info.event.extendedProps.description);
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

