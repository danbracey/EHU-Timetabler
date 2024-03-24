<x-student-layout>
    <x-slot name="header">
        Welcome {{$Student->first_name}} {{$Student->last_name}}!
    </x-slot>
    <p>Your degree: {{$Student->getDegree->name}}</p>

    <section class="h-screen flex items-center justify-center mx-20">
        <x-text-input placeholder="Enter your student ID" class="w-full border-ehu-pink border-4" value="{{$Student->id}}"></x-text-input>
    </section>
</x-student-layout>
