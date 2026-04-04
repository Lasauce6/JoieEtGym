@extends('main')

@section('title', 'Planning')

@section('content')
    <div class="container-md mt-5">
        <h2 class="text-center">Planning des cours</h2>

        <div class="mt-4 text-center d-flex fs-6 container justify-content-center">
            <p class="city orange">Boussy-Saint-Antoine</p>
            <p class="city vert">Epinay-sous-Sénart</p>
            <p class="city jaune">Varennes Jarcy</p>
            <p class="city bleu">Aquagym</p>
        </div>
        <div class="text-muted text-center">
            <p>cliquez sur le cours pour accéder au lieu de la séance</p>
        </div>


        <div id="loader" class="text-center mt-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
        </div>

        <div id='calendar' style="display: none"></div>

        <div class="mt-5 text-center">
            <a href="{{ asset('assets/pdf/planning2024-2025.pdf') }}">Télécharger le planning</a>
        </div>


        <div class="row align-items-center justify-content-center mt-5">
            <p class="text-center lead"><strong>Les municipalités d'Epinay-sous-Sénart, Boussy-Saint-Antoine et Varennes-Jarcy, mettent des salles à notre disposition :</strong></p>
        </div>
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/La_Ferme_Boussy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">La Ferme<br>
                            Boussy-Saint-Antoine</h5>
                        <a href="https://maps.app.goo.gl/gGfTc2QzfftbktuA7" target="_blank">Chemin de la Ferme, 91800 Boussy-Saint-Antoine</a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Gymnase_Cosec_Boussy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Le gymnase COSEC<br>
                            Boussy-Saint-Antoine</h5>
                        <a href="https://maps.app.goo.gl/zEAnWVE337FJbAwN7" target="_blank">10 Rue des Glaises, 91800 Boussy-Saint-Antoine</a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Sénart_Club_Epinay.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">La salle du Sénart-Club<br>
                            Epinay-Sous-Sénart</h5>
                        <a href="https://maps.app.goo.gl/1JukNH1uT6JnREWQ7" target="_blank">40 bis Rue de la Croix Rochopt, 91860 Épinay-sous-Sénart</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Ancienne_Mairie_Epinay.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">L'ancienne Mairie<br>
                            Epinay-Sous-Sénart</h5>
                        <a href="https://maps.app.goo.gl/tKt7BRZucLZwiYz16" target="_blank">17 Rue de Boussy, 91860 Épinay-sous-Sénart</a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Mairie_Varennes.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Salle à la Mairie<br>
                            Varennes-Jarcy</h5>
                        <a href="https://maps.app.goo.gl/QBiZNktZTygX3X6N7" target="_blank">2 Pl. Aristide Briand, 94520 Varennes-Jarcy</a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Gymnase_Antonins_Boussy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Salle des Antonins<br>
                            Boussy-Saint-Antoine</h5>
                        <a href="https://maps.app.goo.gl/PQB1ScaQJqVS35KKA" target="_blank">Les Friches, 91800 Boussy-Saint-Antoine</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-5">
            <p class="text-center lead"><strong>Les séances de Gym Aquatique se déroulent :</strong></p>
        </div>
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{ asset('/assets/images/cards/Piscine_Senart_Boussy.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">La Piscine des Sénarts<br>
                            Boussy-Saint-Antoine</h5>
                        <a href="https://maps.app.goo.gl/ad63VqWYpqdfGrde9" target="_blank">1 Rue de Rochopt, 91800 Boussy-Saint-Antoine</a>
                    </div>
                </div>
            </div>
{{--            <div class="col d-flex justify-content-center align-items-center">--}}
{{--                <div class="card mt-2" style="width: 18rem;">--}}
{{--                    <img src="{{ asset('/assets/images/cards/Piscine_Brunoy.jpg') }}" class="card-img-top" alt="...">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title">La Piscine Yves Moreau<br>--}}
{{--                            Brunoy</h5>--}}
{{--                        <a href="https://maps.app.goo.gl/aaH3EFLU6PVHqzuYA" target="_blank">4 Av. de Soulins, 91800 Brunoy</a>--}}
{{--                        --}}{{--                        <p class="card-text text-muted">(En attente)</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            {{--            <div class="col d-flex justify-content-center align-items-center">--}}
            {{--                <div class="card mt-2" style="width: 18rem;">--}}
            {{--                    <img src="{{ asset('/assets/images/cards/Piscine_Epinay.jpg') }}" class="card-img-top" alt="...">--}}
            {{--                    <div class="card-body">--}}
            {{--                        <h5 class="card-title">La Piscine Pierre Bonningue<br>--}}
            {{--                            Epinay-Sous-Sénart</h5>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
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
                        <div class="modal-animator mb-3"></div>
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

    <script>
        window.initMap = function(latitude, longitude) {
            const mapDiv = document.getElementById('eventMap');
            mapDiv.innerHTML = '';

            if (!latitude || !longitude || isNaN(parseFloat(latitude))) {
                mapDiv.innerHTML = '<p class="text-center text-muted p-4">Adresse non trouvée.</p>';
                return;
            }

            const map = L.map('eventMap').setView([parseFloat(latitude), parseFloat(longitude)], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([parseFloat(latitude), parseFloat(longitude)]).addTo(map);
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

                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        initialDate: startOfWeek,
                        initialView: 'timeGridSixDays',
                        timeZone: 'Europe/Paris',
                        locale: 'fr',
                        headerToolbar: { start: '', center: '', end: '' },
                        views: {
                            timeGridSixDays: {
                                type: 'timeGrid',
                                duration: { days: 6 },
                                buttonText: '6 jours'
                            }
                        },
                        dayHeaderContent: function (arg) {
                            return arg.date.toLocaleString('fr', { weekday: 'long' });
                        },
                        slotLabelFormat: { hour: 'numeric', minute: '2-digit', omitZeroMinute: false, meridiem: 'short' },
                        slotMinTime: '08:30:00',
                        slotMaxTime: '22:30:00',
                        allDaySlot: false,
                        slotDuration: '00:15:00',
                        slotEventOverlap: false,
                        height: '1460px',
                        events: data,
                        eventClick: function (info) {
                            const event = info.event.extendedProps;
                            $('#eventModal .modal-title').text(info.event.title);
                            $('#eventModal .modal-horaires').text(
                                info.event.start.toLocaleString('fr', {weekday: 'long', hour: 'numeric', minute: '2-digit'}) +
                                ' - ' +
                                info.event.end.toLocaleString('fr', {hour: 'numeric', minute: '2-digit'})
                            );

                            let animatorHtml = '';
                            if (event.animators && event.animators.length > 0) {
                                animatorHtml = '<div class="animators-list mb-3"> <p>Animateurs :</p>';

                                event.animators.forEach(function(animator) {
                                    animatorHtml += `
                <div class="d-flex align-items-center mb-2">
                    <img src="${animator.photo}" alt="${animator.name}" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                    <div>
                        <strong class="small">${animator.name}</strong>
                        ${animator.bio ? `<p class="mb-0 text-muted" style="font-size: 0.75rem">${animator.bio}</p>` : ''}
                    </div>
                </div>
            `;
                                });

                                animatorHtml += '</div>';
                            }
                            $('#eventModal .modal-animator').html(animatorHtml);
                            $('#eventModal .modal-location').text("Lieu : " + event.location);
                            initMap(event.latitude, event.longitude);
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

