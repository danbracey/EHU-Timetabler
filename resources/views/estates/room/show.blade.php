<x-staff-layout>
    <x-slot name="header">
        {{ $Room->id }}
        <div>
            <a href="{{route('room.edit', [$Building->id, $Room->id])}}"><x-secondary-button>Edit Room</x-secondary-button></a>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-room-deletion')">
                {{ __('Delete Room') }}
            </x-danger-button>
        </div>
    </x-slot>

    <section class="flex">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 basis-1/2">
            <h2 class="text-3xl">Timetabled Sessions:</h2>
            <table class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Module</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Lecture</th>
                        <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($Room->timeslots as $Timeslot)
                    <tr>
                        <td>{{\App\Helpers\TimeslotFunctions::parseDay($Timeslot->day_of_week)}}</td>
                        <td>{{$Timeslot->module_id}}</td>
                        <td>{{$Timeslot->start_time}}</td>
                        <td>{{$Timeslot->end_time}}</td>
                        <td>{{$Timeslot->is_lecture ? '✅' : '❌'}}</td>
                        <td>
                            <form method="POST" action="{{route('module.timeslot.destroy', [$Timeslot->module_id, $Timeslot->id])}}">
                                @csrf @method("DELETE")
                                <button type="submit" class="text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <section id='calendar' class=""></section>
        </div>
    </section>
</x-staff-layout>

<x-modal name="confirm-room-deletion" focusable>
    <form method="post" action="{{ route('room.destroy', [$Building->id, $Room->id]) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete this room?') }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Room') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
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
