<x-staff-layout>
    <x-slot name="header">
        CIS{{ $Module->id }}: {{ $Module->friendly_name }}
        <div>
            <a href="{{route('module.edit', $Module->id)}}"><x-secondary-button>Edit Module</x-secondary-button></a>
            <a href="{{route('module.timeslot.create', $Module->id)}}"><x-secondary-button>Manual Timeslot</x-secondary-button></a>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-module-deletion')">
                {{ __('Delete Module') }}
            </x-danger-button>
        </div>
    </x-slot>

    <section class="flex">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl">Degrees this Module is on:</h2>
            <ul class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($Module->degrees as $Degree)
                    <li><a href="{{route('degree.show', $Degree->id)}}">{{$Degree->friendly_name}}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl">Timetabled Sessions:</h2>
            <table class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Room</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Lecture</th>
                        <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($Module->timeslots as $Timeslot)
                    <tr>
                        <td>{{\App\Helpers\TimeslotFunctions::parseDay($Timeslot->day_of_week)}}</td>
                        <td>{{$Timeslot->room_id}}</td>
                        <td>{{$Timeslot->start_time}}</td>
                        <td>{{$Timeslot->end_time}}</td>
                        <td>{{$Timeslot->is_lecture ? '✅' : '❌'}}</td>
                        <td>
                            <form method="POST" action="{{route('module.timeslot.destroy', [$Module->id, $Timeslot->id])}}">
                                @csrf @method("DELETE")
                                <button type="submit" class="text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-staff-layout>

<x-modal name="confirm-module-deletion" focusable>
    <form method="post" action="{{ route('module.destroy', $Module->id) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete this module?') }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Module') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
