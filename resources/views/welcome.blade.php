<x-student-layout>
    <x-slot name="header">
        Welcome {{ __('John') }} {{ __('Doe') }}!
    </x-slot>

    <livewire:get-student-details />
</x-student-layout>
