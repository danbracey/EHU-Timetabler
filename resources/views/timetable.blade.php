<x-student-layout>
    <x-slot name="header">
        Welcome {{$Student->first_name}} {{$Student->last_name}}!
    </x-slot>
    <p class="font-copse max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">Your degree: {{$Student->degree->friendly_name}} ({{$Student->degree->id}})</p>

    <main class="flex-col">
        <section class="">
            <aside>
                Today
                <span>0</span> Classes
                <p>Next Class</p>
                <!-- Insert component -->
            </aside>
            <article>
                <!-- Today's classes show here -->
            </article>
        </section>

        <div id='calendar'></div>
    </main>
</x-student-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            events: @json($events),
            nowIndicator: true,
            slotMinTime: "08:00:00",
            slotMaxTime: "18:00:00",
            weekends: false //Could use hiddenDays here but chose not to.
        });
        calendar.render();
    });
</script>
