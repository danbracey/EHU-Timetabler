<x-staff-layout>
    <x-slot name="header">
        {{ __('Degrees') }}
    </x-slot>

    <div class="p-6 text-gray-900 grid grid-cols-6 gap-5">
        @foreach($Degrees as $Degree)
            <x-mini-card route="{{route('degree.show', $Degree->id)}}">{{$Degree->friendly_name}}</x-mini-card>
        @endforeach
    </div>

{{--    <div>--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                --}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</x-staff-layout>
