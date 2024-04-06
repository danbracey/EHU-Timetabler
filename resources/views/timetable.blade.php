<x-student-layout>
    <x-slot name="header">
        Welcome {{$Student->first_name}} {{$Student->last_name}}!
    </x-slot>
    <p class="font-copse max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">Your degree: {{$Student->degree->friendly_name}} ({{$Student->degree->id}})</p>

    <main class="flex flex-col md:flex-row gap-8 justify-center">
        <section class="basis-1/4">
            <aside>
                Today
                <div class="flex flex-col justify-items-center">
                    <span>{{count($classesToday)}}</span><span>Classes</span>
                </div>
                <p>Next Class</p>
                <!-- Insert component -->
            </aside>
            <article>
                <h2>Your classes today:</h2>
                @foreach ($classesToday as $timeslot)
                    <x-timetabled-class :timeslot="$timeslot"></x-timetabled-class>
                @endforeach
            </article>
        </section>

        <section id='calendar' class="basis-1/2"></section>
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
