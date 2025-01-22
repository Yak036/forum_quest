import './bootstrap';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

// Importar FullCalendar core antes de los plugins
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import tippy from 'tippy.js';

// Configuración de localización en español
const esLocale = {
    code: 'es',
    week: {
        dow: 1, // Lunes es el primer día de la semana
        doy: 4  // La semana que contiene Jan 4th es la primera semana del año
    },
    buttonText: {
        prev: 'Anterior',
        next: 'Siguiente',
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'Día',
        list: 'Lista'
    },
    weekText: 'Sm',
    allDayText: 'Todo el día',
    moreLinkText: 'más',
    noEventsText: 'No hay eventos para mostrar',
    dayHeaderFormat: { weekday: 'long' },
    eventTimeFormat: {
        hour: '2-digit',
        minute: '2-digit',
        meridiem: false,
        hour12: false
    },
    slotLabelFormat: {
        hour: '2-digit',
        minute: '2-digit',
        meridiem: false,
        hour12: false
    }
};

window.Alpine = Alpine;
window.Swal = Swal;
window.Calendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
window.timeGridPlugin = timeGridPlugin;
window.interactionPlugin = interactionPlugin;
window.tippy = tippy;
window.esLocale = esLocale;

Alpine.start();