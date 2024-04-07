<x-staff-layout>
    <x-slot name="header">
        {{ __('Degrees') }}
        <div>
            <a href="{{route('degree.create')}}"><x-primary-button>+ Add new Degree</x-primary-button></a>
        </div>
    </x-slot>

    <div class="p-6 text-gray-900 grid grid-cols-6 gap-5">
        @foreach($Degrees as $Degree)
            <x-mini-card id="{{$Degree->id}}" route="degree">{{$Degree->friendly_name}} (Ending in {{$Degree->graduation_year}})</x-mini-card>
        @endforeach
    </div>
</x-staff-layout>
