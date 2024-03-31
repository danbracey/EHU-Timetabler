<x-staff-layout>
    <x-slot name="header">
        {{ __('Degrees') }}
    </x-slot>

    <div class="p-6 text-gray-900 grid grid-cols-6 gap-5">
        @foreach($Degrees as $Degree)
            <x-mini-card id="{{$Degree->id}}" route="degree">{{$Degree->friendly_name}}</x-mini-card>
        @endforeach
    </div>
</x-staff-layout>
