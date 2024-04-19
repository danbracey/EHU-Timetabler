<x-student-layout>
    <x-slot name="header">
        Welcome {{$Student->first_name}} {{$Student->last_name}}!
    </x-slot>
    <p class="font-copse max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">Your degree: {{$Student->degree->friendly_name}} ({{$Student->degree->code}}, finishing in {{$Student->degree->graduation_year}})</p>

    <main class="flex flex-col md:flex-row gap-8 justify-center px-10 my-6">
        <section class="basis-1/2">
            <aside class="grid grid-flow-row-dense grid-cols-4 items-center border border-solid border-black mt-16 ">
                Today:
                <div class="flex flex-col justify-items-center">
                    <span class="text-5xl font-extrabold">{{count($classesToday)}}</span><span>Class{{count($classesToday) > 1 ? 'es' : ''}}</span>
                </div>
                <div class="col-span-2">
                    <h3>Next class on {{\App\Helpers\TimeslotFunctions::parseDay(\App\Helpers\TimeslotFunctions::getNextTimeslot($Student)->day_of_week ?? 0)}}:</h3>
                    <x-timetabled-class :timeslot="\App\Helpers\TimeslotFunctions::getNextTimeslot($Student)"></x-timetabled-class>
                </div>
            </aside>
            <article class="border border-solid border-black my-5 pb-5 px-5">
                <h2 class="font-copse text-center text-xl py-2">Your classes today:</h2>
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
