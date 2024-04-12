<x-staff-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-timetable-generation')">
                            {{ __('Generate Timetable') }}
                        </x-danger-button>
                    </div>

                    <section id='calendar' class=""></section>
                </div>
            </div>
        </div>
    </div>
</x-staff-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            events: @json($timeslots),
            nowIndicator: true,
            slotMinTime: "08:00:00",
            slotMaxTime: "18:00:00",
            weekends: false //Could use hiddenDays here but chose not to.
        });
        calendar.render();
    });
</script>

<x-modal name="confirm-timetable-generation" focusable>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('WARNING! Generating the timetable will DELETE all information in the system and re-generate it! There is NO undo.') }}
    </h2>

    <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <a href="{{route('timetable.generate')}}"><x-primary-button>Generate Timetable</x-primary-button></a>
    </div>
</x-modal>
