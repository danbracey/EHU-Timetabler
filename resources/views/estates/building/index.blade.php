<x-staff-layout>
    <x-slot name="header">
        {{ __('Buildings') }}
        <div>
            <a href="{{route('building.create')}}"><x-primary-button>+ Add new Building</x-primary-button></a>
        </div>
    </x-slot>

    <div class="p-6 text-gray-900 grid grid-cols-6 gap-5">
        @foreach($Buildings as $Building)
            <x-mini-card id="{{$Building->id}}">{{$Building->friendly_name}}</x-mini-card>
        @endforeach
    </div>
</x-staff-layout>
