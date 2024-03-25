<x-staff-layout>
    <x-slot name="header">
        {{ $Degree->id }}: {{ $Degree->friendly_name }}
    </x-slot>

    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl">Modules on this degree</h2>
            <ul class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($Degree->modules as $Module)
                    <li><a href="{{route('module.show', $Module->id)}}">{{$Module->friendly_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </section>
</x-staff-layout>
