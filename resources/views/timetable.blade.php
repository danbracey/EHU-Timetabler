<x-student-layout>
    <x-slot name="header">
        Welcome {{$Student->first_name}} {{$Student->last_name}}!
    </x-slot>
    <p class="font-copse max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">Your degree: {{$Student->getDegree->friendly_name}} ({{$Student->getDegree->id}})</p>
</x-student-layout>
