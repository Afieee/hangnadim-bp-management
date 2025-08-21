        // Initialize date picker
        flatpickr("#datePicker", {
            dateFormat: "F Y",
            defaultDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                // Handle date change (you would typically reload data here)
                console.log("Selected date:", dateStr);
            }
        });
        
        // Toggle date picker visibility
        $("#datePickerBtn").click(function() {
            $("#datePicker").click();
        });
        
        // Initialize calendar (FullCalendar)
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    {
                        title: 'Building A Inspection',
                        start: new Date(),
                        end: new Date(),
                        backgroundColor: '#3B82F6',
                        borderColor: '#3B82F6'
                    },
                    {
                        title: 'Building B Inspection',
                        start: new Date(new Date().setDate(new Date().getDate() + 2)),
                        end: new Date(new Date().setDate(new Date().getDate() + 2)),
                        backgroundColor: '#10B981',
                        borderColor: '#10B981'
                    },
                    {
                        title: 'Building C Inspection',
                        start: new Date(new Date().setDate(new Date().getDate() + 5)),
                        end: new Date(new Date().setDate(new Date().getDate() + 5)),
                        backgroundColor: '#F59E0B',
                        borderColor: '#F59E0B'
                    }
                ],
                eventClick: function(info) {
                    // Handle event click (could open a modal with details)
                    alert('Event: ' + info.event.title);
                    info.el.style.borderColor = 'red';
                }
            });
            calendar.render();
        });
