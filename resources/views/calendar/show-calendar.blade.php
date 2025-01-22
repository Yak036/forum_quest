<div class="bg-gray-100">
    <!-- Hero Section -->
    <div class="relative bg-yellow-600 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-yellow-600 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block">Mis Rutinas</span>
                            <span class="block text-yellow-300">RockstarFitness</span>
                        </h1>
                        <p class="mt-3 text-base text-yellow-100 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Administra tus rutinas de entrenamiento y mantén un registro de tu progreso.
                        </p>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" 
                src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" 
                alt="Rutinas de ejercicio">
        </div>
    </div>
    <div class="p-6 text-gray-900">
        @if($message)
            <div class="mb-4 p-4 rounded {{ $messageType === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $message }}
            </div>
        @endif
        @if(auth()->user()->role === 'trainer' || auth()->user()->role === 'admin')
            <div class="mb-6 flex justify-start">
                <a href="{{ route('practice') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Mis clases
                </a>
            </div>
        @endif
        <div id="calendar" wire:ignore class="bg-white p-4 rounded-lg shadow w-4/5 flex justify-center m-auto"></div>

        @if($showModal && $selectedPractice)
            <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        {{ $selectedPractice->name }}
                                    </h3>
                                    <div class="mt-4 space-y-3">
                                        <p class="text-sm text-gray-500">{{ $selectedPractice->description }}</p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Instructor:</span> 
                                            {{ $selectedPractice->trainer->name }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Fecha y Hora:</span>
                                            {{ Carbon\Carbon::parse($selectedPractice->date_time)->format('d/m/Y H:i') }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Duración:</span>
                                            {{ $selectedPractice->duration }} minutos
                                        </p>
                                        <p class="text-sm {{ $selectedPractice->reservations->count() >= $selectedPractice->capacity ? 'text-red-600' : 'text-green-600' }}">
                                            <span class="font-medium">Cupos disponibles:</span>
                                            {{ $selectedPractice->capacity - $selectedPractice->reservations->count() }} de {{ $selectedPractice->capacity }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            @php
                                $hasReservation = $selectedPractice->reservations->contains('user_id', auth()->id());
                            @endphp

                            @if($hasReservation)
                                <button wire:click="cancelReservation({{ $selectedPractice->id }})" type="button"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancelar Reserva
                                </button>
                            @else
                                <button wire:click="reservePractice({{ $selectedPractice->id }})" type="button"
                                        @if($selectedPractice->reservations->count() >= $selectedPractice->capacity) disabled @endif
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 {{ $selectedPractice->reservations->count() >= $selectedPractice->capacity ? 'bg-gray-400 cursor-not-allowed' : 'bg-yellow-600 hover:bg-yellow-700' }} text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Reservar
                                </button>
                            @endif
                            <button wire:click="closeModal" type="button"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

    @push('scripts')
    <script>
        // Esperamos a que el DOM y los scripts estén completamente cargados
        window.addEventListener('load', function() {
            if (typeof Calendar === 'undefined') {
                console.error('Calendar no está definido. Verifica que FullCalendar esté cargado correctamente.');
                return;
            }

            Livewire.on('showAlert', params => {
                Swal.fire({
                    icon: params.type,
                    title: params.title,
                    text: params.message, 
                    confirmButtonColor: '#D97706'
                }).then(() => {
                    location.reload();
                });
            });

            var calendarEl = document.getElementById('calendar');
            var calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                locale: esLocale,
                height: '60rem',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                dayMaxEvents: 1,
                moreLinkText: 'más',
                moreLinkClick: 'popover',
                views: {
                    dayGrid: {
                        moreLinkClassNames: 'text-blue-600 hover:text-blue-800 font-medium'
                    }
                },
                events: @json($practices),
                eventContent: function(arg) {
                    let timeText = arg.timeText;
                    let title = arg.event.title;
                    let backgroundColor = arg.event.backgroundColor;
                    let borderColor = arg.event.borderColor;
                    let textColor = arg.event.textColor;
                    return {
                        html: `
                            <div class="fc-event-main-frame" style="background-color: ${backgroundColor}; border-color: ${borderColor}; color: ${textColor}">
                                <div class="fc-event-time">${timeText}</div>
                                <div class="fc-event-title-container">
                                    <div class="fc-event-title">${title}</div>
                                </div>
                            </div>
                        `
                    };
                },
                eventClick: function(info) {
                    @this.showPracticeDetails(info.event.id);
                },
                eventDidMount: function(info) {
                    const props = info.event.extendedProps;
                    tippy(info.el, {
                        content: `
                            <div class="p-2">
                                <div class="font-bold mb-1">${info.event.title}</div>
                                <div>Instructor: ${props.trainer}</div>
                                <div>Cupos: ${props.availableSpots} de ${props.capacity}</div>
                                ${props.reserved ? '<div class="text-yellow-500 font-bold">¡Reservado!</div>' : ''}
                            </div>
                        `,
                        allowHTML: true,
                        theme: 'light',
                        placement: 'top',
                        arrow: true
                    });
                },
                displayEventTime: true,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                }
            });
            calendar.render();

            Livewire.on('practicesUpdated', events => {
                calendar.removeAllEvents();
                calendar.addEventSource(events);
            });
        });
    </script>
    @endpush