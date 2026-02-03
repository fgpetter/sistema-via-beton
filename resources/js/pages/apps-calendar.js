/*
Template Name: Tailwik - TailwindCSS Admin & Dashboard Template
Author: Themesdesign
Website: https://themesdesign.in/
Contact: themesdesign.in@gmail.com
File: Calendar js
*/

import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin, { Draggable } from '@fullcalendar/interaction';

class CalendarApp {
    constructor() {
        // Instance variables
        this.selectedEvent = null;
        this.newEventData = null;
        this.calendarObj = null; // Initialize calendarObj here
        
        // Use a single helper for consistent element retrieval
        this.getElement = (id) => document.getElementById(id);

        // Elements (Declared in constructor for wider scope if needed, but primarily used in init)
        this.calendarEl = this.getElement('calendar');
        this.checkbox = this.getElement('drop-remove');
        this.businessHoursCheckbox = this.getElement('businessCalendar');
        this.weekNumberCalendar = this.getElement('weekNumberCalendar');
        this.modalTitle = this.getElement('modal-title');
        this.formEvent = this.getElement('form-event');
        this.eventTitleInput = this.getElement('event-title');
        this.externalEventContainerEl = this.getElement('external-events');
        this.eventCategoryInput = this.getElement('event-category');
        this.deleteEventBtn = this.getElement('btn-delete-event');
        this.saveEventBtn = this.getElement('btn-save-event');
    }

    init() {
        // --- Helpers ---
        const initializeDraggable = () => {
            if (this.externalEventContainerEl) {
                new Draggable(this.externalEventContainerEl, {
                    itemSelector: '.external-event',
                    eventData: (eventEl) => ({
                        title: eventEl.innerText,
                        classNames: eventEl.getAttribute('data-class'),
                    }),
                });
            }
        };

        const getDefaultEvents = () => {
            const date = new Date();
            const d = date.getDate();
            const m = date.getMonth();
            const y = date.getFullYear();
            return [
                // ... (your default event objects remain unchanged) ...
                { id: 999, title: 'Repeating Event', start: new Date(y, m, d - 3, 16, 0), allDay: false, className: '!text-warning' },
                { id: 999, title: 'Repeating Event', start: new Date(y, m, d + 4, 16, 0), allDay: false, className: '!text-primary' },
                { title: 'All Day Event', start: new Date(y, m, 1), className: '!text-success' },
                { title: 'Long Event', start: new Date(y, m, d - 5), end: new Date(y, m, d - 2), className: '!text-info' },
                { title: 'Meeting', start: new Date(y, m, d, 10, 30), allDay: false, className: '!text-danger' },
                { title: 'Lunch', start: new Date(y, m, d, 12, 0), end: new Date(y, m, d, 14, 0), allDay: false, className: '!text-success' },
                { title: 'Birthday Party', start: new Date(y, m, d + 1, 19, 0), end: new Date(y, m, d + 1, 22, 30), allDay: false, className: '!text-info' },
                { title: 'Click for Google', start: new Date(y, m, 28), end: new Date(y, m, 29), url: 'http://google.com/', className: '!text-primary' }
            ];
        };

        const addNewEvent = (info) => {
            // FIX: Use the instance variable for classList and ensure it exists
            this.formEvent?.classList?.remove('was-validated'); 
            this.formEvent?.reset(); // Use optional chaining to safely call reset
            this.selectedEvent = null;
            this.modalTitle.innerText = 'Add Event';
            this.newEventData = info;
        };

        const getInitialView = () => {
            const w = window.innerWidth;
            if (w >= 768 && w < 1200) return 'timeGridWeek';
            else if (w <= 768) return 'listMonth';
            return 'dayGridMonth';
        };

        const getBusinessHours = () => (this.businessHoursCheckbox?.checked ? {
            daysOfWeek: [1, 2, 3, 4, 5],
            startTime: '10:00',
            endTime: '18:00'
        } : []);

        const weekNumber = () => this.weekNumberCalendar?.checked;

        // --- Event Listeners Fix ---

        // FIX: Check if elements exist before adding listeners
        this.businessHoursCheckbox?.addEventListener('change', () =>
            this.calendarObj.setOption('businessHours', getBusinessHours())
        );
        this.weekNumberCalendar?.addEventListener('change', () =>
            this.calendarObj.setOption('weekNumbers', weekNumber())
        );

        // FIX: The original code was using 'self.formEvent?' and 'self.deleteEventBtn?'
        // which often resolves to 'window.formEvent' and fails.
        // We now use the instance variables (this.formEvent, this.deleteEventBtn).
        this.formEvent?.addEventListener('submit', (ev) => {
            ev.preventDefault();
            const updatedTitle = this.eventTitleInput.value;
            const updatedCategory = this.eventCategoryInput.value;
            if (!updatedTitle) return;

            if (this.selectedEvent) {
                this.selectedEvent.setProp('title', updatedTitle);
                this.selectedEvent.setProp('classNames', [updatedCategory]);
            } else {
                this.calendarObj.addEvent({
                    title: updatedTitle,
                    start: this.newEventData.date,
                    allDay: this.newEventData.allDay,
                    className: updatedCategory,
                });
            }
            // Assuming HSOverlay is globally available
            HSOverlay.close('#event-modal');
        });

        this.deleteEventBtn?.addEventListener('click', () => {
            if (this.selectedEvent) {
                this.selectedEvent.remove();
                this.selectedEvent = null;
                HSOverlay.close('#event-modal');
            }
        });
        
        // --- Calendar Initialization ---
        
        if (!this.calendarEl) {
            console.error("FullCalendar initialization failed: Element with ID 'calendar' not found.");
            return;
        }

        this.calendarObj = new Calendar(this.calendarEl, {
            timeZone: 'local',
            editable: true,
            droppable: true,
            selectable: true,
            weekNumbers: weekNumber(),
            initialView: getInitialView(),
            themeSystem: 'tailwindcss',
            plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
            headerToolbar: { left: 'prev,next,today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth' },
            drop: (info) => this.checkbox?.checked && info.draggedEl.parentNode.removeChild(info.draggedEl),
            businessHours: getBusinessHours(),
            windowResize: (arg) => arg.view.calendar.changeView(getInitialView()),
            eventClick: (info) => {
                HSOverlay.open('#event-modal');
                this.formEvent?.reset();
                this.eventTitleInput.value = '';
                this.selectedEvent = info.event;
                this.eventTitleInput.value = this.selectedEvent.title;
                // FullCalendar classNames is an array, ensure we access the first element or handle conversion
                this.eventCategoryInput.value = this.selectedEvent.classNames[0]; 
                this.deleteEventBtn?.classList.remove('hidden');
                this.newEventData = null;
                this.saveEventBtn.innerText = 'Edit Event';
            },
            dateClick: (info) => {
                HSOverlay.open('#event-modal');
                addNewEvent(info);
                this.deleteEventBtn?.classList.add('hidden');
            },
            events: getDefaultEvents(),
        });

        // Render and init external drag
        this.calendarObj.render();
        initializeDraggable();
    }
}

// --- DOMContentLoaded Fix ---
// FIX: Removed the unnecessary 20ms setTimeout wrapper.
document.addEventListener('DOMContentLoaded', function () {
    new CalendarApp().init();
});